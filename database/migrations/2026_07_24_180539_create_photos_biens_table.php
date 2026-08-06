<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('photos_biens', function (Blueprint $table) {
            $table->id();
            $table->string('photo'); // chemin vers le fichier photo
            $table->foreignId('id_bien')
                ->constrained('biens', 'id') // clé étrangère vers biens
                ->onDelete('cascade'); // si bien supprimé, photo aussi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photos_biens');
    }
};
