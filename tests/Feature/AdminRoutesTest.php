<?php

namespace Tests\Feature;

use App\Models\Agence;
use App\Models\Bien;
use App\Models\Contact;
use App\Models\Proprietaire;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminRoutesTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::create([
            'name' => 'Test Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
    }

    // ── Admin Dashboard ──

    public function test_admin_dashboard_loads(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin');
        $response->assertStatus(200);
    }

    // ── Biens CRUD ──

    public function test_admin_biens_index_loads(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/biens');
        $response->assertStatus(200);
    }

    public function test_admin_biens_create_loads(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/biens/create');
        $response->assertStatus(200);
    }

    public function test_admin_biens_store_works(): void
    {
        $agence = Agence::create([
            'nom_agence' => 'Test Agence',
            'nom_responsable' => 'Resp',
            'telephone' => '0700000000',
            'id_user' => $this->admin->id,
        ]);
        $proprio = Proprietaire::create([
            'nom' => 'Dupont',
            'prenom' => 'Jean',
            'id_user' => $this->admin->id,
        ]);

        $response = $this->actingAs($this->admin)->post('/admin/biens', [
            'titre' => 'Villa test',
            'type_bien' => 'maison',
            'statut' => 'disponible',
            'prix' => 50000000,
            'nombre_pieces' => 4,
            'adresse' => 'Abidjan',
            'quartier' => 'Cocody',
            'id_agence' => $agence->id,
            'id_proprietaire' => $proprio->id,
        ]);

        $response->assertRedirect(route('admin.biens.index'));
        $this->assertDatabaseHas('biens', ['titre' => 'Villa test']);
    }

    public function test_admin_biens_show_loads(): void
    {
        $bien = Bien::create([
            'titre' => 'Test Bien',
            'type_bien' => 'maison',
            'prix' => 10000000,
            'statut' => 'disponible',
        ]);

        $response = $this->actingAs($this->admin)->get("/admin/biens/{$bien->id}");
        $response->assertStatus(200);
    }

    public function test_admin_biens_edit_loads(): void
    {
        $bien = Bien::create([
            'titre' => 'Test Bien',
            'type_bien' => 'maison',
            'prix' => 10000000,
            'statut' => 'disponible',
        ]);

        $response = $this->actingAs($this->admin)->get("/admin/biens/{$bien->id}/edit");
        $response->assertStatus(200);
    }

    public function test_admin_biens_update_works(): void
    {
        $bien = Bien::create([
            'titre' => 'Old Title',
            'type_bien' => 'maison',
            'prix' => 10000000,
            'statut' => 'disponible',
        ]);

        $response = $this->actingAs($this->admin)->put("/admin/biens/{$bien->id}", [
            'titre' => 'New Title',
            'type_bien' => 'appartement',
            'statut' => 'en_negociation',
            'prix' => 20000000,
        ]);

        $response->assertRedirect(route('admin.biens.index'));
        $this->assertDatabaseHas('biens', [
            'id' => $bien->id,
            'titre' => 'New Title',
            'type_bien' => 'appartement',
            'statut' => 'en_negociation',
        ]);
    }

    public function test_admin_biens_destroy_works(): void
    {
        $bien = Bien::create([
            'titre' => 'To Delete',
            'type_bien' => 'terrain',
            'prix' => 5000000,
            'statut' => 'disponible',
        ]);

        $response = $this->actingAs($this->admin)->delete("/admin/biens/{$bien->id}");
        $response->assertRedirect(route('admin.biens.index'));
        $this->assertDatabaseMissing('biens', ['id' => $bien->id]);
    }

    // ── Agences CRUD ──

    public function test_admin_agences_index_loads(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/agences');
        $response->assertStatus(200);
    }

    public function test_admin_agences_create_loads(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/agences/create');
        $response->assertStatus(200);
    }

    public function test_admin_agences_store_works(): void
    {
        $response = $this->actingAs($this->admin)->post('/admin/agences', [
            'nom_agence' => 'Nouvelle Agence',
            'nom_responsable' => 'M. Directeur',
            'telephone' => '+225 0700000000',
            'adresse' => 'Abidjan, Plateau',
        ]);

        $response->assertRedirect(route('admin.agences.index'));
        $this->assertDatabaseHas('agences', ['nom_agence' => 'Nouvelle Agence']);
    }

    public function test_admin_agences_show_loads(): void
    {
        $agence = Agence::create([
            'nom_agence' => 'Show Agence',
            'nom_responsable' => 'Resp',
            'telephone' => '0700000000',
            'id_user' => $this->admin->id,
        ]);

        $response = $this->actingAs($this->admin)->get("/admin/agences/{$agence->id}");
        $response->assertStatus(200);
    }

    public function test_admin_agences_edit_loads(): void
    {
        $agence = Agence::create([
            'nom_agence' => 'Edit Agence',
            'nom_responsable' => 'Resp',
            'telephone' => '0700000000',
            'id_user' => $this->admin->id,
        ]);

        $response = $this->actingAs($this->admin)->get("/admin/agences/{$agence->id}/edit");
        $response->assertStatus(200);
    }

    public function test_admin_agences_update_works(): void
    {
        $agence = Agence::create([
            'nom_agence' => 'Old Name',
            'nom_responsable' => 'Old Resp',
            'telephone' => '0700000000',
            'id_user' => $this->admin->id,
        ]);

        $response = $this->actingAs($this->admin)->put("/admin/agences/{$agence->id}", [
            'nom_agence' => 'New Name',
            'nom_responsable' => 'New Resp',
            'telephone' => '+225 0700000001',
            'adresse' => 'Yamoussoukro',
        ]);

        $response->assertRedirect(route('admin.agences.index'));
        $this->assertDatabaseHas('agences', [
            'id' => $agence->id,
            'nom_agence' => 'New Name',
            'nom_responsable' => 'New Resp',
        ]);
    }

    public function test_admin_agences_destroy_with_biens_is_blocked(): void
    {
        $agence = Agence::create([
            'nom_agence' => 'Agence With Biens',
            'nom_responsable' => 'Resp',
            'telephone' => '0700000000',
            'id_user' => $this->admin->id,
        ]);
        Bien::create([
            'titre' => 'Linked Bien',
            'type_bien' => 'maison',
            'prix' => 10000000,
            'id_agence' => $agence->id,
        ]);

        $response = $this->actingAs($this->admin)->delete("/admin/agences/{$agence->id}");
        $response->assertRedirect();
        $this->assertDatabaseHas('agences', ['id' => $agence->id]);
    }

    // ── Contacts ──

    public function test_contacts_index_loads(): void
    {
        $response = $this->actingAs($this->admin)->get('/contacts');
        $response->assertStatus(200);
    }

    public function test_contacts_create_loads(): void
    {
        $bien = Bien::create([
            'titre' => 'Bien Contact',
            'type_bien' => 'maison',
            'prix' => 10000000,
        ]);

        $response = $this->actingAs($this->admin)->get("/annonces/{$bien->id}/contact");
        $response->assertStatus(200);
    }

    public function test_contacts_store_works(): void
    {
        $bien = Bien::create([
            'titre' => 'Bien For Contact',
            'type_bien' => 'maison',
            'prix' => 10000000,
        ]);

        $response = $this->actingAs($this->admin)->post('/contacts', [
            'nom' => 'Diallo',
            'prenom' => 'Aminata',
            'email' => 'aminata@test.com',
            'telephone' => '0700000000',
            'message' => 'Je suis intéressé par ce bien.',
            'id_bien' => $bien->id,
        ]);

        $response->assertRedirect(route('annonces.show', $bien->id));
        $this->assertDatabaseHas('contacts', [
            'nom' => 'Diallo',
            'id_bien' => $bien->id,
        ]);
    }

    public function test_contacts_destroy_works(): void
    {
        $bien = Bien::create([
            'titre' => 'Bien',
            'type_bien' => 'maison',
            'prix' => 10000000,
        ]);
        $contact = Contact::create([
            'nom' => 'Test',
            'email' => 'test@test.com',
            'message' => 'Hello',
            'id_bien' => $bien->id,
        ]);

        $response = $this->actingAs($this->admin)->delete("/contacts/{$contact->id}");
        $response->assertRedirect(route('contacts.index'));
        $this->assertDatabaseMissing('contacts', ['id' => $contact->id]);
    }

    // ── Users CRUD ──

    public function test_admin_users_index_loads(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/users');
        $response->assertStatus(200);
    }

    public function test_admin_users_create_loads(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/users/create');
        $response->assertStatus(200);
    }
}
