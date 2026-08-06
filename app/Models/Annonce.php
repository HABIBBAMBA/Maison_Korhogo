<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Annonce extends Model
{
    protected $fillable = [
        'titre',
        'description',
        'type_bien',
        'type_offre',
        'categorie',
        'prix',
        'superficie',
        'nombre_pieces',
        'nombre_chambres',
        'nombre_salles_bain',
        'adresse',
        'ville',          // ← AJOUTÉ
        'quartier',
        'images',
        'equipements',
        'statut',
        'date_disponibilite',
        'id_user',
    ];

    protected $casts = [
        'images' => 'array',
        'equipements' => 'array',
    ];

    // ─── Relations ───
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // ─── Accesseurs ───
    public function getPrixFormateAttribute(): string
    {
        return number_format($this->prix, 0, ',', '.') . ' FCFA';
    }

    public function getPremiereImageAttribute(): string
    {
        if ($this->images && count($this->images) > 0) {
            return asset('storage/' . $this->images[0]);
        }
        return asset('images/placeholder-maison.jpg');
    }

    public function getNombreImagesAttribute(): int
    {
        return $this->images ? count($this->images) : 0;
    }

    public function getExcerptAttribute(): string
    {
        return \Str::limit($this->description, 120);
    }
}
