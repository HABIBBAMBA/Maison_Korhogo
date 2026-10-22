<?php

namespace App\Http\Controllers;

use App\Models\Agence;
use App\Models\Annonce;
use App\Models\Contact;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // ── 1. ESPACE CLIENT DÉDIÉ (ACQUÉREUR / LOCATAIRE) ──
        if ($user->estClient()) {
            return $this->clientDashboard($user);
        }

        // ── 2. ESPACE PROPRIÉTAIRE / AGENCE / ADMIN ──
        if ($user->estAdmin()) {
            $annoncesQuery = Annonce::query();
        } else {
            $annoncesQuery = Annonce::where('id_user', $user->id);
        }

        $totalBiens = (clone $annoncesQuery)->count();
        $biensPublies = (clone $annoncesQuery)->where('statut', 'active')->count();
        $totalVues = (int) ((clone $annoncesQuery)->sum('vues') ?: 0);

        // Vues cette semaine (estimation ou calcul)
        $vuesCetteSemaine = (int) ((clone $annoncesQuery)
            ->where('updated_at', '>=', now()->startOfWeek())
            ->sum('vues') ?: 0);

        $pourcentageVuesSemaine = $totalVues > 0
            ? min(100, round(($vuesCetteSemaine / $totalVues) * 100))
            : 0;

        // Messages reçus liés aux annonces de l'utilisateur
        $annonceIds = (clone $annoncesQuery)->pluck('id');
        $messagesQuery = Contact::whereIn('id_bien', $annonceIds);

        $totalMessages = (clone $messagesQuery)->count();
        $nouveauxMessages = (clone $messagesQuery)->where('created_at', '>=', now()->subWeek())->count();

        // Réservations court séjour reçues (résidences et hôtels)
        if ($user->estAdmin()) {
            $reservationsQuery = Reservation::with(['annonce', 'user']);
        } else {
            $reservationsQuery = Reservation::whereHas('annonce', function ($q) use ($user) {
                $q->where('id_user', $user->id);
            })->with(['annonce', 'user']);
        }

        $totalReservations = (clone $reservationsQuery)->count();
        $reservationsEnAttente = (clone $reservationsQuery)->where('statut', 'en_attente')->count();
        $reservationsRecues = (clone $reservationsQuery)->latest()->take(8)->get();

        $stats = [
            'total_biens' => $totalBiens,
            'biens_publies' => $biensPublies,
            'total_vues' => $totalVues,
            'vues_cette_semaine' => $pourcentageVuesSemaine,
            'total_messages' => $totalMessages,
            'nouveaux_messages' => $nouveauxMessages,
            'total_reservations' => $totalReservations,
            'reservations_en_attente' => $reservationsEnAttente,
            'total_rdv' => 0,
            'rdv_a_venir' => 0,
        ];

        // Statistiques supplémentaires pour les administrateurs
        if ($user->estAdmin()) {
            $stats['total_users'] = User::count();
            $stats['users_actifs'] = User::whereNotNull('email_verified_at')->count();
            $stats['total_agences'] = Agence::count();
            $stats['total_transactions'] = Annonce::whereIn('statut', ['vendu', 'loue'])->count();
        }

        // Biens récents
        $recentBiens = (clone $annoncesQuery)
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($bien) {
                return [
                    'id' => $bien->id,
                    'titre' => $bien->titre,
                    'ville' => $bien->quartier ?? 'Korhogo',
                    'type' => $bien->type_bien,
                    'prix' => $bien->prix,
                    'statut' => $bien->statut === 'active' ? 'Publiée' : ucfirst($bien->statut),
                    'status_badge' => $bien->statut === 'active' ? 'badge-teal' : 'badge-muted',
                    'vues' => $bien->vues ?? 0,
                    'date' => $bien->created_at ? $bien->created_at->format('d/m/Y') : '',
                ];
            });

        // Activités récentes basées sur les annonces
        $recentActivities = (clone $annoncesQuery)
            ->latest()
            ->take(4)
            ->get()
            ->map(function ($annonce) {
                return [
                    'color' => 'teal',
                    'text' => 'Annonce : « '.Str::limit($annonce->titre, 35).' »',
                    'time' => $annonce->created_at ? $annonce->created_at->diffForHumans() : 'Récemment',
                ];
            });

        // Messages récents
        $recentMessages = (clone $messagesQuery)
            ->latest()
            ->take(4)
            ->get()
            ->map(function ($c) {
                return [
                    'sender' => trim($c->prenom.' '.$c->nom) ?: 'Visiteur',
                    'contenu' => $c->message,
                    'time' => $c->created_at ? $c->created_at->diffForHumans() : '',
                    'lu' => true,
                ];
            });

        return view('pages.dashboard', compact(
            'user',
            'stats',
            'recentBiens',
            'recentActivities',
            'recentMessages',
            'reservationsRecues'
        ));
    }

    /**
     * Dashboard spécifique pour les profils clients (acquéreurs / locataires).
     */
    protected function clientDashboard(User $user)
    {
        $clientProfile = $user->client;

        // Prises de contact transmises par le client
        $mesDemandes = Contact::where('email', $user->email)
            ->latest()
            ->take(6)
            ->get();

        $totalDemandes = Contact::where('email', $user->email)->count();

        // Réservations de séjour effectuées par le client
        $mesReservations = Reservation::with(['annonce.user.proprietaire', 'annonce.user.agence'])
            ->where(function ($q) use ($user) {
                $q->where('id_user', $user->id);
                if (! empty($user->email)) {
                    $q->orWhere('email', $user->email);
                }
            })
            ->latest()
            ->take(6)
            ->get();

        $totalReservations = Reservation::where(function ($q) use ($user) {
            $q->where('id_user', $user->id);
            if (! empty($user->email)) {
                $q->orWhere('email', $user->email);
            }
        })->count();

        // Statistiques globales du marché pour orienter l'acquéreur
        $statsClient = [
            'total_biens' => Annonce::where('statut', 'active')->count(),
            'total_ventes' => Annonce::where('statut', 'active')->where('type_offre', 'vente')->count(),
            'total_locations' => Annonce::where('statut', 'active')->where('type_offre', 'location')->count(),
            'total_court_sejour' => Annonce::where('statut', 'active')->where(function ($q) {
                $q->where('type_offre', 'court_sejour')
                    ->orWhereIn('type_bien', ['residence_meublee', 'chambre_hotel', 'auberge']);
            })->count(),
            'mes_demandes' => $totalDemandes,
            'mes_reservations' => $totalReservations,
        ];

        // Dernières annonces recommandées à Korhogo
        $annoncesRecommandees = Annonce::where('statut', 'active')
            ->with('user')
            ->latest()
            ->take(6)
            ->get();

        // Quartiers phares avec annonces actives
        $quartiersActifs = Annonce::where('statut', 'active')
            ->whereNotNull('quartier')
            ->selectRaw('quartier, count(*) as total')
            ->groupBy('quartier')
            ->orderByDesc('total')
            ->take(4)
            ->get();

        return view('pages.dashboard-client', compact(
            'user',
            'clientProfile',
            'mesDemandes',
            'mesReservations',
            'statsClient',
            'annoncesRecommandees',
            'quartiersActifs'
        ));
    }
}
