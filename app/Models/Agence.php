<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agence extends Model
{
    protected $fillable = [
        'nom_agence',
        'nom_responsable',
        'telephone',
        'adresse',
        'logo',
        'id_user',
    ];

    // Une agence appartient à UN utilisateur
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Une agence possède PLUSIEURS biens
    public function biens()
    {
        return $this->hasMany(Bien::class, 'id_agence');
    }
}
