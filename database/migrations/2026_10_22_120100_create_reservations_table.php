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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();

            // Clé étrangère vers l'annonce (convention id_*)
            $table->foreignId('id_annonce')
                ->constrained('annonces')
                ->onDelete('cascade');

            // Clé étrangère optionnelle vers l'utilisateur s'il est connecté
            $table->foreignId('id_user')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');

            // Coordonnées du voyageur
            $table->string('nom_client');
            $table->string('telephone', 30);
            $table->string('email')->nullable();

            // Dates & Détails du séjour
            $table->date('date_arrivee');
            $table->date('date_depart');
            $table->unsignedInteger('nombre_nuits');
            $table->unsignedInteger('nombre_personnes')->default(1);
            $table->decimal('prix_total_estime', 12, 2);
            $table->text('demandes_particulieres')->nullable();

            // Statut de la réservation
            $table->enum('statut', [
                'en_attente',
                'confirmee',
                'refusee',
                'annulee',
                'terminee',
            ])->default('en_attente');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
