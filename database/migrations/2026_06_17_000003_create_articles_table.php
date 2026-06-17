<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('titre_fr');
            $table->string('titre_en');
            // Slugs distincts par locale pour les routes /fr/blog/... et /en/blog/...
            $table->string('slug_fr')->unique();
            $table->string('slug_en')->unique();
            $table->longText('contenu_fr')->nullable();
            $table->longText('contenu_en')->nullable();
            $table->string('image_couverture')->nullable();
            // Catégories et tags stockés en JSON : ["immobilier", "investissement"]
            $table->json('categories')->nullable();
            $table->json('tags')->nullable();
            // Champs SEO par locale
            $table->string('meta_titre_fr', 70)->nullable();
            $table->string('meta_titre_en', 70)->nullable();
            $table->string('meta_description_fr', 160)->nullable();
            $table->string('meta_description_en', 160)->nullable();
            $table->enum('statut', ['brouillon', 'publie'])->default('brouillon');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
