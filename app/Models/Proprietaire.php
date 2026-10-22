<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proprietaire extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'adresse',
        'id_user',
    ];

    // Un propriétaire appartient à UN utilisateur
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Un propriétaire possède PLUSIEURS biens
    public function biens()
    {
        return $this->hasMany(Bien::class, 'id_proprietaire');
    }
}
