<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AnnonceUploadTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_upload_photo_under_10mb()
    {
        Storage::fake('public');

        $user = User::factory()->create([
            'role' => 'proprietaire',
        ]);

        // Créer un faux fichier image de 8 Mo (8192 Ko)
        $file = UploadedFile::fake()->image('maison_hd.jpg')->size(8192);

        $response = $this->actingAs($user)->post('/annonces', [
            'type_offre' => 'location',
            'type_bien' => 'maison',
            'titre' => 'Grande villa moderne Korhogo',
            'description' => 'Magnifique villa 4 pièces située au quartier Résidentiel avec toutes commodités.',
            'prix' => 250000,
            'quartier' => 'Koko',
            'adresse' => 'Face BCEAO',
            'date_disponibilite' => now()->format('Y-m-d'),
            'nombre_pieces' => 4,
            'nombre_chambres' => 3,
            'nombre_salles_bain' => 2,
            'images' => [$file],
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('annonces.mes-annonces'));

        // Vérifier que le fichier est bien stocké
        Storage::disk('public')->assertExists('annonces/'.$file->hashName());
    }

    public function test_rejects_photo_over_10mb()
    {
        Storage::fake('public');

        $user = User::factory()->create([
            'role' => 'proprietaire',
        ]);

        // Fichier de 11 Mo (11264 Ko)
        $file = UploadedFile::fake()->image('trop_gros.jpg')->size(11264);

        $response = $this->actingAs($user)->post('/annonces', [
            'type_offre' => 'location',
            'type_bien' => 'maison',
            'titre' => 'Grande villa moderne Korhogo',
            'description' => 'Magnifique villa 4 pièces située au quartier Résidentiel avec toutes commodités.',
            'prix' => 250000,
            'quartier' => 'Koko',
            'adresse' => 'Face BCEAO',
            'date_disponibilite' => now()->format('Y-m-d'),
            'images' => [$file],
        ]);

        $response->assertSessionHasErrors(['images.0']);
    }
}
