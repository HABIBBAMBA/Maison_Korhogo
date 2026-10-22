<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'quartier',
        'images',
        'equipements',
        'statut',
        'date_disponibilite',
        'capacite_voyageurs',
        'id_user',
        'vues',
    ];

    protected $casts = [
        'images' => 'array',
        'equipements' => 'array',
        'vues' => 'integer',
        'capacite_voyageurs' => 'integer',
    ];

    // ─── Relations ───
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'id_annonce');
    }

    // ─── Court Séjour / Hôtellerie Helpers ───
    public function isCourtSejour(): bool
    {
        return $this->type_offre === 'court_sejour'
            || in_array($this->type_bien, ['residence_meublee', 'chambre_hotel', 'auberge'], true);
    }

    public function getTarifUniteAttribute(): string
    {
        if ($this->isCourtSejour()) {
            return '/ nuit';
        }

        if ($this->type_offre === 'location') {
            return '/ mois';
        }

        return '';
    }

    public function getTypeBienLabelAttribute(): string
    {
        return match ($this->type_bien) {
            'residence_meublee' => 'Résidence Meublée',
            'chambre_hotel' => 'Chambre d\'Hôtel',
            'auberge' => 'Auberge / Gîte',
            'villa' => 'Villa',
            'appartement' => 'Appartement',
            'maison' => 'Maison',
            'terrain' => 'Terrain',
            'bureau' => 'Bureau',
            'commerce' => 'Commerce',
            'entrepot' => 'Entrepôt',
            'magasin' => 'Magasin',
            'chambre' => 'Chambre',
            default => ucfirst(str_replace('_', ' ', (string) $this->type_bien)),
        };
    }

    // ─── Accesseurs ───
    public function getPrixFormateAttribute(): string
    {
        $montant = number_format($this->prix, 0, ',', '.').' FCFA';
        $unite = $this->tarif_unite;

        return $unite ? "{$montant} {$unite}" : $montant;
    }

    public function getPrixMontantSeulAttribute(): string
    {
        return number_format($this->prix, 0, ',', '.').' FCFA';
    }

    public function getPremiereImageAttribute(): string
    {
        if ($this->images && count($this->images) > 0) {
            return asset('storage/'.$this->images[0]);
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

    public static function labelsEquipements(): array
    {
        return [
            // Hébergement Court Séjour & Résidences
            'wifi' => 'Internet / WiFi Haut Débit',
            'canal_plus' => 'Télévision Écran Plat / Canal+',
            'groupe_electrogene' => 'Groupe électrogène de secours 24/7',
            'petit_dejeuner' => 'Petit-déjeuner inclus / disponible',
            'service_menage' => 'Service de ménage quotidien',
            'repassage' => 'Blanchisserie / Service repassage',
            'parking_securise' => 'Parking sécurisé / Gardé',
            'refrigerateur' => 'Réfrigérateur / Minibar',
            'gardien_24_7' => 'Gardiennage & Sécurité 24h/24',
            // Maison & Appartement
            'cuisine_equipee' => 'Cuisine équipée / Ustensiles',
            'climatisation' => 'Climatisation',
            'chauffe_eau' => 'Chauffe-eau / Eau chaude',
            'piscine' => 'Piscine privée ou partagée',
            'jardin' => 'Jardin / Cour privée',
            'terrasse' => 'Terrasse / Balcon',
            'garage' => 'Garage fermé',
            'meuble' => 'Entièrement Meublé',
            'gardien' => 'Gardiennage',
            'reservoir_eau' => 'Réservoir d\'eau / Suppresseur',
            'internet' => 'Internet / WiFi',
            'dressing' => 'Dressing',
            'buanderie' => 'Buanderie',
            // Terrain
            'titre_foncier' => 'Titre Foncier / ACD',
            'borne' => 'Terrain borné (Plan de bornage)',
            'eau_sodeci' => 'Viabilisé en eau (SODECI)',
            'electricite_cie' => 'Électrifié (CIE)',
            'cloture' => 'Terrain clôturé',
            'acces_goudron' => 'Accès voie bitumée',
            'terrain_plat' => 'Terrain plat / Décapé',
            'proche_voie_principale' => 'Proche route principale',
            // Bureau & Commerce
            'salle_reunion' => 'Salle de réunion',
            'parking' => 'Parking réservé',
            'controle_acces' => 'Contrôle d\'accès / Badge',
            'sanitaires' => 'Sanitaires privatifs',
            'ascenseur' => 'Ascenseur',
            'vitrine' => 'Vitrine sur rue passante',
            'rideau_metallique' => 'Rideau métallique électrique',
            'compteur_dedie' => 'Compteur électrique dédié',
            'point_eau' => 'Point d\'eau / Sanitaires',
            'reserve' => 'Arrière-boutique / Réserve',
            'videosurveillance' => 'Alarme / Vidéosurveillance',
            // Entrepôt
            'quai_chargement' => 'Quai de chargement',
            'acces_poids_lourds' => 'Accès gros porteurs / Poids lourds',
            'hauteur_plafond' => 'Hauteur sous plafond (> 5m)',
            'sol_renforce' => 'Dalle béton renforcée',
            'triphase' => 'Compteur triphasé / Haute tension',
            'bureau_integre' => 'Bureaux d\'exploitation intégrés',
            'poste_garde' => 'Poste de garde / Guérite',
            'securite_incendie' => 'Système anti-incendie / RIA',
            // Autre
            'eau' => 'Eau courante',
            'electricite' => 'Électricité',
            'acces_facile' => 'Accès facile',
        ];
    }

    public function getEquipementsLabelsAttribute(): array
    {
        $map = self::labelsEquipements();
        $raw = $this->equipements ?? [];

        if (is_string($raw)) {
            $raw = json_decode($raw, true) ?? [];
        }

        if (! is_array($raw)) {
            return [];
        }

        return array_map(fn ($item) => $map[$item] ?? ucfirst(str_replace('_', ' ', (string) $item)), $raw);
    }
}
