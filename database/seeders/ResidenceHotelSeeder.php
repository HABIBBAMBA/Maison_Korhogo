<?php

namespace Database\Seeders;

use App\Models\Annonce;
use App\Models\User;
use Illuminate\Database\Seeder;

class ResidenceHotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Enregistre 3 résidences meublées et 3 chambres d'hôtel à Korhogo et ses environs
     * pour le module de court séjour et réservation.
     */
    public function run(): void
    {
        // Récupérer un utilisateur autorisé à publier (agence ou propriétaire)
        $agence = User::where('role', 'agence')->first();
        $proprietaire = User::where('role', 'proprietaire')->first();

        // Repli si les seeders précédents n'ont pas été lancés
        $defaultUserId = $agence?->id ?? $proprietaire?->id ?? User::first()?->id ?? 1;
        $agenceUserId = $agence?->id ?? $defaultUserId;
        $proprioUserId = $proprietaire?->id ?? $defaultUserId;

        $hebergements = [
            // ═════════════════════════════════════════════════════════════════════════
            // 3 RÉSIDENCES MEUBLÉES
            // ═════════════════════════════════════════════════════════════════════════
            [
                'titre' => 'Résidence Les Palmiers — Villa VIP 4 Pièces',
                'description' => 'Superbe villa meublée climatisée située dans le quartier le plus paisible et sécurisé de Korhogo. Idéale pour séjours professionnels, délégations gouvernementales ou vacances en famille. Grand salon moderne avec Smart TV grand écran et bouquet Canal+, 3 chambres autonomes avec literie grand confort, cuisine américaine entièrement équipée (réfrigérateur, gazinière, micro-ondes), groupe électrogène automatique et gardiennage 24h/24.',
                'type_bien' => 'residence_meublee',
                'type_offre' => 'court_sejour',
                'categorie' => 'court_sejour',
                'prix' => 45000,
                'superficie' => 165,
                'nombre_pieces' => 4,
                'nombre_chambres' => 3,
                'nombre_salles_bain' => 3,
                'capacite_voyageurs' => 6,
                'adresse' => 'Boulevard Félix Houphouët-Boigny, face Résidence du Préfet',
                'quartier' => 'Quartier Résidentiel',
                'statut' => 'active',
                'date_disponibilite' => now()->toDateString(),
                'id_user' => $agenceUserId,
                'vues' => 142,
                'equipements' => [
                    'wifi',
                    'climatisation',
                    'canal_plus',
                    'groupe_electrogene',
                    'cuisine_equipee',
                    'parking_securise',
                    'gardien_24_7',
                    'service_menage',
                    'chauffe_eau',
                    'refrigerateur',
                    'terrasse',
                    'jardin',
                ],
                'images' => [
                    'annonces/0l5sKg3JNoh4CfvSIKZHHuNp7i7ErXEBb9o76xkZ.jpg',
                    'annonces/3zHeCRxlMl9li03CJuY9iDhSFTKADHd1oAlJaI2k.jpg',
                    'annonces/4oFWl4RN3XopkRiriqMvQM68RWumF4FjQBteNrsh.jpg',
                ],
            ],
            [
                'titre' => 'Résidence Meublée Le Poro — Appartement Standing 3 Pièces',
                'description' => "Appartement meublé haut de gamme au design épuré et contemporain, situé à 5 minutes du centre-ville et de l'université de Korhogo. Salon lumineux avec espace salle à manger, cuisine équipée avec tous les ustensiles, deux chambres climatisées avec dressings intégrés. Connexion internet WiFi fibre optique très haut débit, idéal pour consultants, universitaires ou séjours d'affaires.",
                'type_bien' => 'residence_meublee',
                'type_offre' => 'court_sejour',
                'categorie' => 'court_sejour',
                'prix' => 30000,
                'superficie' => 95,
                'nombre_pieces' => 3,
                'nombre_chambres' => 2,
                'nombre_salles_bain' => 2,
                'capacite_voyageurs' => 4,
                'adresse' => 'Avenue Université Péléforo Gon Coulibaly',
                'quartier' => 'Quartier 14',
                'statut' => 'active',
                'date_disponibilite' => now()->toDateString(),
                'id_user' => $proprioUserId,
                'vues' => 98,
                'equipements' => [
                    'wifi',
                    'climatisation',
                    'canal_plus',
                    'groupe_electrogene',
                    'cuisine_equipee',
                    'parking_securise',
                    'gardien_24_7',
                    'service_menage',
                    'refrigerateur',
                    'chauffe_eau',
                ],
                'images' => [
                    'annonces/Bk41C1JXbbSj1l8VRZBUq0BBzRB9MU8Cbl5U5Ecm.jpg',
                    'annonces/EDDIyGFFXjaJJcgjRTxFvl5B8nSfkDMpRedzKEOl.jpg',
                    'annonces/GE3olXQUp5A0XLgTCZsGAmnAemrZcfFOWaW8JRrF.jpg',
                ],
            ],
            [
                'titre' => 'Résidence Kaha — Studio Meublé Cosy Prestige',
                'description' => "Charmant studio tout équipé, décoré avec soin aux touches artisanales locales. Parfait pour une personne seule ou un couple en séjour de courte ou moyenne durée. Lit double king-size de grande qualité, kitchenette moderne avec plaque de cuisson et vaisselle, salle d'eau privative avec douche à l'italienne et eau chaude, climatisation silencieuse, WiFi illimité et bouquet TV complet.",
                'type_bien' => 'residence_meublee',
                'type_offre' => 'court_sejour',
                'categorie' => 'court_sejour',
                'prix' => 20000,
                'superficie' => 45,
                'nombre_pieces' => 2,
                'nombre_chambres' => 1,
                'nombre_salles_bain' => 1,
                'capacite_voyageurs' => 2,
                'adresse' => 'Carrefour Sinistré, proche marché de gros',
                'quartier' => 'Quartier Sinistré',
                'statut' => 'active',
                'date_disponibilite' => now()->toDateString(),
                'id_user' => $proprioUserId,
                'vues' => 64,
                'equipements' => [
                    'wifi',
                    'climatisation',
                    'canal_plus',
                    'cuisine_equipee',
                    'refrigerateur',
                    'chauffe_eau',
                    'service_menage',
                    'gardien_24_7',
                ],
                'images' => [
                    'annonces/I1xMsvAHm690e0GlcK6We8DAsWMJ7V19jvHcMpK9.jpg',
                    'annonces/MMIhXbmvhzqlRqXPbxCzNGV5ShXnhSkJ6JFXNYxw.jpg',
                ],
            ],

            // ═════════════════════════════════════════════════════════════════════════
            // 3 HÔTELS / CHAMBRES D'HÔTEL
            // ═════════════════════════════════════════════════════════════════════════
            [
                'titre' => 'Hôtel Mont Korhogo — Suite Junior Panoramique',
                'description' => "Suite Junior haut de gamme avec vue panoramique imprenable sur le Mont Korhogo. Dotée d'un grand lit King-Size à mémoire de forme, d'un salon de détente privé, d'un minibar garni, d'un coffre-fort électronique et d'une salle de bain en marbre avec baignoire et douche séparées. Petit-déjeuner buffet continental inclus, accès à la piscine de l'hôtel, service en chambre et conciergerie 24h/24.",
                'type_bien' => 'chambre_hotel',
                'type_offre' => 'court_sejour',
                'categorie' => 'court_sejour',
                'prix' => 55000,
                'superficie' => 55,
                'nombre_pieces' => 2,
                'nombre_chambres' => 1,
                'nombre_salles_bain' => 1,
                'capacite_voyageurs' => 2,
                'adresse' => 'Au pied du Mont Korhogo, Route de Dikodougou',
                'quartier' => 'Mont Korhogo',
                'statut' => 'active',
                'date_disponibilite' => now()->toDateString(),
                'id_user' => $agenceUserId,
                'vues' => 210,
                'equipements' => [
                    'wifi',
                    'climatisation',
                    'canal_plus',
                    'petit_dejeuner',
                    'piscine',
                    'parking_securise',
                    'groupe_electrogene',
                    'refrigerateur',
                    'service_menage',
                    'repassage',
                    'gardien_24_7',
                ],
                'images' => [
                    'annonces/MQJaFno8Dv1IzMQIJ8hf93G4dgCvGUmTH0LcWpuS.jpg',
                    'annonces/Ov9BWEXBS8AtHihFFS5sM1pnCp8JWP2mCQBTJhAn.jpg',
                    'annonces/PVzXU1LD93T23mp1yUVWyEXdclcIKYsY3QtmGnIz.jpg',
                ],
            ],
            [
                'titre' => 'Hôtel La Rose Blanche — Chambre Deluxe Exécutive',
                'description' => "Chambre Deluxe raffinée au cœur du centre d'affaires de Korhogo, à deux pas des institutions administratives et bancaires. Aménagée avec un grand lit double prestige, un bureau de travail ergonomique avec prises internationales, connexion WiFi ultra-rapide sécurisée, Smart TV HD, climatisation réversible et minibar. Idéale pour séminaires, consultants et voyageurs d'affaires.",
                'type_bien' => 'chambre_hotel',
                'type_offre' => 'court_sejour',
                'categorie' => 'court_sejour',
                'prix' => 35000,
                'superficie' => 36,
                'nombre_pieces' => 1,
                'nombre_chambres' => 1,
                'nombre_salles_bain' => 1,
                'capacite_voyageurs' => 2,
                'adresse' => 'Rue du Commerce, face Cathédrale Saint-Jean',
                'quartier' => 'Centre-Ville',
                'statut' => 'active',
                'date_disponibilite' => now()->toDateString(),
                'id_user' => $agenceUserId,
                'vues' => 175,
                'equipements' => [
                    'wifi',
                    'climatisation',
                    'canal_plus',
                    'petit_dejeuner',
                    'groupe_electrogene',
                    'parking_securise',
                    'service_menage',
                    'gardien_24_7',
                    'refrigerateur',
                ],
                'images' => [
                    'annonces/TZI5jGvJCbZUXJ3NyHDgbxNVRXox29YH3sY9oDcM.jpg',
                    'annonces/UG6nRL1aE9XzF6DWbraXQ58uMyTRfBc0pdSrU4gQ.jpg',
                ],
            ],
            [
                'titre' => 'Complexe Hôtelier Le Senufo — Chambre Supérieure & Jardin',
                'description' => "Chambre hôtelière supérieure chaleureuse, nichée dans un grand parc arboré inspiré de l'artisanat Sénoufo traditionnel. Lit double confortable, climatisation individuelle, salle d'eau privative avec douche à l'italienne et eau chaude garantie, télévision par satellite. Accès immédiat au restaurant de spécialités ivoiriennes, à la piscine extérieure du complexe et au bar lounge.",
                'type_bien' => 'chambre_hotel',
                'type_offre' => 'court_sejour',
                'categorie' => 'court_sejour',
                'prix' => 28000,
                'superficie' => 32,
                'nombre_pieces' => 1,
                'nombre_chambres' => 1,
                'nombre_salles_bain' => 1,
                'capacite_voyageurs' => 2,
                'adresse' => 'Boulevard Circulaire Est, carrefour Natio',
                'quartier' => 'Natio Kobadara',
                'statut' => 'active',
                'date_disponibilite' => now()->toDateString(),
                'id_user' => $proprioUserId,
                'vues' => 118,
                'equipements' => [
                    'wifi',
                    'climatisation',
                    'canal_plus',
                    'piscine',
                    'petit_dejeuner',
                    'parking_securise',
                    'gardien_24_7',
                    'service_menage',
                    'repassage',
                ],
                'images' => [
                    'annonces/YZcUt8OjXwBMo04Zd6zanJctVoZfYaZIjxU8OMXV.jpg',
                    'annonces/Z691D7BEVg9sZVz3SZC9Umtl8gdd85BJl1cTmGh4.jpg',
                ],
            ],
        ];

        foreach ($hebergements as $data) {
            Annonce::updateOrCreate(
                ['titre' => $data['titre']],
                $data
            );
        }
    }
}
