<?php

namespace Tests\Feature;

use App\Models\Annonce;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaginationTest extends TestCase
{
    use RefreshDatabase;

    public function test_annonces_index_renders_custom_styled_pagination(): void
    {
        $user = User::create([
            'name' => 'Agence Test',
            'email' => 'test-agence@example.com',
            'password' => bcrypt('password'),
            'role' => 'agence',
        ]);

        for ($i = 1; $i <= 15; $i++) {
            Annonce::create([
                'titre' => "Maison Test {$i}",
                'description' => "Description de test {$i}",
                'type_bien' => 'maison',
                'type_offre' => 'vente',
                'prix' => 25000000 + ($i * 1000000),
                'quartier' => 'Centre-ville',
                'statut' => 'active',
                'id_user' => $user->id,
            ]);
        }

        $response = $this->get(route('annonces.index'));

        $response->assertStatus(200);
        $response->assertSee('immopro-pagination', false);
        $response->assertSee('Affichage de', false);
        $response->assertSee('sur', false);
        $response->assertSee('résultats', false);
        $response->assertDontSee('Showing 1 to 12 of 15 results', false);
        $response->assertDontSee('&laquo; Previous', false);
    }
}
