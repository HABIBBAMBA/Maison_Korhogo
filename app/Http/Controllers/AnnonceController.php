<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AnnonceController extends Controller
{
    // INDEX — Liste des annonces (page publique)
    public function index(Request $request)
    {
        $query = Annonce::with('user')
            ->where('statut', 'active')
            ->latest();

        if ($request->filled('recherche')) {
            $search = $request->recherche;
            $query->where(function ($q) use ($search) {
                $q->where('titre', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%")
                    ->orWhere('ville', 'LIKE', "%{$search}%")
                    ->orWhere('quartier', 'LIKE', "%{$search}%");
            });
        }

        if ($request->filled('type_bien')) {
            $query->where('type_bien', $request->type_bien);
        }

        if ($request->filled('type_offre')) {
            $query->where('type_offre', $request->type_offre);
        }

        if ($request->filled('categorie')) {
            $query->where('categorie', $request->categorie);
        }

        if ($request->filled('prix_min')) {
            $query->where('prix', '>=', $request->prix_min);
        }

        if ($request->filled('prix_max')) {
            $query->where('prix', '<=', $request->prix_max);
        }

        $annonces = $query->paginate(12)->withQueryString();

        return view('annonces.index', compact('annonces'));
    }

    // MY INDEX — Mes annonces
    public function myAnnonces()
    {
        $annonces = Annonce::where('id_user', Auth::id())
            ->latest()
            ->paginate(10);

        return view('annonces.my-annonces', compact('annonces'));
    }

    // CREATE
    public function create()
    {
        return view('annonces.create');
    }

    // STORE
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type_offre'         => 'required|string|in:vente,location',
            'type_bien'          => 'required|string|in:appartement,maison,villa,terrain,bureau,commerce,chambre,magasin,entrepot,autre',
            'titre'              => 'required|string|max:255',
            'description'        => 'required|string|min:20',
            'prix'               => 'required|numeric|min:0',
            'date_disponibilite' => 'required|date',
            'superficie'         => 'nullable|numeric|min:0',
            'nombre_chambres'    => 'nullable|integer|min:0',
            'nombre_salles_bain' => 'nullable|integer|min:0',
            'nombre_pieces'      => 'nullable|integer|min:0',
            'quartier'           => 'required|string|max:255',
            'adresse'            => 'required|string|max:255',
            'equipements'        => 'nullable|array',
            'equipements.*'      => 'string',
        ]);

        // Upload des images
        $imagesPaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagesPaths[] = $image->store('annonces', 'public');
            }
        }

        $validated['images']    = $imagesPaths;
        $validated['id_user']   = Auth::id();
        $validated['statut']    = 'active';
        $validated['categorie'] = $validated['type_offre'];

        Annonce::create($validated);

        return redirect()
            ->route('annonces.mes-annonces')
            ->with('success', 'Annonce publiée avec succès !');
    }

    // SHOW — Détail
    public function show(Annonce $annonce)
    {
        $annonce->load('user');

        $similaires = Annonce::where('id', '!=', $annonce->id)
            ->where('statut', 'active')
            ->where(function ($q) use ($annonce) {
                $q->where('type_bien', $annonce->type_bien)
                    ->orWhere('type_offre', $annonce->type_offre)
                    ->orWhere('quartier', $annonce->quartier);
            })
            ->limit(4)
            ->inRandomOrder()
            ->get();

        return view('annonces.show', compact('annonce', 'similaires'));
    }

    // EDIT
    public function edit(Annonce $annonce)
    {
        if ($annonce->id_user !== Auth::id()) {
            abort(403, 'Vous ne pouvez modifier que vos propres annonces.');
        }

        return view('annonces.edit', compact('annonce'));
    }

    // UPDATE
    public function update(Request $request, Annonce $annonce)
    {
        if ($annonce->id_user !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            // ── Informations ──
            'titre'              => 'required|string|max:255',
            'description'        => 'required|string|min:20',
            'type_bien'          => 'required|string|in:appartement,maison,villa,terrain,bureau,commerce,chambre,magasin,entrepot,autre',
            'type_offre'         => 'required|string|in:vente,location',
            'statut'             => 'required|in:active,vendu,loue,inactive',

            // ── Caractéristiques ──
            'prix'               => 'required|numeric|min:0',
            'date_disponibilite' => 'nullable|date',
            'superficie'         => 'nullable|numeric|min:0',
            'nombre_pieces'      => 'nullable|integer|min:0',
            'nombre_chambres'    => 'nullable|integer|min:0',
            'nombre_salles_bain' => 'nullable|integer|min:0',

            // ── Localisation ──
            'adresse'            => 'nullable|string|max:255',
            'quartier'           => 'nullable|string|max:255',

            // ── Équipements ──
            'equipements'        => 'nullable|array',
            'equipements.*'      => 'string',

            // ── Images ──
            'images'             => 'nullable|array|max:8',
            'images.*'           => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // categorie reste alignée sur type_offre, comme dans store()
        $validated['categorie'] = $validated['type_offre'];

        // Gestion des images
        if ($request->hasFile('images')) {
            // Supprimer les anciennes images
            if ($annonce->images) {
                foreach ($annonce->images as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }

            $imagesPaths = [];
            foreach ($request->file('images') as $image) {
                $imagesPaths[] = $image->store('annonces', 'public');
            }
            $validated['images'] = $imagesPaths;
        } else {
            unset($validated['images']);
        }

        $annonce->update($validated);

        return redirect()
            ->route('annonces.mes-annonces')
            ->with('success', 'Annonce mise à jour avec succès !');
    }

    // DELETE
    public function destroy(Annonce $annonce)
    {
        if ($annonce->id_user !== Auth::id()) {
            abort(403);
        }

        if ($annonce->images) {
            foreach ($annonce->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $annonce->delete();

        return redirect()
            ->route('annonces.mes-annonces')
            ->with('success', 'Annonce supprimée avec succès.');
    }
}
