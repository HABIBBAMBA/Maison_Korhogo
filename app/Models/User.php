<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

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

    // Un utilisateur peut avoir plusieurs annonces
    public function annonces()
    {
        return $this->hasMany(Annonce::class, 'id_user');
    }

    // Un utilisateur peut avoir plusieurs réservations (en tant que voyageur)
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'id_user');
    }

    // ---- MÉTHODES UTILES ----

    public function estAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isAdmin(): bool
    {
        return $this->estAdmin();
    }

    public function estAgence(): bool
    {
        return $this->role === 'agence';
    }

    public function isAgence(): bool
    {
        return $this->estAgence();
    }

    public function estProprietaire(): bool
    {
        return $this->role === 'proprietaire';
    }

    public function isProprietaire(): bool
    {
        return $this->estProprietaire();
    }

    public function estClient(): bool
    {
        return $this->role === 'client';
    }

    public function isClient(): bool
    {
        return $this->estClient();
    }

    public function peutPublierAnnonce(): bool
    {
        return in_array($this->role, ['proprietaire', 'agence', 'admin'], true);
    }
}
