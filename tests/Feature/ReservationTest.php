<?php

namespace Tests\Feature;

use App\Models\Annonce;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReservationTest extends TestCase
{
    use RefreshDatabase;

    private function createCourtSejourAnnonce(User $owner, array $overrides = []): Annonce
    {
        return Annonce::create(array_merge([
            'titre' => 'Suite Deluxe Résidence Meublée',
            'description' => 'Magnifique suite climatisée avec Wi-Fi haut débit, groupe électrogène et cuisine équipée.',
            'type_bien' => 'residence_meublee',
            'type_offre' => 'court_sejour',
            'categorie' => 'court_sejour',
            'prix' => 35000,
            'superficie' => 65,
            'nombre_pieces' => 2,
            'nombre_chambres' => 1,
            'nombre_salles_bain' => 1,
            'capacite_voyageurs' => 2,
            'quartier' => 'Koko',
            'adresse' => 'Avenue Félix Houphouët-Boigny',
            'date_disponibilite' => now()->toDateString(),
            'statut' => 'active',
            'equipements' => ['wifi', 'climatisation', 'groupe_electrogene', 'canal_plus'],
            'id_user' => $owner->id,
        ], $overrides));
    }

    public function test_client_can_submit_reservation_for_court_sejour(): void
    {
        $owner = User::factory()->proprietaire()->create();
        $client = User::factory()->client()->create(['name' => 'Koffi Daniel', 'email' => 'koffi@test.ci']);
        $annonce = $this->createCourtSejourAnnonce($owner, ['prix' => 30000]);

        $dateArrivee = Carbon::tomorrow()->toDateString();
        $dateDepart = Carbon::tomorrow()->addDays(3)->toDateString();

        $response = $this->actingAs($client)->post(route('reservations.store'), [
            'id_annonce' => $annonce->id,
            'nom_client' => 'Koffi Daniel',
            'telephone' => '+225 07 00 00 11 22',
            'email' => 'koffi@test.ci',
            'date_arrivee' => $dateArrivee,
            'date_depart' => $dateDepart,
            'nombre_personnes' => 2,
            'demandes_particulieres' => 'Arrivée tardive vers 20h si possible.',
        ]);

        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('reservations', [
            'id_annonce' => $annonce->id,
            'id_user' => $client->id,
            'nom_client' => 'Koffi Daniel',
            'telephone' => '+225 07 00 00 11 22',
            'nombre_nuits' => 3,
            'prix_total_estime' => 90000,
            'statut' => 'en_attente',
        ]);
    }

    public function test_guest_can_submit_reservation_and_is_redirected_to_annonce(): void
    {
        $owner = User::factory()->agence()->create();
        $annonce = $this->createCourtSejourAnnonce($owner, [
            'type_bien' => 'chambre_hotel',
            'prix' => 25000,
        ]);

        $dateArrivee = Carbon::tomorrow()->toDateString();
        $dateDepart = Carbon::tomorrow()->addDays(2)->toDateString();

        $response = $this->post(route('reservations.store'), [
            'id_annonce' => $annonce->id,
            'nom_client' => 'Aya Touré',
            'telephone' => '0505123456',
            'email' => 'aya@exemple.ci',
            'date_arrivee' => $dateArrivee,
            'date_depart' => $dateDepart,
            'nombre_personnes' => 1,
        ]);

        $response->assertRedirect(route('annonces.show', $annonce));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('reservations', [
            'id_annonce' => $annonce->id,
            'id_user' => null,
            'nom_client' => 'Aya Touré',
            'nombre_nuits' => 2,
            'prix_total_estime' => 50000,
            'statut' => 'en_attente',
        ]);
    }

    public function test_reservation_validation_fails_if_date_depart_is_not_after_date_arrivee(): void
    {
        $owner = User::factory()->proprietaire()->create();
        $annonce = $this->createCourtSejourAnnonce($owner);

        $date = Carbon::tomorrow()->toDateString();

        $response = $this->post(route('reservations.store'), [
            'id_annonce' => $annonce->id,
            'nom_client' => 'Test Invalide',
            'telephone' => '0707000000',
            'date_arrivee' => $date,
            'date_depart' => $date, // Same day or earlier
            'nombre_personnes' => 1,
        ]);

        $response->assertSessionHasErrors(['date_depart']);
        $this->assertDatabaseCount('reservations', 0);
    }

    public function test_host_can_confirm_reservation(): void
    {
        $owner = User::factory()->proprietaire()->create();
        $client = User::factory()->client()->create();
        $annonce = $this->createCourtSejourAnnonce($owner);

        $reservation = Reservation::create([
            'id_annonce' => $annonce->id,
            'id_user' => $client->id,
            'nom_client' => 'Voyageur Test',
            'telephone' => '0707070707',
            'date_arrivee' => Carbon::tomorrow()->toDateString(),
            'date_depart' => Carbon::tomorrow()->addDays(2)->toDateString(),
            'nombre_nuits' => 2,
            'nombre_personnes' => 2,
            'prix_total_estime' => 70000,
            'statut' => 'en_attente',
        ]);

        $response = $this->actingAs($owner)->patch(route('reservations.update-statut', $reservation), [
            'statut' => 'confirmee',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertEquals('confirmee', $reservation->fresh()->statut);
    }

    public function test_admin_can_update_reservation_statut(): void
    {
        $owner = User::factory()->proprietaire()->create();
        $admin = User::factory()->admin()->create();
        $annonce = $this->createCourtSejourAnnonce($owner);

        $reservation = Reservation::create([
            'id_annonce' => $annonce->id,
            'nom_client' => 'Voyageur Admin Test',
            'telephone' => '0707070707',
            'date_arrivee' => Carbon::tomorrow()->toDateString(),
            'date_depart' => Carbon::tomorrow()->addDays(1)->toDateString(),
            'nombre_nuits' => 1,
            'nombre_personnes' => 1,
            'prix_total_estime' => 35000,
            'statut' => 'en_attente',
        ]);

        $response = $this->actingAs($admin)->patch(route('reservations.update-statut', $reservation), [
            'statut' => 'refusee',
        ]);

        $response->assertRedirect();
        $this->assertEquals('refusee', $reservation->fresh()->statut);
    }

    public function test_unauthorized_user_cannot_update_reservation_statut(): void
    {
        $owner = User::factory()->proprietaire()->create();
        $stranger = User::factory()->client()->create();
        $annonce = $this->createCourtSejourAnnonce($owner);

        $reservation = Reservation::create([
            'id_annonce' => $annonce->id,
            'nom_client' => 'Voyageur Test',
            'telephone' => '0707070707',
            'date_arrivee' => Carbon::tomorrow()->toDateString(),
            'date_depart' => Carbon::tomorrow()->addDays(2)->toDateString(),
            'nombre_nuits' => 2,
            'nombre_personnes' => 2,
            'prix_total_estime' => 70000,
            'statut' => 'en_attente',
        ]);

        $response = $this->actingAs($stranger)->patch(route('reservations.update-statut', $reservation), [
            'statut' => 'confirmee',
        ]);

        $response->assertForbidden();
        $this->assertEquals('en_attente', $reservation->fresh()->statut);
    }

    public function test_traveler_can_cancel_their_reservation(): void
    {
        $owner = User::factory()->proprietaire()->create();
        $client = User::factory()->client()->create();
        $annonce = $this->createCourtSejourAnnonce($owner);

        $reservation = Reservation::create([
            'id_annonce' => $annonce->id,
            'id_user' => $client->id,
            'nom_client' => 'Voyageur Client',
            'telephone' => '0707070707',
            'date_arrivee' => Carbon::tomorrow()->toDateString(),
            'date_depart' => Carbon::tomorrow()->addDays(2)->toDateString(),
            'nombre_nuits' => 2,
            'nombre_personnes' => 2,
            'prix_total_estime' => 70000,
            'statut' => 'en_attente',
        ]);

        $response = $this->actingAs($client)->patch(route('reservations.cancel', $reservation));

        $response->assertRedirect();
        $this->assertEquals('annulee', $reservation->fresh()->statut);
    }

    public function test_client_dashboard_displays_reservation_details(): void
    {
        $owner = User::factory()->proprietaire()->create(['name' => 'Hôtel Le Mont Korhogo']);
        $client = User::factory()->client()->create();
        $annonce = $this->createCourtSejourAnnonce($owner, ['titre' => 'Chambre Supérieure']);

        Reservation::create([
            'id_annonce' => $annonce->id,
            'id_user' => $client->id,
            'nom_client' => $client->name,
            'telephone' => '0700112233',
            'date_arrivee' => Carbon::tomorrow()->toDateString(),
            'date_depart' => Carbon::tomorrow()->addDays(4)->toDateString(),
            'nombre_nuits' => 4,
            'nombre_personnes' => 2,
            'prix_total_estime' => 140000,
            'statut' => 'en_attente',
        ]);

        $response = $this->actingAs($client)->get(route('dashboard'));

        $response->assertOk();
        $response->assertSee('Chambre Supérieure');
        $response->assertSee('Mes réservations de séjour');
        $response->assertSee('Hôtels & Résidences');
        $response->assertSee('140.000');
    }

    public function test_owner_dashboard_displays_received_reservation_requests(): void
    {
        $owner = User::factory()->proprietaire()->create();
        $annonce = $this->createCourtSejourAnnonce($owner, ['titre' => 'Résidence Prestige']);

        Reservation::create([
            'id_annonce' => $annonce->id,
            'nom_client' => 'Amadou Koné',
            'telephone' => '0102030405',
            'date_arrivee' => Carbon::tomorrow()->toDateString(),
            'date_depart' => Carbon::tomorrow()->addDays(3)->toDateString(),
            'nombre_nuits' => 3,
            'nombre_personnes' => 3,
            'prix_total_estime' => 105000,
            'statut' => 'en_attente',
        ]);

        $response = $this->actingAs($owner)->get(route('dashboard'));

        $response->assertOk();
        $response->assertSee('Demandes de Réservations (Hôtels & Résidences)');
        $response->assertSee('Amadou Koné');
        $response->assertSee('105.000');
        $response->assertSee('Résidence Prestige');
    }
}
