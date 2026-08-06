<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Agence;
use App\Models\Proprietaire;
use App\Models\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // === ADMIN ===
        $admin = User::create([
            'name'     => 'Admin',
            'email'    => 'admin@immobilier.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // === AGENCE ===
        $agenceUser = User::create([
            'name'     => 'Immobilier Plus',
            'email'    => 'agence@immobilier.com',
            'password' => Hash::make('password'),
            'role'     => 'agence',
        ]);

        Agence::create([
            'nom_agence' => 'Immobilier Plus',
            'telephone'  => '+225 0700000001',
            'adresse'    => 'Abidjan, Plateau',
            'logo'       => null,
            'id_user'    => $agenceUser->id,
        ]);

        // === PROPRIETAIRE ===
        $proprioUser = User::create([
            'name'     => 'Moussa Koné',
            'email'    => 'proprietaire@immobilier.com',
            'password' => Hash::make('password'),
            'role'     => 'proprietaire',
        ]);

        Proprietaire::create([
            'nom'       => 'Koné',
            'prenom'    => 'Moussa',
            'telephone' => '+225 0700000002',
            'adresse'   => 'Abidjan, Cocody',
            'id_user'   => $proprioUser->id,
        ]);

        // === CLIENT ===
        $clientUser = User::create([
            'name'     => 'Aminata Diallo',
            'email'    => 'client@immobilier.com',
            'password' => Hash::make('password'),
            'role'     => 'client',
        ]);

        Client::create([
            'nom'       => 'Diallo',
            'prenom'    => 'Aminata',
            'telephone' => '+225 0700000003',
            'id_user'   => $clientUser->id,
        ]);
    }
}
