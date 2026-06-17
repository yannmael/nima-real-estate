<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            // Coordonnées du prospect
            $table->string('prenom')->nullable();
            $table->string('nom_contact')->nullable();
            $table->string('email')->nullable();
            $table->string('telephone', 20)->nullable();
            // Qualification du projet
            $table->string('type_projet')->nullable(); // achat, location, investissement…
            $table->unsignedInteger('surface')->nullable(); // m² souhaités
            $table->string('budget')->nullable();          // saisie libre, ex: "50 000 000 - 100 000 000 XAF"
            $table->string('lieu')->nullable();
            $table->text('message')->nullable();
            // Métadonnées
            $table->string('source')->nullable(); // "formulaire_contact" | "landing_investir" | "chatbot"…
            $table->unsignedTinyInteger('score')->default(0); // 0-100, calculé par le service
            $table->string('locale', 2)->default('fr'); // fr | en
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
