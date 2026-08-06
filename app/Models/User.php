<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // ---- RELATIONS ----

    // Un utilisateur peut avoir UN profil agence
    public function agence()
    {
        return $this->hasOne(Agence::class, 'id_user');
    }

    // Un utilisateur peut avoir UN profil propriétaire
    public function proprietaire()
    {
        return $this->hasOne(Proprietaire::class, 'id_user');
    }

    // Un utilisateur peut avoir UN profil client
    public function client()
    {
        return $this->hasOne(Client::class, 'id_user');
    }

    // ---- MÉTHODES UTILES ----

    public function estAdmin()
    {
        return $this->role === 'admin';
    }

    public function estAgence()
    {
        return $this->role === 'agence';
    }

    public function estProprietaire()
    {
        return $this->role === 'proprietaire';
    }

    public function estClient()
    {
        return $this->role === 'client';
    }
}
