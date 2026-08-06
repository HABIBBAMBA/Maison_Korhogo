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
    // ==========================================
    //  AFFICHER LE FORMULAIRE D'INSCRIPTION
    // ==========================================
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // ==========================================
    //  TRAITEMENT DE L'INSCRIPTION
    // ==========================================
    public function register(Request $request)
    {
        $validated = $request->validate([
            'email'          => 'required|email|unique:users,email',
            'password'       => ['required', 'confirmed', Password::min(8)],
            'role'           => 'required|in:client,proprietaire,agence',
            'nom'            => 'required_unless:role,agence|string|max:255',
            'prenom'         => 'required_if:role,client,proprietaire|string|max:255|nullable',
            'telephone'      => 'nullable|string|max:20',
            'nom_agence'     => 'required_if:role,agence|string|max:255|nullable',
            'nom_responsable' => 'required_if:role,agence|string|max:255|nullable',
        ]);

        // Créer l'utilisateur
        $user = User::create([
            'name'      => $validated['nom'],
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
                'nom_agence'     => $validated['nom_agence'],
                'nom_responsable' => $validated['nom_responsable'],
                'telephone'      => $validated['telephone'] ?? null,
                'id_user'        => $user->id,
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
