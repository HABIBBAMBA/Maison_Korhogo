<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Vérifie que l'utilisateur a le bon rôle pour accéder à la page.
     *
     * Usage dans les routes :
     * ->middleware('role:admin')
     * ->middleware('role:agence,proprietaire')  // plusieurs rôles autorisés
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();

        // Si l'utilisateur n'a PAS le rôle requis → accès refusé
        if (!in_array($user->role, $roles)) {
            abort(403, 'Accès non autorisé.');
        }

        return $next($request);
    }
}
