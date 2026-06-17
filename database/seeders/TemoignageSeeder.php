<?php

namespace Database\Seeders;

// DONNÉES DE DÉMONSTRATION FICTIVES — auteurs, fonctions et contenus entièrement inventés
use App\Models\Projet;
use App\Models\Temoignage;
use Illuminate\Database\Seeder;

class TemoignageSeeder extends Seeder
{
    public function run(): void
    {
        $projetVilla = Projet::where('slug', 'demo-villa-panorama')->first();
        $projetResid = Projet::where('slug', 'demo-residence-les-bougainvillees')->first();

        $temoignages = [
            [
                'auteur'       => 'Jean-Baptiste Fotso (FICTIF)',
                'fonction'     => 'Directeur commercial — entreprise fictive',
                'contenu_fr'   => '[DEMO — FICTIF] Témoignage de démonstration. NIMA Real Estate nous a accompagnés avec professionnalisme. Placeholder à remplacer par un vrai témoignage autorisé.',
                'contenu_en'   => '[DEMO — FICTITIOUS] Demo testimonial. NIMA Real Estate supported us professionally. Placeholder to be replaced with a real authorised testimonial.',
                'projet_id'    => $projetVilla?->id,
                'photo'        => null,
                'autorisation' => false,
                'visible'      => false,
                'ordre'        => 1,
            ],
            [
                'auteur'       => 'Sophie Mbarga (FICTIF)',
                'fonction'     => 'Architecte independante — fictive',
                'contenu_fr'   => '[DEMO — FICTIF] La qualité des finitions de la résidence dépasse nos attentes. Placeholder fictif.',
                'contenu_en'   => '[DEMO — FICTITIOUS] The quality of the finishes exceeded our expectations. Fictitious placeholder.',
                'projet_id'    => $projetResid?->id,
                'photo'        => null,
                'autorisation' => false,
                'visible'      => false,
                'ordre'        => 2,
            ],
            [
                'auteur'       => 'David Ewondo (FICTIF)',
                'fonction'     => 'Investisseur particulier — fictif',
                'contenu_fr'   => '[DEMO — FICTIF] Témoignage générique non lié à un projet. Placeholder.',
                'contenu_en'   => '[DEMO — FICTITIOUS] Generic testimonial not linked to a project. Placeholder.',
                'projet_id'    => null,
                'photo'        => null,
                'autorisation' => false,
                'visible'      => false,
                'ordre'        => 3,
            ],
        ];

        foreach ($temoignages as $data) {
            Temoignage::create($data);
        }
    }
}
