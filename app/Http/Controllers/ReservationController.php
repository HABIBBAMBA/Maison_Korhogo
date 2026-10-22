<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Enregistrer une nouvelle demande de réservation de séjour.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id_annonce' => 'required|exists:annonces,id',
            'nom_client' => 'required|string|max:255',
            'telephone' => 'required|string|max:30',
            'email' => 'nullable|email|max:255',
            'date_arrivee' => 'required|date|after_or_equal:today',
            'date_depart' => 'required|date|after:date_arrivee',
            'nombre_personnes' => 'required|integer|min:1|max:50',
            'demandes_particulieres' => 'nullable|string|max:2000',
        ], [
            'date_arrivee.after_or_equal' => 'La date d\'arrivée doit être égale ou postérieure à aujourd\'hui.',
            'date_depart.after' => 'La date de départ doit être strictement postérieure à la date d\'arrivée.',
            'telephone.required' => 'Votre numéro de téléphone est indispensable pour confirmer la disponibilité.',
        ]);

        $annonce = Annonce::with('user.proprietaire', 'user.agence')->findOrFail($validated['id_annonce']);

        $dateArrivee = Carbon::parse($validated['date_arrivee']);
        $dateDepart = Carbon::parse($validated['date_depart']);
        $nombreNuits = (int) $dateArrivee->diffInDays($dateDepart);
        if ($nombreNuits < 1) {
            $nombreNuits = 1;
        }

        $prixTotalEstime = $nombreNuits * (float) $annonce->prix;

        $reservation = Reservation::create([
            'id_annonce' => $annonce->id,
            'id_user' => auth()->id(),
            'nom_client' => $validated['nom_client'],
            'telephone' => $validated['telephone'],
            'email' => $validated['email'] ?? (auth()->user()?->email),
            'date_arrivee' => $dateArrivee->toDateString(),
            'date_depart' => $dateDepart->toDateString(),
            'nombre_nuits' => $nombreNuits,
            'nombre_personnes' => $validated['nombre_personnes'],
            'prix_total_estime' => $prixTotalEstime,
            'demandes_particulieres' => $validated['demandes_particulieres'] ?? null,
            'statut' => 'en_attente',
        ]);

        $message = "Votre demande de réservation ({$nombreNuits} nuit(s) — ".number_format($prixTotalEstime, 0, ',', '.')." FCFA) a été transmise à l'hôte avec succès.";

        if (auth()->check() && auth()->user()->isClient()) {
            return redirect()
                ->route('dashboard')
                ->with('success', $message);
        }

        return redirect()
            ->route('annonces.show', $annonce)
            ->with('success', $message);
    }

    /**
     * Mettre à jour le statut d'une réservation (Confirmer, Refuser, Terminer).
     * Autorisé uniquement pour l'annonceur hôte ou l'administrateur.
     */
    public function updateStatut(Request $request, Reservation $reservation): RedirectResponse
    {
        $user = auth()->user();

        // Vérification de sécurité : seul le propriétaire de l'annonce ou un admin peut valider
        if ($reservation->annonce->id_user !== $user->id && ! $user->isAdmin()) {
            abort(403, 'Action non autorisée sur cette réservation.');
        }

        $validated = $request->validate([
            'statut' => 'required|in:confirmee,refusee,annulee,terminee',
        ]);

        $reservation->update([
            'statut' => $validated['statut'],
        ]);

        $libelle = match ($validated['statut']) {
            'confirmee' => 'confirmée',
            'refusee' => 'refusée',
            'annulee' => 'annulée',
            'terminee' => 'marquée comme terminée',
            default => 'mise à jour',
        };

        return back()->with('success', "La réservation #{$reservation->id} a bien été {$libelle}.");
    }

    /**
     * Annuler une réservation (par le voyageur ou l'hôte).
     */
    public function cancel(Reservation $reservation): RedirectResponse
    {
        $user = auth()->user();

        $estVoyageur = $reservation->id_user === $user->id || ($user->email && $reservation->email === $user->email);
        $estHote = $reservation->annonce->id_user === $user->id;
        $estAdmin = $user->isAdmin();

        if (! $estVoyageur && ! $estHote && ! $estAdmin) {
            abort(403, 'Vous n\'êtes pas autorisé à annuler cette réservation.');
        }

        $reservation->update(['statut' => 'annulee']);

        return back()->with('success', "La réservation #{$reservation->id} a été annulée.");
    }
}
