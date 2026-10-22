<?php

namespace Tests\Feature;

use App\Models\Annonce;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_displays_user_stats_and_recent_biens()
    {
        $user = User::factory()->create([
            'role' => 'proprietaire',
        ]);

        $annonce = Annonce::create([
            'titre' => 'Villa Moderne Korhogo',
            'description' => 'Superbe villa avec jardin et garage au quartier Résidentiel.',
            'type_bien' => 'maison',
            'type_offre' => 'location',
            'categorie' => 'location',
            'prix' => 150000,
            'quartier' => 'Koko',
            'adresse' => 'Rue 12',
            'date_disponibilite' => now()->format('Y-m-d'),
            'statut' => 'active',
            'vues' => 42,
            'id_user' => $user->id,
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Villa Moderne Korhogo');
        $response->assertSee('42'); // Vues
        $response->assertSee('Biens publiés');
        $response->assertSee('Propriétaire Bailleur');
        $response->assertDontSee('Espace Client / Acquéreur');
    }

    public function test_dashboard_renders_for_agence()
    {
        $agence = User::factory()->create([
            'role' => 'agence',
        ]);

        $response = $this->actingAs($agence)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Agence Immobilière');
        $response->assertSee('Biens publiés');
        $response->assertDontSee('Espace Client / Acquéreur');
    }

    public function test_dashboard_renders_for_admin()
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Administrateur Système');
        $response->assertSee('Utilisateurs inscrits');
        $response->assertSee('Gestion des utilisateurs');
        $response->assertSee('Gestion des agences');
        $response->assertDontSee('Explorer le marché');
    }

    public function test_dashboard_renders_for_client_with_custom_view()
    {
        $client = User::factory()->create([
            'name' => 'Amadou Diallo',
            'role' => 'client',
        ]);

        $response = $this->actingAs($client)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Espace Client / Acquéreur');
        $response->assertSee('Amadou Diallo');
        $response->assertSee('Biens certifiés disponibles');
        $response->assertSee('Prises de contact effectuées');
        $response->assertSee('Recherche directe par type de bien');

        // Ne doit pas voir les contrôles des propriétaires et agences
        $response->assertDontSee('Propriétaire Bailleur');
        $response->assertDontSee('Biens publiés');
        $response->assertDontSee('Total des vues');
    }
}
