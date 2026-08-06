<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('biens', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description')->nullable();
            $table->text('type_bien')->nullable();
            $table->string('quartier')->nullable();
            $table->text('adresse')->nullable();
            $table->decimal('prix', 15, 2);
            $table->integer('nombre_pieces')->nullable();
            $table->enum('statut', ['disponible', 'loue', 'vendu'])->default('disponible');

            $table->foreignId('id_agence')
                ->nullable()
                ->constrained('agences', 'id')
                ->onDelete('set null');

            $table->foreignId('id_proprietaire')
                ->nullable()
                ->constrained('proprietaires', 'id')
                ->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('biens');
    }
};
