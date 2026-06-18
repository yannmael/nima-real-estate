<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('entreprises', function (Blueprint $table) {
            // Texte long « histoire / à propos » — distinct de la description courte
            $table->text('histoire_fr')->nullable()->after('description_en');
            $table->text('histoire_en')->nullable()->after('histoire_fr');
            // Valeurs de l'entité : [{"titre_fr":"…","titre_en":"…","desc_fr":"…","desc_en":"…"}]
            $table->json('valeurs')->nullable()->after('histoire_en');
            // Équipe : [{"nom":"…","fonction_fr":"…","fonction_en":"…"}]
            $table->json('equipe')->nullable()->after('valeurs');
        });
    }

    public function down(): void
    {
        Schema::table('entreprises', function (Blueprint $table) {
            $table->dropColumn(['histoire_fr', 'histoire_en', 'valeurs', 'equipe']);
        });
    }
};
