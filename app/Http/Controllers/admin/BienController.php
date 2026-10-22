<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agence;
use App\Models\Annonce;
use App\Models\Bien;
use App\Models\Proprietaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BienController extends Controller
{
    public function index(Request $request)
    {
        $query = Annonce::with(['user.agence', 'user.proprietaire']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('titre', 'like', "%{$search}%")
                    ->orWhere('quartier', 'like', "%{$search}%")
                    ->orWhere('adresse', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($uq) use ($search) {
                        $uq->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('type_bien')) {
            $query->where('type_bien', $request->type_bien);
        }

        if ($request->filled('type_offre')) {
            $query->where('type_offre', $request->type_offre);
        }

        if ($request->filled('id_agence')) {
            $agence = Agence::find($request->id_agence);
            if ($agence && $agence->id_user) {
                $query->where('id_user', $agence->id_user);
            }
        }

        $biens = $query->latest()->paginate(15)->withQueryString();
        $agences = Agence::orderBy('nom_agence')->get();

        $stats = [
            'total' => Annonce::count(),
            'active' => Annonce::where('statut', 'active')->count(),
            'vente' => Annonce::where('type_offre', 'vente')->count(),
            'location' => Annonce::where('type_offre', 'location')->count(),
        ];

        return view('admin.biens.index', compact('biens', 'agences', 'stats'));
    }

    public function create()
    {
        $agences = Agence::orderBy('nom_agence')->get();
        $proprietaires = Proprietaire::orderBy('nom')->get();
        $types = ['appartement', 'maison', 'villa', 'terrain', 'bureau', 'commerce', 'chambre', 'magasin', 'entrepot', 'autre'];
        $statuts = ['active', 'vendu', 'loue', 'inactive'];

        return view('admin.biens.create', compact('agences', 'proprietaires', 'types', 'statuts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string|max:5000',
            'type_bien' => 'required|string|max:50',
            'type_offre' => 'nullable|string|in:vente,location',
            'statut' => 'required|string',
            'prix' => 'required|numeric|min:0',
            'nombre_pieces' => 'nullable|integer|min:0',
            'adresse' => 'nullable|string|max:255',
            'quartier' => 'nullable|string|max:255',
            'id_agence' => 'nullable|exists:agences,id',
            'id_proprietaire' => 'nullable|exists:proprietaires,id',
            'photos.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        $statutBien = match ($validated['statut']) {
            'active', 'disponible' => 'disponible',
            'vendu' => 'vendu',
            'loue' => 'loue',
            default => 'en_negociation',
        };

        $statutAnnonce = match ($validated['statut']) {
            'disponible', 'active' => 'active',
            'vendu' => 'vendu',
            'loue' => 'loue',
            default => 'inactive',
        };

        $userId = auth()->id() ?? 1;
        if (! empty($validated['id_agence'])) {
            $ag = Agence::find($validated['id_agence']);
            if ($ag && $ag->id_user) {
                $userId = $ag->id_user;
            }
        } elseif (! empty($validated['id_proprietaire'])) {
            $prop = Proprietaire::find($validated['id_proprietaire']);
            if ($prop && $prop->id_user) {
                $userId = $prop->id_user;
            }
        }

        $photoPaths = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                if ($photo->isValid()) {
                    $photoPaths[] = $photo->store('annonces', 'public');
                }
            }
        }

        $bienData = $validated;
        $bienData['statut'] = $statutBien;
        unset($bienData['photos'], $bienData['type_offre']);
        $bien = Bien::create($bienData);

        if (! empty($photoPaths)) {
            foreach ($photoPaths as $path) {
                $bien->photos()->create(['photo' => $path]);
            }
        }

        Annonce::create([
            'titre' => $validated['titre'],
            'description' => $validated['description'] ?? ($validated['titre'].' - '.($validated['quartier'] ?? 'Korhogo')),
            'type_bien' => in_array($validated['type_bien'], ['appartement', 'maison', 'villa', 'terrain', 'bureau', 'commerce', 'chambre', 'magasin', 'entrepot', 'autre']) ? $validated['type_bien'] : 'maison',
            'type_offre' => $validated['type_offre'] ?? 'vente',
            'categorie' => $validated['type_offre'] ?? 'vente',
            'prix' => $validated['prix'],
            'nombre_pieces' => $validated['nombre_pieces'] ?? null,
            'adresse' => $validated['adresse'] ?? null,
            'quartier' => $validated['quartier'] ?? null,
            'images' => $photoPaths,
            'statut' => $statutAnnonce,
            'id_user' => $userId,
            'vues' => 0,
        ]);

        return redirect()->route('admin.biens.index')
            ->with('success', 'Bien créé avec succès.');
    }

    public function show($id)
    {
        $annonce = Annonce::with(['user.agence', 'user.proprietaire'])->find($id);
        $bien = $annonce ?: Bien::with(['agence', 'proprietaire', 'photos'])->findOrFail($id);

        return view('admin.biens.show', compact('bien'));
    }

    public function edit($id)
    {
        $annonce = Annonce::with(['user.agence', 'user.proprietaire'])->find($id);
        $bien = $annonce ?: Bien::with(['agence', 'proprietaire', 'photos'])->findOrFail($id);

        $agences = Agence::orderBy('nom_agence')->get();
        $proprietaires = Proprietaire::orderBy('nom')->get();
        $types = ['appartement', 'maison', 'villa', 'terrain', 'bureau', 'commerce', 'chambre', 'magasin', 'entrepot', 'autre'];
        $statuts = ['active', 'disponible', 'loue', 'vendu', 'en_negociation', 'inactive'];

        return view('admin.biens.edit', compact('bien', 'agences', 'proprietaires', 'types', 'statuts'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string|max:5000',
            'type_bien' => 'required|string|max:50',
            'type_offre' => 'nullable|string|in:vente,location',
            'statut' => 'required|string',
            'prix' => 'required|numeric|min:0',
            'nombre_pieces' => 'nullable|integer|min:0',
            'adresse' => 'nullable|string|max:255',
            'quartier' => 'nullable|string|max:255',
            'id_agence' => 'nullable|exists:agences,id',
            'id_proprietaire' => 'nullable|exists:proprietaires,id',
            'photos.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        $photoPaths = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                if ($photo->isValid()) {
                    $photoPaths[] = $photo->store('annonces', 'public');
                }
            }
        }

        $annonce = Annonce::find($id);
        if ($annonce) {
            $statutAnnonce = match ($validated['statut']) {
                'disponible', 'active' => 'active',
                'vendu' => 'vendu',
                'loue' => 'loue',
                default => 'inactive',
            };

            $updateData = [
                'titre' => $validated['titre'],
                'description' => $validated['description'] ?? $annonce->description,
                'type_bien' => $validated['type_bien'],
                'type_offre' => $validated['type_offre'] ?? $annonce->type_offre,
                'statut' => $statutAnnonce,
                'prix' => $validated['prix'],
                'nombre_pieces' => $validated['nombre_pieces'] ?? null,
                'adresse' => $validated['adresse'] ?? null,
                'quartier' => $validated['quartier'] ?? null,
            ];

            if (! empty($photoPaths)) {
                if ($annonce->images) {
                    foreach ($annonce->images as $old) {
                        Storage::disk('public')->delete($old);
                    }
                }
                $updateData['images'] = $photoPaths;
            }

            $annonce->update($updateData);
        }

        $bien = Bien::find($id);
        if ($bien) {
            $statutBien = match ($validated['statut']) {
                'active', 'disponible' => 'disponible',
                'vendu' => 'vendu',
                'loue' => 'loue',
                default => 'en_negociation',
            };

            $bienData = $validated;
            $bienData['statut'] = $statutBien;
            unset($bienData['photos'], $bienData['type_offre']);
            $bien->update($bienData);

            if (! empty($photoPaths)) {
                foreach ($bien->photos as $p) {
                    Storage::disk('public')->delete($p->photo);
                }
                $bien->photos()->delete();
                foreach ($photoPaths as $path) {
                    $bien->photos()->create(['photo' => $path]);
                }
            }
        }

        return redirect()->route('admin.biens.index')
            ->with('success', 'Bien mis à jour.');
    }

    public function destroy($id)
    {
        $annonce = Annonce::find($id);
        if ($annonce) {
            if ($annonce->images) {
                foreach ($annonce->images as $img) {
                    Storage::disk('public')->delete($img);
                }
            }
            $annonce->delete();
        }

        $bien = Bien::find($id);
        if ($bien) {
            foreach ($bien->photos as $photo) {
                Storage::disk('public')->delete($photo->photo);
            }
            $bien->photos()->delete();
            $bien->delete();
        }

        return redirect()->route('admin.biens.index')
            ->with('success', 'Bien supprimé.');
    }
}
