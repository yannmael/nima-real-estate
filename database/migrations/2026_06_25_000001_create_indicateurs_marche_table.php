<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('indicateurs_marche', function (Blueprint $table) {
            $table->id();
            // Clé machine unique — utilisée dans les vues pour récupérer la valeur
            $table->string('cle', 80)->unique();
            // Libellé affiché côté visiteur (bilingue)
            $table->string('libelle_fr');
            $table->string('libelle_en');
            // Valeur brute (string : supporte "N/A", "[À SOURCER]", "12,5", "> 1 000 000"…)
            $table->string('valeur', 120)->default('[À SOURCER]');
            // Unité de mesure affichée après la valeur (bilingue)
            $table->string('unite_fr', 60)->nullable();
            $table->string('unite_en', 60)->nullable();
            // Source de référence attendue — rappel client visible en admin
            $table->string('source_attendue')->nullable();
            // Regroupement pour l'affichage sectionné
            $table->enum('categorie', ['marche', 'rendements', 'juridique'])->default('marche');
            // Ordre d'affichage dans la catégorie
            $table->unsignedSmallInteger('ordre')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('indicateurs_marche');
    }
};
