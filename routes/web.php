<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AgenceController;
use App\Http\Controllers\Admin\BienController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Models\Annonce;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

// ===========================
//  PAGE D'ACCUEIL (avec données)
// ===========================
Route::get('/', function () {
    $annoncesRecentes = Annonce::with('user')
        ->where('statut', 'active')
        ->latest()
        ->limit(8)
        ->get();

    $heroPhotos = collect(Storage::disk('public')->files('hero'))
        ->filter(fn (string $path) => in_array(strtolower(pathinfo($path, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'webp'], true))
        ->sort()
        ->map(fn (string $path) => '/storage/'.$path)
        ->values();

    $stats = [
        'total' => Annonce::where('statut', 'active')->count(),
        'vente' => Annonce::where('statut', 'active')->where('type_offre', 'vente')->count(),
        'location' => Annonce::where('statut', 'active')->where('type_offre', 'location')->count(),
        'court_sejour' => Annonce::where('statut', 'active')->where(function ($q) {
            $q->where('type_offre', 'court_sejour')
                ->orWhereIn('type_bien', ['residence_meublee', 'chambre_hotel', 'auberge']);
        })->count(),
    ];

    return view('pages.home', compact('annoncesRecentes', 'heroPhotos', 'stats'));
})->name('home');

// ===========================
//  PAGES PUBLIQUES
// ===========================
Route::get('/apropos', function () {
    return view('pages.apropos.index');
})->name('apropos');

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
    Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:5,1');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ===========================
//  DASHBOARD (protégé)
// ===========================
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');
});

// ═══════════════════════════════════════
//  ROUTES ANNONCES
// ═══════════════════════════════════════

// Pages publiques
Route::get('/annonces', [AnnonceController::class, 'index'])
    ->name('annonces.index');

Route::get('/annonces/{annonce}', [AnnonceController::class, 'show'])
    ->name('annonces.show');

// Pages protégées de gestion des annonces (réservées aux propriétaires, agences et admins)
Route::middleware(['auth', 'role:proprietaire,agence,admin'])->group(function () {

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
// ═══════════════════════════════════════
//  ROUTES CONTACTS
// ═══════════════════════════════════════

Route::middleware('auth')->group(function () {
    Route::get('/annonces/{annonce}/contact', [ContactController::class, 'create'])
        ->name('contacts.create');

    Route::post('/contacts', [ContactController::class, 'store'])
        ->name('contacts.store')
        ->middleware('throttle:10,1');
});

// Dashboard protégé
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/contacts', [ContactController::class, 'index'])
        ->name('contacts.index');

    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])
        ->name('contacts.destroy');
});

// ═══════════════════════════════════════
//  ROUTES RÉSERVATIONS (HÔTELS & RÉSIDENCES)
// ═══════════════════════════════════════
Route::post('/reservations', [ReservationController::class, 'store'])
    ->name('reservations.store')
    ->middleware('throttle:10,1');

Route::middleware('auth')->group(function () {
    Route::patch('/reservations/{reservation}/statut', [ReservationController::class, 'updateStatut'])
        ->name('reservations.update-statut');

    Route::patch('/reservations/{reservation}/annuler', [ReservationController::class, 'cancel'])
        ->name('reservations.cancel');
});

// ═══════════════════════════════════════
//  ROUTES AUTH GOOGLE
// ═══════════════════════════════════════

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

// ═══════════════════════════════════════
// ADMIN — Routes protégées par rôle admin
// ═══════════════════════════════════════
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard admin
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Utilisateurs
    Route::resource('users', UserController::class);

    // Biens
    Route::resource('biens', BienController::class);

    // Agences
    Route::resource('agences', AgenceController::class);
});
