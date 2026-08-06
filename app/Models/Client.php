<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'id_user',
    ];

    // Un client appartient à UN utilisateur
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
