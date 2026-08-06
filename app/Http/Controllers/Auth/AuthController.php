<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Client;
use App\Models\Proprietaire;
use App\Models\Agence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    // ==========================================a
    //  AFFICHER LE FORMULAIRE D'INSCRIPTION
    // ==========================================
    public function showRegisterForm()
    {
        return view('auth.register', [
            'message' => session('message', 'Connectez-vous pour envoyer un message.'),
        ]);
    }
    // ==========================================
    //  TRAITEMENT DE L'INSCRIPTION
    // ==========================================
    public function register(Request $request)
    {
        $validated = $request->validate([
            'role'             => ['required', 'in:client,proprietaire,agence'],
            'nom'              => ['required_unless:role,agence', 'nullable', 'string', 'max:255'],
            'prenom'           => ['required_if:role,client,proprietaire', 'nullable', 'string', 'max:255'],
            'telephone'        => ['nullable', 'string', 'max:20'],
            'nom_agence'       => ['required_if:role,agence', 'nullable', 'string', 'max:255'],
            'nom_responsable'  => ['required_if:role,agence', 'nullable', 'string', 'max:255'],
            'email'            => ['required', 'email', 'unique:users,email'],
            'password'         => ['required', 'confirmed', Password::min(8)],
        ], [
            // ── Rôle ──
            'role.required'               => 'Veuillez sélectionner un type de compte.',
            'role.in'                     => 'Le type de compte sélectionné est invalide.',

            // ── Champs personne ──
            'nom.required_unless'         => 'Le nom est obligatoire.',
            'nom.string'                  => 'Le nom doit être une chaîne de caractères.',
            'nom.max'                     => 'Le nom ne peut pas dépasser 255 caractères.',
            'prenom.required_if'          => 'Le prénom est obligatoire pour un client ou un propriétaire.',
            'prenom.string'               => 'Le prénom doit être une chaîne de caractères.',
            'prenom.max'                  => 'Le prénom ne peut pas dépasser 255 caractères.',

            // ── Champs agence ──
            'nom_agence.required_if'      => 'Le nom de l\'agence est obligatoire.',
            'nom_agence.string'           => 'Le nom de l\'agence doit être valide.',
            'nom_agence.max'              => 'Le nom de l\'agence ne peut pas dépasser 255 caractères.',
            'nom_responsable.required_if' => 'Le nom du responsable est obligatoire.',
            'nom_responsable.string'      => 'Le nom du responsable doit être valide.',
            'nom_responsable.max'         => 'Le nom du responsable ne peut pas dépasser 255 caractères.',

            // ── Téléphone ──
            'telephone.string'            => 'Le numéro de téléphone doit être valide.',
            'telephone.max'               => 'Le numéro de téléphone est trop long.',

            // ── Email ──
            'email.required'              => 'L\'adresse email est obligatoire.',
            'email.email'                 => 'Veuillez saisir une adresse email valide.',
            'email.unique'                => 'Cette adresse email est déjà utilisée par un autre compte.',

            // ── Mot de passe ──
            'password.required'           => 'Le mot de passe est obligatoire.',
            'password.confirmed'          => 'Les deux mots de passe ne correspondent pas.',
            'password.min'                => 'Le mot de passe doit contenir au moins :min caractères.',
        ]);

        // ═══ Déterminer le nom d'affichage selon le rôle ═══
        $userName = match ($validated['role']) {
            'agence' => $validated['nom_agence'],
            default  => trim(($validated['prenom'] ?? '') . ' ' . ($validated['nom'] ?? '')),
        };

        $user = User::create([
            'name'     => $userName,
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => $validated['role'],
        ]);

        // Créer le profil selon le rôle
        match ($validated['role']) {
            'client' => Client::create([
                'nom'       => $validated['nom'],
                'prenom'    => $validated['prenom'],
                'telephone' => $validated['telephone'] ?? null,
                'id_user'   => $user->id,
            ]),
            'proprietaire' => Proprietaire::create([
                'nom'       => $validated['nom'],
                'prenom'    => $validated['prenom'],
                'telephone' => $validated['telephone'] ?? null,
                'id_user'   => $user->id,
            ]),
            'agence' => Agence::create([
                'nom_agence'      => $validated['nom_agence'],
                'nom_responsable' => $validated['nom_responsable'],
                'telephone'       => $validated['telephone'] ?? null,
                'id_user'         => $user->id,
            ]),
        };

        Auth::login($user);

        return redirect()->route('dashboard')
            ->with('success', 'Bienvenue ! Votre compte a été créé avec succès.');
    }

    // ==========================================
    //  AFFICHER LE FORMULAIRE DE CONNEXION
    // ==========================================
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // ==========================================
    //  TRAITEMENT DE LA CONNEXION
    // ==========================================
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => 'L\'email est obligatoire.',
            'email.email'       => 'Format d\'email invalide.',
            'password.required' => 'Le mot de passe est obligatoire.',
        ]);

        // Tentative de connexion
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'))
                ->with('success', 'Connexion réussie !');
        }

        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect.',
        ])->onlyInput('email');
    }

    // ==========================================
    //  DÉCONNEXION
    // ==========================================
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with('success', 'Vous êtes déconnecté.');
    }
}
