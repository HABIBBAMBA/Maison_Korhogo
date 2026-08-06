<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AnnonceController;
use App\Models\Annonce;
use Illuminate\Support\Facades\Route;

// ===========================
//  PAGE D'ACCUEIL (avec données)
// ===========================
Route::get('/', function () {
    $annoncesRecentes = Annonce::with('user')
        ->where('statut', 'active')
        ->latest()
        ->limit(8)
        ->get();

    $stats = [
        'total'    => Annonce::where('statut', 'active')->count(),
        'vente'    => Annonce::where('statut', 'active')->where('type_offre', 'vente')->count(),
        'location' => Annonce::where('statut', 'active')->where('type_offre', 'location')->count(),
    ];

    return view('pages.home', compact('annoncesRecentes', 'stats'));
})->name('home');

// ===========================
//  PAGES PUBLIQUES
// ===========================
Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::get('/biens', function () {
    return view('pages.biens.index');
})->name('biens.index');

// ===========================
//  AUTHENTIFICATION
// ===========================
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ===========================
//  DASHBOARD (protégé)
// ===========================
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        return view('pages.dashboard', compact('user'));
    })->name('dashboard');
});

// ═══════════════════════════════════════
//  ROUTES ANNONCES
// ═══════════════════════════════════════

// Pages publiques
Route::get('/annonces', [AnnonceController::class, 'index'])
    ->name('annonces.index');

Route::get('/annonces/{annonce}', [AnnonceController::class, 'show'])
    ->name('annonces.show');

// Pages protégées
Route::middleware('auth')->group(function () {

    Route::get('/mes-annonces', [AnnonceController::class, 'myAnnonces'])
        ->name('annonces.mes-annonces');

    Route::get('/annonces/create/new', [AnnonceController::class, 'create'])
        ->name('annonces.create');

    Route::post('/annonces', [AnnonceController::class, 'store'])
        ->name('annonces.store');

    Route::get('/annonces/{annonce}/edit', [AnnonceController::class, 'edit'])
        ->name('annonces.edit');

    Route::put('/annonces/{annonce}', [AnnonceController::class, 'update'])
        ->name('annonces.update');

    Route::delete('/annonces/{annonce}', [AnnonceController::class, 'destroy'])
        ->name('annonces.destroy');
});
