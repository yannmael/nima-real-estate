<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projets', function (Blueprint $table) {
            $table->id();
            $table->string('titre_fr');
            $table->string('titre_en');
            $table->string('slug')->unique();
            $table->foreignId('entreprise_id')->constrained('entreprises')->cascadeOnDelete();
            $table->string('typologie_fr')->nullable(); // ex: "Villa résidentielle"
            $table->string('typologie_en')->nullable(); // ex: "Residential villa"
            $table->string('lieu')->nullable();          // ville / quartier
            $table->decimal('surface', 10, 2)->nullable(); // m²
            $table->unsignedSmallInteger('annee')->nullable();
            $table->decimal('budget_montant', 15, 2)->nullable();
            $table->string('budget_devise', 3)->default('XAF'); // XAF | EUR | USD
            $table->string('image_principale')->nullable();
            // Tableaux de chemins d'images : ["projets/p1/img1.webp", ...]
            $table->json('galerie')->nullable();
            $table->json('plans')->nullable();
            $table->text('parti_pris_fr')->nullable(); // parti architectural / concept
            $table->text('parti_pris_en')->nullable();
            $table->enum('statut', ['realise', 'a_vendre', 'en_cours'])->default('realise');
            $table->boolean('visible')->default(true);
            $table->unsignedTinyInteger('ordre')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projets');
    }
};
