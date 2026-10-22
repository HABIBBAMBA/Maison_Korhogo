<?php

namespace Database\Seeders;

use App\Models\Bien;
use Illuminate\Database\Seeder;

class BienSeeder extends Seeder
{
    public function run(): void
    {
        $biens = [
            [
                'titre' => 'Villa moderne à Cocody',
                'description' => 'Magnifique villa de 5 chambres avec piscine et jardin.',
                'type_bien' => 'maison',
                'quartier' => 'Cocody Angre',
                'adresse' => 'Cocody, Abidjan',
                'prix' => 85000000,
                'nombre_pieces' => 5,
                'statut' => 'disponible',
                'id_agence' => 1,
                'id_proprietaire' => 1,
            ],
            [
                'titre' => 'Appartement standing Plateau',
                'description' => 'Appartement 3 chambres au coeur du Plateau, vue mer.',
                'type_bien' => 'appartement',
                'quartier' => 'Plateau',
                'adresse' => 'Plateau, Abidjan',
                'prix' => 45000000,
                'nombre_pieces' => 3,
                'statut' => 'disponible',
                'id_agence' => 1,
                'id_proprietaire' => null,
            ],
            [
                'titre' => 'Terrain 500m² à Bingerville',
                'description' => 'Terrain titré, constructible, proche route principale.',
                'type_bien' => 'terrain',
                'quartier' => 'Bingerville centre',
                'adresse' => 'Bingerville',
                'prix' => 15000000,
                'nombre_pieces' => 0,
                'statut' => 'disponible',
                'id_agence' => null,
                'id_proprietaire' => 1,
            ],
        ];

        foreach ($biens as $bien) {
            Bien::create($bien);
        }
    }
}
