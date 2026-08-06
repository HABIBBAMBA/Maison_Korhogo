<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')
            ->stateless()
            ->with([
                'access_type' => 'offline',
                'prompt'      => 'consent select_account',
            ])
            ->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Cherche l'utilisateur existant
            $user = User::where('google_id', $googleUser->getId())->first();

            if (!$user) {
                $user = User::where('email', $googleUser->getEmail())->first();

                if ($user) {
                    $user->update([
                        'google_id'        => $googleUser->getId(),
                        'auth_provider'     => 'google',
                        'avatar'           => $googleUser->getAvatar(),
                        'email_verified_at' => now(),
                    ]);
                } else {
                    $user = User::create([
                        'name'              => $googleUser->getName() ?? $googleUser->getNickname(),
                        'email'             => $googleUser->getEmail(),
                        'google_id'         => $googleUser->getId(),
                        'auth_provider'     => 'google',
                        'avatar'            => $googleUser->getAvatar(),
                        'email_verified_at' => now(),
                        'password'          => null,
                    ]);
                }
            }

            Auth::login($user, remember: true);

            return redirect()->intended('/dashboard');
        } catch (\Exception $e) {
            return redirect('/login')->withErrors([
                'google' => 'Erreur : ' . $e->getMessage(),
            ]);
        }
    }
}
