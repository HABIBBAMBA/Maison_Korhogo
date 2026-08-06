<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agences', function (Blueprint $table) {
            $table->id();
            $table->string('nom_agence');
            $table->string('nom_responsable');
            $table->string('telephone');
            $table->text('adresse')->nullable();
            $table->string('logo')->nullable(); // chemin vers le fichier logo
            $table->foreignId('id_user')
                ->constrained('users', 'id')  // clé étrangère vers users
                ->onDelete('cascade');          // si user supprimé, agence aussi
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agences');
    }
};
