<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/profile');

        $response->assertOk();
    }

    public function test_profile_information_can_be_updated(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $user->refresh();

        $this->assertSame('Test User', $user->name);
        $this->assertSame('test@example.com', $user->email);
        $this->assertNull($user->email_verified_at);
    }

    public function test_email_verification_status_is_unchanged_when_the_email_address_is_unchanged(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'name' => 'Test User',
                'email' => $user->email,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $this->assertNotNull($user->refresh()->email_verified_at);
    }

    public function test_user_can_delete_their_account(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->delete('/profile', [
                'password' => 'password',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/');

        $this->assertGuest();
        $this->assertNull($user->fresh());
    }

    public function test_client_can_update_their_specific_profile(): void
    {
        $user = User::factory()->create(['role' => 'client']);

        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'email' => 'client-updated@example.com',
                'prenom' => 'Kouamé',
                'nom' => 'Koffi',
                'telephone' => '+225 07 12 34 56 78',
            ]);

        $response->assertSessionHasNoErrors()->assertRedirect('/profile');

        $user->refresh();
        $this->assertSame('Kouamé Koffi', $user->name);
        $this->assertSame('client-updated@example.com', $user->email);
        $this->assertNotNull($user->client);
        $this->assertSame('Koffi', $user->client->nom);
        $this->assertSame('Kouamé', $user->client->prenom);
        $this->assertSame('+225 07 12 34 56 78', $user->client->telephone);
    }

    public function test_proprietaire_can_update_their_specific_profile(): void
    {
        $user = User::factory()->create(['role' => 'proprietaire']);

        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'email' => 'proprio-updated@example.com',
                'prenom' => 'Bakary',
                'nom' => 'Soro',
                'telephone' => '+225 05 98 76 54 32',
                'adresse' => 'Korhogo, Quartier Résidentiel',
            ]);

        $response->assertSessionHasNoErrors()->assertRedirect('/profile');

        $user->refresh();
        $this->assertSame('Bakary Soro', $user->name);
        $this->assertNotNull($user->proprietaire);
        $this->assertSame('Soro', $user->proprietaire->nom);
        $this->assertSame('Bakary', $user->proprietaire->prenom);
        $this->assertSame('+225 05 98 76 54 32', $user->proprietaire->telephone);
        $this->assertSame('Korhogo, Quartier Résidentiel', $user->proprietaire->adresse);
    }

    public function test_agence_can_update_their_specific_profile_and_logo(): void
    {
        Storage::fake('public');

        $user = User::factory()->create(['role' => 'agence']);
        $logo = UploadedFile::fake()->image('logo.png', 120, 120);

        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'email' => 'agence-updated@example.com',
                'nom_agence' => 'Immo Poro Prestige',
                'nom_responsable' => 'Ibrahim Touré',
                'telephone' => '+225 27 86 00 11',
                'adresse' => 'Korhogo Centre, Rue des Banques',
                'logo' => $logo,
            ]);

        $response->assertSessionHasNoErrors()->assertRedirect('/profile');

        $user->refresh();
        $this->assertSame('Immo Poro Prestige', $user->name);
        $this->assertNotNull($user->agence);
        $this->assertSame('Immo Poro Prestige', $user->agence->nom_agence);
        $this->assertSame('Ibrahim Touré', $user->agence->nom_responsable);
        $this->assertSame('+225 27 86 00 11', $user->agence->telephone);
        $this->assertNotNull($user->agence->logo);
        Storage::disk('public')->assertExists($user->agence->logo);
    }

    public function test_correct_password_must_be_provided_to_delete_account(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->from('/profile')
            ->delete('/profile', [
                'password' => 'wrong-password',
            ]);

        $response
            ->assertSessionHasErrorsIn('userDeletion', 'password')
            ->assertRedirect('/profile');

        $this->assertNotNull($user->fresh());
    }
}
