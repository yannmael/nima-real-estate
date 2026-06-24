<?php

namespace Database\Seeders;

// Taux de référence initiaux — à mettre à jour via le back-office admin
// EUR/XAF : taux légal fixe (parité CFA garantie par la France)
// USD/XAF : valeur indicative fictive — DOIT être ajustée par l'administrateur
use App\Models\TauxChange;
use Illuminate\Database\Seeder;

class TauxChangeSeeder extends Seeder
{
    public function run(): void
    {
        TauxChange::updateOrCreate(
            ['devise' => 'EUR'],
            [
                'taux_xaf'       => 655.957000,
                'mis_a_jour_par' => 'seeder (taux légal fixe XAF/EUR)',
            ]
        );

        TauxChange::updateOrCreate(
            ['devise' => 'USD'],
            [
                'taux_xaf'       => 615.000000,
                'mis_a_jour_par' => 'seeder (valeur indicative — à actualiser en admin)',
            ]
        );
    }
}
