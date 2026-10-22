<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_annonce',
        'id_user',
        'nom_client',
        'telephone',
        'email',
        'date_arrivee',
        'date_depart',
        'nombre_nuits',
        'nombre_personnes',
        'prix_total_estime',
        'demandes_particulieres',
        'statut',
    ];

    protected $casts = [
        'date_arrivee' => 'date',
        'date_depart' => 'date',
        'nombre_nuits' => 'integer',
        'nombre_personnes' => 'integer',
        'prix_total_estime' => 'decimal:2',
    ];

    // ─── Relations ───
    public function annonce(): BelongsTo
    {
        return $this->belongsTo(Annonce::class, 'id_annonce');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // ─── Accesseurs ───
    public function getPrixTotalFormateAttribute(): string
    {
        return number_format($this->prix_total_estime, 0, ',', '.').' FCFA';
    }

    public function getPeriodeFormateeAttribute(): string
    {
        $arrivee = Carbon::parse($this->date_arrivee)->translatedFormat('d M Y');
        $depart = Carbon::parse($this->date_depart)->translatedFormat('d M Y');

        return "Du {$arrivee} au {$depart}";
    }

    public function getStatutLabelAttribute(): string
    {
        return match ($this->statut) {
            'en_attente' => 'En attente',
            'confirmee' => 'Confirmée',
            'refusee' => 'Refusée',
            'annulee' => 'Annulée',
            'terminee' => 'Terminée',
            default => ucfirst(str_replace('_', ' ', $this->statut)),
        };
    }

    public function getStatutBadgeClassAttribute(): string
    {
        return match ($this->statut) {
            'confirmee' => 'badge-success',
            'en_attente' => 'badge-warning',
            'refusee', 'annulee' => 'badge-danger',
            'terminee' => 'badge-neutral',
            default => 'badge-neutral',
        };
    }
}
