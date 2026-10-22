<?php

namespace Tests\Feature;

use App\Models\Annonce;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_uploaded_listing_photo_is_saved_and_shown_on_the_home_page(): void
    {
        Storage::fake('public');

        $user = User::create([
            'name' => 'Utilisateur de test',
            'email' => 'listing-photo@example.test',
            'password' => Hash::make('password'),
            'role' => 'proprietaire',
        ]);

        $this->actingAs($user)
            ->post(route('annonces.store'), [
                'type_offre' => 'vente',
                'type_bien' => 'maison',
                'titre' => 'Maison avec photo',
                'description' => 'Une maison de test avec une description assez longue.',
                'prix' => 150000,
                'date_disponibilite' => '2026-10-07',
                'quartier' => 'Cocody',
                'adresse' => 'Abidjan',
                'images' => [
                    UploadedFile::fake()->image('maison.JPG')->size(3072),
                ],
            ])
            ->assertRedirect(route('annonces.mes-annonces'));

        $annonce = Annonce::where('titre', 'Maison avec photo')->firstOrFail();

        $this->assertCount(1, $annonce->images);
        Storage::disk('public')->assertExists($annonce->images[0]);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee($annonce->premiere_image, false);
    }

    public function test_home_hero_keeps_its_original_copy_and_has_carousel_controls(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('hero/hero-one.jpg', 'test image');
        Storage::disk('public')->put('hero/hero-two.jpg', 'test image');

        $user = User::create([
            'name' => 'Utilisateur de test',
            'email' => 'carousel@example.test',
            'password' => Hash::make('password'),
        ]);

        foreach (['annonces/hero-one.jpg', 'annonces/hero-two.jpg'] as $image) {
            Annonce::create([
                'titre' => 'Bien en vedette',
                'description' => 'Une annonce de test.',
                'prix' => 150000,
                'images' => [$image],
                'statut' => 'active',
                'id_user' => $user->id,
            ]);
        }

        $response = $this->withServerVariables(['HTTP_HOST' => 'carrousel.test'])->get('/');

        $response->assertOk()
            ->assertSee('Trouvez le bien')
            ->assertSee('de vos rêves')
            ->assertSee('Explorer les biens')
            ->assertSee('Nous contacter')
            ->assertSee('Diapositive précédente')
            ->assertSee('Diapositive suivante')
            ->assertSee('data-hero-carousel', false)
            ->assertSee('data-carousel-next', false)
            ->assertSee('class="hero-carousel__slide is-active"', false)
            ->assertSee('data-carousel-dot="1"', false)
            ->assertDontSee('x-data', false)
            ->assertSee('hero-one.jpg')
            ->assertSee('hero-two.jpg')
            ->assertSee('src="/storage/hero/hero-one.jpg"', false)
            ->assertSee('src="/storage/hero/hero-two.jpg"', false)
            ->assertSee('/storage/hero/hero-one.jpg')
            ->assertSee('/storage/hero/hero-two.jpg');
    }

    public function test_home_hero_falls_back_to_photos_from_active_listings(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('annonces/property-one.jpg', 'test image');
        Storage::disk('public')->put('annonces/property-two.jpg', 'test image');

        $user = User::create([
            'name' => 'Utilisateur de test',
            'email' => 'carousel-fallback@example.test',
            'password' => Hash::make('password'),
        ]);

        Annonce::create([
            'titre' => 'Bien en vedette',
            'description' => 'Une annonce de test.',
            'prix' => 150000,
            'images' => ['annonces/property-one.jpg', 'annonces/property-two.jpg'],
            'statut' => 'active',
            'id_user' => $user->id,
        ]);

        $response = $this->get('/');

        $response->assertOk()
            ->assertSee('data-carousel-next', false)
            ->assertSee('/storage/annonces/property-one.jpg')
            ->assertSee('/storage/annonces/property-two.jpg');
    }
}
