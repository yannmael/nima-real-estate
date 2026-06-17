<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Utilisateur admin de test
        User::factory()->create([
            'name'  => 'Admin NIMA (test)',
            'email' => 'admin@nima-demo.local',
        ]);

        // Ordre imposé par les FK : Entreprise → Projet → Temoignage
        $this->call([
            EntrepriseSeeder::class,
            ProjetSeeder::class,
            ArticleSeeder::class,
            LeadSeeder::class,
            TemoignageSeeder::class,
        ]);
    }
}
