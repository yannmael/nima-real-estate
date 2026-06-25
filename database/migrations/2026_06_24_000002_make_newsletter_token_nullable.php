<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('newsletter_subscribers', function (Blueprint $table) {
            $table->dropUnique('newsletter_subscribers_token_unique');
            // Le token est nul une fois consommé (double opt-in confirmé)
            // MySQL accepte plusieurs NULL dans une colonne UNIQUE
            $table->string('token', 64)->nullable()->change();
            $table->unique('token');
        });
    }

    public function down(): void
    {
        Schema::table('newsletter_subscribers', function (Blueprint $table) {
            $table->dropUnique('newsletter_subscribers_token_unique');
            $table->string('token', 64)->nullable(false)->change();
            $table->unique('token');
        });
    }
};
