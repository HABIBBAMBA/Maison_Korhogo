<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'nom',
        'telephone',
        'email',
        'message',
        'id_bien',
    ];

    public function bien()
    {
        return $this->belongsTo(Bien::class, 'id_bien');
    }
}
