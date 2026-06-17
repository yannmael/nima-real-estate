<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entreprises', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('slug')->unique();
            $table->text('description_fr');
            $table->text('description_en');
            $table->string('logo')->nullable();
            $table->string('couleur_accent', 7)->default('#1A3C5E'); // hex
            // Liste des services : [{"fr": "...", "en": "..."}]
            $table->json('services')->nullable();
            $table->boolean('actif')->default(true);
            $table->unsignedTinyInteger('ordre')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('entreprises');
    }
};
