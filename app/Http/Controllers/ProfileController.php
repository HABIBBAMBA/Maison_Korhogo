<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Agence;
use App\Models\Annonce;
use App\Models\Bien;
use App\Models\Client;
use App\Models\Proprietaire;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form with role-specific data & statistics.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();

        // Récupérer le modèle de profil spécifique lié
        $profile = match ($user->role) {
            'agence' => $user->agence,
            'proprietaire' => $user->proprietaire,
            'client' => $user->client,
            default => null,
        };

        // Calculer les métriques spécifiques au rôle pour le bandeau récapitulatif
        $stats = match ($user->role) {
            'client' => [
                'total_reservations' => $user->reservations()->count(),
                'reservations_en_attente' => $user->reservations()->where('statut', 'en_attente')->count(),
                'reservations_confirmees' => $user->reservations()->where('statut', 'confirmee')->count(),
            ],
            'proprietaire' => [
                'total_annonces' => $user->annonces()->count(),
                'annonces_actives' => $user->annonces()->where('statut', 'active')->count(),
                'reservations_recues' => Reservation::whereHas('annonce', fn ($q) => $q->where('id_user', $user->id))->count(),
            ],
            'agence' => [
                'total_annonces' => $user->annonces()->count(),
                'annonces_actives' => $user->annonces()->where('statut', 'active')->count(),
                'reservations_recues' => Reservation::whereHas('annonce', fn ($q) => $q->where('id_user', $user->id))->count(),
                'total_biens' => Bien::where('id_agence', $user->agence?->id)->count(),
            ],
            'admin' => [
                'total_users' => User::count(),
                'total_annonces' => Annonce::count(),
                'total_biens' => Bien::count(),
            ],
            default => [],
        };

        return view('profile.edit', [
            'user' => $user,
            'profile' => $profile,
            'stats' => $stats,
        ]);
    }

    /**
     * Update the user's profile information and role-specific profile model.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validated = $request->validated();

        // 1. Mise à jour de l'email
        $user->email = $validated['email'];
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // 2. Traitement selon le rôle
        if ($user->role === 'client') {
            $nom = $validated['nom'] ?? ($user->client?->nom ?? '');
            $prenom = $validated['prenom'] ?? ($user->client?->prenom ?? '');
            $telephone = $validated['telephone'] ?? $user->client?->telephone;

            Client::updateOrCreate(
                ['id_user' => $user->id],
                [
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'telephone' => $telephone,
                ]
            );

            if ($nom || $prenom) {
                $user->name = trim("{$prenom} {$nom}");
            } elseif (! empty($validated['name'])) {
                $user->name = $validated['name'];
            }
        } elseif ($user->role === 'proprietaire') {
            $nom = $validated['nom'] ?? ($user->proprietaire?->nom ?? '');
            $prenom = $validated['prenom'] ?? ($user->proprietaire?->prenom ?? '');
            $telephone = $validated['telephone'] ?? $user->proprietaire?->telephone;
            $adresse = $validated['adresse'] ?? $user->proprietaire?->adresse;

            Proprietaire::updateOrCreate(
                ['id_user' => $user->id],
                [
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'telephone' => $telephone,
                    'adresse' => $adresse,
                ]
            );

            if ($nom || $prenom) {
                $user->name = trim("{$prenom} {$nom}");
            } elseif (! empty($validated['name'])) {
                $user->name = $validated['name'];
            }
        } elseif ($user->role === 'agence') {
            $nomAgence = $validated['nom_agence'] ?? ($user->agence?->nom_agence ?? $user->name);
            $nomResponsable = $validated['nom_responsable'] ?? ($user->agence?->nom_responsable ?? '');
            $telephone = $validated['telephone'] ?? $user->agence?->telephone;
            $adresse = $validated['adresse'] ?? $user->agence?->adresse;

            $agenceData = [
                'nom_agence' => $nomAgence,
                'nom_responsable' => $nomResponsable,
                'telephone' => $telephone,
                'adresse' => $adresse,
            ];

            // Traitement upload du logo
            if ($request->hasFile('logo')) {
                if ($user->agence?->logo && Storage::disk('public')->exists($user->agence->logo)) {
                    Storage::disk('public')->delete($user->agence->logo);
                }
                $agenceData['logo'] = $request->file('logo')->store('agences/logos', 'public');
            }

            Agence::updateOrCreate(
                ['id_user' => $user->id],
                $agenceData
            );

            $user->name = $nomAgence;
        } else {
            // Admin ou compte générique
            if (! empty($validated['name'])) {
                $user->name = $validated['name'];
            }
        }

        $user->save();

        return Redirect::route('profile.edit')->with('success', 'Votre profil a été mis à jour avec succès.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Nettoyage logo agence
        if ($user->role === 'agence' && $user->agence?->logo && Storage::disk('public')->exists($user->agence->logo)) {
            Storage::disk('public')->delete($user->agence->logo);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('success', 'Votre compte a été supprimé avec succès.');
    }
}
