<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('taux_change', function (Blueprint $table) {
            $table->id();
            // Devise cible (XAF est la devise pivot, non stockée ici)
            $table->char('devise', 3)->unique(); // EUR | USD
            // 1 unité de cette devise = taux_xaf unités de XAF (FCFA)
            $table->decimal('taux_xaf', 15, 6)->unsigned();
            // Traçabilité de la saisie admin
            $table->string('mis_a_jour_par')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('taux_change');
    }
};
