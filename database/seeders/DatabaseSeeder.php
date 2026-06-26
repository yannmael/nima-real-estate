<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Utilisateur admin de test (2FA non configuré — à activer via /admin/login)
        User::factory()->create([
            'name'     => 'Admin NIMA (test)',
            'email'    => 'admin@nima-demo.local',
            'is_admin' => true,
        ]);

        // Ordre imposé par les FK : Entreprise → Projet → Temoignage
        $this->call([
            EntrepriseSeeder::class,
            ProjetSeeder::class,
            ArticleSeeder::class,
            LeadSeeder::class,
            TemoignageSeeder::class,
            TauxChangeSeeder::class,
            IndicateurMarcheSeeder::class,
            FaqInvestisseurSeeder::class,
        ]);
    }
}
