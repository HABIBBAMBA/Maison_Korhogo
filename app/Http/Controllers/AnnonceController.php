<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AnnonceController extends Controller
{
    // INDEX — Liste des annonces (page publique)
    public function index(Request $request)
    {
        $filters = $request->validate([
            'recherche' => 'nullable|string|max:255',
            'type_bien' => 'nullable|string|max:50',
            'type_offre' => 'nullable|string|in:vente,location,court_sejour',
            'categorie' => 'nullable|string|in:vente,location,court_sejour',
            'prix_min' => 'nullable|numeric|min:0',
            'prix_max' => 'nullable|numeric|min:0',
        ]);

        $query = Annonce::with('user')
            ->where('statut', 'active')
            ->latest();

        if (! empty($filters['recherche'])) {
            $search = $filters['recherche'];
            $query->where(function ($q) use ($search) {
                $q->where('titre', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%")
                    ->orWhere('quartier', 'LIKE', "%{$search}%");
            });
        }

        if (! empty($filters['type_bien'])) {
            if ($filters['type_bien'] === 'maison') {
                $query->whereIn('type_bien', ['maison', 'appartement', 'villa']);
            } elseif ($filters['type_bien'] === 'magasin') {
                $query->whereIn('type_bien', ['magasin', 'commerce']);
            } elseif (in_array($filters['type_bien'], ['hebergement', 'residence', 'hotel', 'court_sejour', 'residence_meublee', 'chambre_hotel', 'auberge'], true)) {
                $query->where(function ($q) {
                    $q->where('type_offre', 'court_sejour')
                        ->orWhereIn('type_bien', ['residence_meublee', 'chambre_hotel', 'auberge']);
                });
            } else {
                $query->where('type_bien', $filters['type_bien']);
            }
        }

        if (! empty($filters['type_offre'])) {
            if ($filters['type_offre'] === 'court_sejour') {
                $query->where(function ($q) {
                    $q->where('type_offre', 'court_sejour')
                        ->orWhereIn('type_bien', ['residence_meublee', 'chambre_hotel', 'auberge']);
                });
            } else {
                $query->where('type_offre', $filters['type_offre']);
            }
        }

        if (! empty($filters['categorie'])) {
            if ($filters['categorie'] === 'court_sejour') {
                $query->where(function ($q) {
                    $q->where('type_offre', 'court_sejour')
                        ->orWhereIn('type_bien', ['residence_meublee', 'chambre_hotel', 'auberge']);
                });
            } else {
                $query->where('categorie', $filters['categorie']);
            }
        }

        if (! empty($filters['prix_min'])) {
            $query->where('prix', '>=', $filters['prix_min']);
        }

        if (! empty($filters['prix_max'])) {
            $query->where('prix', '<=', $filters['prix_max']);
        }

        $annonces = $query->paginate(12)->withQueryString();

        return view('annonces.index', compact('annonces'));
    }

    // MY INDEX — Mes annonces
    public function myAnnonces()
    {
        if (! Auth::user()->peutPublierAnnonce()) {
            abort(403, 'Accès réservé aux propriétaires et agences immobilières.');
        }

        $annonces = Annonce::where('id_user', Auth::id())
            ->latest()
            ->paginate(10);

        return view('annonces.my-annonces', compact('annonces'));
    }

    // CREATE
    public function create()
    {
        if (! Auth::user()->peutPublierAnnonce()) {
            abort(403, 'Seuls les propriétaires et les agences sont autorisés à publier une annonce.');
        }

        return view('annonces.create');
    }

    // STORE
    public function store(Request $request)
    {
        if (! Auth::user()->peutPublierAnnonce()) {
            abort(403, 'Seuls les propriétaires et les agences sont autorisés à publier une annonce.');
        }
        $filesInfo = [];
        foreach ($request->file('images', []) as $idx => $f) {
            $filesInfo[] = [
                'index' => $idx,
                'name' => $f->getClientOriginalName(),
                'size_bytes' => $f->getSize(),
                'error_code' => $f->getError(),
                'error_msg' => $f->getErrorMessage(),
                'is_valid' => $f->isValid(),
            ];
        }

        Log::info('AnnonceController@store execution', [
            'has_images' => $request->hasFile('images'),
            'files' => $filesInfo,
            'upload_max_filesize' => ini_get('upload_max_filesize'),
            'post_max_size' => ini_get('post_max_size'),
            'upload_tmp_dir' => ini_get('upload_tmp_dir'),
            'server_software' => $_SERVER['SERVER_SOFTWARE'] ?? 'N/A',
        ]);
        $validated = $request->validate([
            'type_offre' => 'required|string|in:vente,location,court_sejour',
            'type_bien' => 'required|string|in:appartement,maison,villa,terrain,bureau,commerce,chambre,magasin,entrepot,residence_meublee,chambre_hotel,auberge,autre',
            'titre' => 'required|string|max:255',
            'description' => 'required|string|min:20',
            'prix' => 'required|numeric|min:0',
            'date_disponibilite' => 'required|date',
            'superficie' => 'nullable|numeric|min:0',
            'capacite_voyageurs' => 'nullable|integer|min:0|max:100',
            'nombre_chambres' => 'nullable|integer|min:0',
            'nombre_salles_bain' => 'nullable|integer|min:0',
            'nombre_pieces' => 'nullable|integer|min:0',
            'quartier' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'equipements' => 'nullable|array',
            'equipements.*' => 'string',
            'images' => 'nullable|array|max:10',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp,jfif,avif|max:10240',
        ], [
            'type_offre.required' => 'Veuillez sélectionner le type d\'offre (location ou vente).',
            'type_bien.required' => 'Veuillez sélectionner le type de bien.',
            'titre.required' => 'Le titre de l\'annonce est obligatoire.',
            'description.required' => 'La description du bien est obligatoire.',
            'description.min' => 'La description doit contenir au moins 20 caractères.',
            'prix.required' => 'Le prix est obligatoire.',
            'prix.numeric' => 'Le prix doit être un nombre valide.',
            'date_disponibilite.required' => 'La date de disponibilité est obligatoire.',
            'quartier.required' => 'Le quartier est obligatoire.',
            'adresse.required' => 'L\'adresse ou le repère est obligatoire.',
            'images.max' => 'Vous ne pouvez pas envoyer plus de 10 photos.',
            'images.uploaded' => 'Une ou plusieurs photos n\'ont pas pu être envoyées (taille maximale de 10 Mo dépassée).',
            'images.*.image' => 'Chaque fichier doit être une image valide.',
            'images.*.mimes' => 'Formats acceptés : JPG, JPEG, PNG, WEBP, JFIF, AVIF.',
            'images.*.max' => 'La taille maximale par photo est de 10 Mo.',
            'images.*.uploaded' => 'La photo n\'a pas pu être envoyée.',
        ]);

        // Upload des images
        $imagesPaths = [];
        foreach ($request->file('images', []) as $image) {
            $imagesPaths[] = $image->store('annonces', 'public');
        }

        $validated['images'] = $imagesPaths;
        $validated['id_user'] = Auth::id();
        $validated['statut'] = 'active';
        $validated['categorie'] = $validated['type_offre'];

        Annonce::create($validated);

        return redirect()
            ->route('annonces.mes-annonces')
            ->with('success', 'Annonce publiée avec succès !');
    }

    // SHOW — Détail
    public function show(Annonce $annonce)
    {
        $annonce->incrementQuietly('vues');
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
        $user = Auth::user();
        if (! $user->peutPublierAnnonce() || ($annonce->id_user !== $user->id && ! $user->estAdmin())) {
            abort(403, 'Vous ne pouvez modifier que vos propres annonces.');
        }

        return view('annonces.edit', compact('annonce'));
    }

    // UPDATE
    public function update(Request $request, Annonce $annonce)
    {
        $user = Auth::user();
        if (! $user->peutPublierAnnonce() || ($annonce->id_user !== $user->id && ! $user->estAdmin())) {
            abort(403, 'Accès non autorisé.');
        }

        $validated = $request->validate([
            // ── Informations ──
            'titre' => 'required|string|max:255',
            'description' => 'required|string|min:20',
            'type_bien' => 'required|string|in:appartement,maison,villa,terrain,bureau,commerce,chambre,magasin,entrepot,residence_meublee,chambre_hotel,auberge,autre',
            'type_offre' => 'required|string|in:vente,location,court_sejour',
            'statut' => 'required|in:active,vendu,loue,inactive',

            // ── Caractéristiques ──
            'prix' => 'required|numeric|min:0',
            'date_disponibilite' => 'nullable|date',
            'superficie' => 'nullable|numeric|min:0',
            'capacite_voyageurs' => 'nullable|integer|min:0|max:100',
            'nombre_pieces' => 'nullable|integer|min:0',
            'nombre_chambres' => 'nullable|integer|min:0',
            'nombre_salles_bain' => 'nullable|integer|min:0',

            // ── Localisation ──
            'adresse' => 'nullable|string|max:255',
            'quartier' => 'nullable|string|max:255',

            // ── Équipements ──
            'equipements' => 'nullable|array',
            'equipements.*' => 'string',
            'images' => 'nullable|array|max:10',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp,jfif,avif|max:10240',
        ], [
            'images.max' => 'Vous ne pouvez pas envoyer plus de 10 photos.',
            'images.uploaded' => 'Une ou plusieurs photos n\'ont pas pu être envoyées (taille maximale de 10 Mo dépassée).',
            'images.*.image' => 'Chaque fichier doit être une image valide.',
            'images.*.mimes' => 'Formats acceptés : JPG, JPEG, PNG, WEBP, JFIF, AVIF.',
            'images.*.max' => 'La taille maximale par photo est de 10 Mo.',
            'images.*.uploaded' => 'La photo n\'a pas pu être envoyée. Le fichier dépasse la taille maximale autorisée de 10 Mo.',
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

        if ($user->estAdmin() && ! $request->is('mes-annonces/*')) {
            return redirect()
                ->route('admin.biens.index')
                ->with('success', 'Annonce mise à jour avec succès !');
        }

        return redirect()
            ->route('annonces.mes-annonces')
            ->with('success', 'Annonce mise à jour avec succès !');
    }

    // DELETE
    public function destroy(Annonce $annonce)
    {
        $user = Auth::user();
        if (! $user->peutPublierAnnonce() || ($annonce->id_user !== $user->id && ! $user->estAdmin())) {
            abort(403, 'Accès non autorisé.');
        }

        if ($annonce->images) {
            foreach ($annonce->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $annonce->delete();

        if ($user->estAdmin()) {
            return redirect()
                ->route('admin.biens.index')
                ->with('success', 'Annonce supprimée avec succès.');
        }

        return redirect()
            ->route('annonces.mes-annonces')
            ->with('success', 'Annonce supprimée avec succès.');
    }
}
