<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AnnonceAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login_when_accessing_create(): void
    {
        $response = $this->get(route('annonces.create'));
        $response->assertRedirect(route('login'));
    }

    public function test_client_cannot_access_create_form(): void
    {
        $client = User::factory()->client()->create();

        $response = $this->actingAs($client)->get(route('annonces.create'));

        $response->assertStatus(403);
    }

    public function test_client_cannot_store_annonce(): void
    {
        $client = User::factory()->client()->create();

        $response = $this->actingAs($client)->post(route('annonces.store'), [
            'type_offre' => 'location',
            'type_bien' => 'appartement',
            'titre' => 'Appartement 2 pièces test',
            'description' => 'Description détaillée de test avec plus de 20 caractères.',
            'prix' => 120000,
            'quartier' => 'Koko',
            'adresse' => 'Rue Principale',
            'date_disponibilite' => now()->format('Y-m-d'),
        ]);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('annonces', [
            'titre' => 'Appartement 2 pièces test',
        ]);
    }

    public function test_client_cannot_access_my_annonces(): void
    {
        $client = User::factory()->client()->create();

        $response = $this->actingAs($client)->get(route('annonces.mes-annonces'));

        $response->assertStatus(403);
    }

    public function test_proprietaire_can_access_create_form(): void
    {
        $proprietaire = User::factory()->proprietaire()->create();

        $response = $this->actingAs($proprietaire)->get(route('annonces.create'));

        $response->assertOk();
    }

    public function test_agence_can_access_create_form(): void
    {
        $agence = User::factory()->agence()->create();

        $response = $this->actingAs($agence)->get(route('annonces.create'));

        $response->assertOk();
    }

    public function test_admin_can_access_create_form(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->get(route('annonces.create'));

        $response->assertOk();
    }
}
