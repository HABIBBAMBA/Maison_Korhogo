<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agence;
use App\Models\Bien;
use App\Models\Proprietaire;
use Illuminate\Http\Request;

class BienController extends Controller
{
    public function index(Request $request)
    {
        $query = Bien::with(['agence', 'proprietaire']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('titre', 'like', "%{$search}%")
                    ->orWhere('quartier', 'like', "%{$search}%")
                    ->orWhere('adresse', 'like', "%{$search}%");
            });
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('type_bien')) {
            $query->where('type_bien', $request->type_bien);
        }

        if ($request->filled('id_agence')) {
            $query->where('id_agence', $request->id_agence);
        }

        $biens = $query->latest()->paginate(15)->withQueryString();
        $agences = Agence::orderBy('nom_agence')->get();

        return view('admin.biens.index', compact('biens', 'agences'));
    }

    public function create()
    {
        $agences = Agence::orderBy('nom_agence')->get();
        $proprietaires = Proprietaire::orderBy('nom')->get();
        $types = ['appartement', 'maison', 'villa', 'terrain', 'bureau', 'commerce', 'chambre', 'magasin', 'entrepot', 'autre'];
        $statuts = ['disponible', 'loue', 'vendu', 'en_negociation'];

        return view('admin.biens.create', compact('agences', 'proprietaires', 'types', 'statuts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string|max:5000',
            'type_bien' => 'required|string|max:50',
            'statut' => 'required|in:disponible,loue,vendu,en_negociation',
            'prix' => 'required|numeric|min:0',
            'nombre_pieces' => 'nullable|integer|min:0',
            'adresse' => 'nullable|string|max:255',
            'quartier' => 'nullable|string|max:255',
            'id_agence' => 'nullable|exists:agences,id',
            'id_proprietaire' => 'nullable|exists:proprietaires,id',
            'photos.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $bien = Bien::create($validated);

        // Upload des photos
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                if ($photo->isValid()) {
                    $path = $photo->store('biens', 'public');
                    $bien->photos()->create(['photo' => $path]);
                }
            }
        }

        return redirect()->route('admin.biens.index')
            ->with('success', 'Bien créé avec succès.');
    }

    public function show(Bien $bien)
    {
        $bien->load(['agence', 'proprietaire', 'photos']);

        return view('admin.biens.show', compact('bien'));
    }

    public function edit(Bien $bien)
    {
        $bien->load('photos');
        $agences = Agence::orderBy('nom_agence')->get();
        $proprietaires = Proprietaire::orderBy('nom')->get();
        $types = ['appartement', 'maison', 'villa', 'terrain', 'bureau', 'commerce', 'chambre', 'magasin', 'entrepot', 'autre'];
        $statuts = ['disponible', 'loue', 'vendu', 'en_negociation'];

        return view('admin.biens.edit', compact('bien', 'agences', 'proprietaires', 'types', 'statuts'));
    }

    public function update(Request $request, Bien $bien)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string|max:5000',
            'type_bien' => 'required|string|max:50',
            'statut' => 'required|in:disponible,loue,vendu,en_negociation',
            'prix' => 'required|numeric|min:0',
            'nombre_pieces' => 'nullable|integer|min:0',
            'adresse' => 'nullable|string|max:255',
            'quartier' => 'nullable|string|max:255',
            'id_agence' => 'nullable|exists:agences,id',
            'id_proprietaire' => 'nullable|exists:proprietaires,id',
            'photos.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $bien->update($validated);

        // Upload de nouvelles photos (remplace les anciennes)
        if ($request->hasFile('photos')) {
            // Supprimer les anciennes photos du stockage
            foreach ($bien->photos as $photo) {
                \Storage::disk('public')->delete($photo->photo);
            }
            $bien->photos()->delete();

            // Stocker les nouvelles
            foreach ($request->file('photos') as $photo) {
                if ($photo->isValid()) {
                    $path = $photo->store('biens', 'public');
                    $bien->photos()->create(['photo' => $path]);
                }
            }
        }

        return redirect()->route('admin.biens.index')
            ->with('success', 'Bien mis à jour.');
    }

    public function destroy(Bien $bien)
    {
        // Supprimer les photos du stockage
        foreach ($bien->photos as $photo) {
            \Storage::disk('public')->delete($photo->photo);
        }
        $bien->photos()->delete();

        $bien->delete();

        return redirect()->route('admin.biens.index')
            ->with('success', 'Bien supprimé.');
    }
}
