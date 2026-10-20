<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agence;
use App\Models\Bien;
use App\Models\Contact;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $stats = [
            'total_biens' => Bien::count(),
            'biens_publies' => Bien::where('statut', 'disponible')->count(),
            'total_messages' => Contact::count(),
            'nouveaux_messages' => Contact::where('created_at', '>=', now()->subWeek())->count(),
            'total_users' => User::count(),
            'users_actifs' => User::whereNotNull('email_verified_at')->count(),
            'total_agences' => Agence::count(),
        ];

        $recentBiens = Bien::latest()->take(5)->get()->map(fn ($bien) => [
            'id' => $bien->id,
            'titre' => $bien->titre,
            'type_bien' => $bien->type_bien,
            'prix' => $bien->prix,
            'statut' => $bien->statut,
            'quartier' => $bien->quartier,
            'created_at' => $bien->created_at,
        ]);

        return view('admin.dashboard', [
            'user' => $user,
            'stats' => $stats,
            'recentBiens' => $recentBiens,
        ]);
    }
}
