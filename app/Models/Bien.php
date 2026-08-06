<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bien extends Model
{
    protected $fillable = [
        'titre',
        'description',
        'type_bien',
        'quartier',
        'adresse',
        'prix',
        'nombre_pieces',
        'statut',
        'id_agence',
        'id_proprietaire',
    ];

    // Un bien appartient à UN propriétaire
    public function proprietaire()
    {
        return $this->belongsTo(Proprietaire::class, 'id_proprietaire');
    }

    // Un bien appartient à UNE agence
    public function agence()
    {
        return $this->belongsTo(Agence::class, 'id_agence');
    }

    // Un bien peut avoir PLUSIEURS photos
    public function photos()
    {
        return $this->hasMany(PhotoBien::class, 'id_bien');
    }

    // Un bien peut avoir PLUSIEURS contacts
    public function contacts()
    {
        return $this->hasMany(Contact::class, 'id_bien');
    }
};
