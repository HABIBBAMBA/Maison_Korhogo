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
        Schema::table('annonces', function (Blueprint $table) {
            // Modification des colonnes enum vers string pour supporter 'court_sejour', 'residence_meublee', 'chambre_hotel', etc.
            $table->string('type_offre', 30)->default('vente')->change();
            $table->string('type_bien', 50)->default('maison')->change();
            $table->unsignedInteger('capacite_voyageurs')->nullable()->after('nombre_chambres');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('annonces', function (Blueprint $table) {
            $table->dropColumn('capacite_voyageurs');
        });
    }
};
