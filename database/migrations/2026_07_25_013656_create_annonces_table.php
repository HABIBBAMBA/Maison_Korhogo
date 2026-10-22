<?php

// database/migrations/xxxx_xx_xx_create_annonces_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('annonces')) {
            Schema::create('annonces', function (Blueprint $table) {
                $table->id();

                $table->string('titre');
                $table->text('description');

                $table->enum('type_bien', [
                    'maison',
                    'appartement',
                    'terrain',
                    'bureau',
                    'commerce',
                    'entrepot',
                    'chambre',
                    'magasin',
                    'villa',
                    'autre',
                ])->default('maison');

                $table->enum('type_offre', ['vente', 'location'])->default('vente');

                $table->decimal('prix', 12, 2);
                $table->decimal('superficie', 10, 2)->nullable();
                $table->integer('nombre_pieces')->nullable();
                $table->integer('nombre_chambres')->nullable();
                $table->integer('nombre_salles_bain')->nullable();

                $table->string('adresse')->nullable();
                $table->string('ville')->nullable();
                $table->string('quartier')->nullable();

                $table->json('images')->nullable();
                $table->enum('statut', ['active', 'vendu', 'loue', 'inactive'])->default('active');

                $table->foreignId('id_user')
                    ->constrained('users')
                    ->onDelete('cascade');

                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('annonces');
    }
};
