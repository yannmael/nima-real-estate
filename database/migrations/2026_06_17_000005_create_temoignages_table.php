<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('temoignages', function (Blueprint $table) {
            $table->id();
            $table->string('auteur');
            $table->string('fonction')->nullable(); // poste / titre
            $table->text('contenu_fr');
            $table->text('contenu_en')->nullable();
            // Lien optionnel vers un projet (null = témoignage générique)
            $table->foreignId('projet_id')->nullable()->constrained('projets')->nullOnDelete();
            $table->string('photo')->nullable();
            // Consentement explicite de la personne à publier son témoignage
            $table->boolean('autorisation')->default(false);
            $table->boolean('visible')->default(false); // actif seulement si autorisation = true
            $table->unsignedTinyInteger('ordre')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('temoignages');
    }
};
