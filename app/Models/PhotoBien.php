<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhotoBien extends Model
{
    protected $table = 'photos_biens'; // nom exact de la table

    protected $fillable = [
        'photo',
        'id_bien',
    ];

    public function bien()
    {
        return $this->belongsTo(Bien::class, 'id_bien');
    }
}
