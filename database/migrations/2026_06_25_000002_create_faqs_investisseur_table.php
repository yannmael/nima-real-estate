<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('faqs_investisseur', function (Blueprint $table) {
            $table->id();
            $table->string('question_fr');
            $table->string('question_en');
            $table->text('reponse_fr');
            $table->text('reponse_en');
            $table->unsignedSmallInteger('ordre')->default(0);
            $table->boolean('publiee')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faqs_investisseur');
    }
};
