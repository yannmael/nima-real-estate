<?php

namespace Database\Seeders;

// DONNÉES DE DÉMONSTRATION FICTIVES — ne pas utiliser en production sans validation client
// Les noms, budgets, surfaces et descriptions ci-dessous sont entièrement inventés.
use App\Models\Entreprise;
use App\Models\Projet;
use Illuminate\Database\Seeder;

class ProjetSeeder extends Seeder
{
    public function run(): void
    {
        $nima  = Entreprise::where('slug', 'nima-real-estate')->firstOrFail();
        $isbd  = Entreprise::where('slug', 'infinite-sky-blue-design')->firstOrFail();
        $tkd   = Entreprise::where('slug', 'tkd-construction')->firstOrFail();

        $projets = [
            [
                'titre_fr'       => '[DEMO] Résidence Les Bougainvillées',
                'titre_en'       => '[DEMO] Les Bougainvillées Residence',
                'slug'           => 'demo-residence-les-bougainvillees',
                'entreprise_id'  => $nima->id,
                'typologie_fr'   => 'Résidence sécurisée',
                'typologie_en'   => 'Gated community',
                'lieu'           => 'Douala, Bonanjo — FICTIF',
                'surface'        => 320.00,
                'annee'          => 2023,
                'budget_montant' => 85000000.00,
                'budget_devise'  => 'XAF',
                'image_principale' => null,
                'galerie'        => [],
                'plans'          => [],
                'parti_pris_fr'  => '[DEMO] Intégration de la végétation locale et ventilation naturelle. Placeholder.',
                'parti_pris_en'  => '[DEMO] Integration of local vegetation and natural ventilation. Placeholder.',
                'statut'         => 'realise',
                'visible'        => true,
                'ordre'          => 1,
            ],
            [
                'titre_fr'       => '[DEMO] Villa Panorama',
                'titre_en'       => '[DEMO] Panorama Villa',
                'slug'           => 'demo-villa-panorama',
                'entreprise_id'  => $nima->id,
                'typologie_fr'   => 'Villa individuelle',
                'typologie_en'   => 'Detached villa',
                'lieu'           => 'Yaoundé, Bastos — FICTIF',
                'surface'        => 450.00,
                'annee'          => 2024,
                'budget_montant' => 120000000.00,
                'budget_devise'  => 'XAF',
                'image_principale' => null,
                'galerie'        => [],
                'plans'          => [],
                'parti_pris_fr'  => '[DEMO] Vue dégagée sur la colline, toiture végétalisée. Placeholder.',
                'parti_pris_en'  => '[DEMO] Open hillside view, green roof. Placeholder.',
                'statut'         => 'a_vendre',
                'visible'        => true,
                'ordre'          => 2,
            ],
            [
                'titre_fr'       => '[DEMO] Immeuble Horizon',
                'titre_en'       => '[DEMO] Horizon Building',
                'slug'           => 'demo-immeuble-horizon',
                'entreprise_id'  => $isbd->id,
                'typologie_fr'   => 'Immeuble de bureaux',
                'typologie_en'   => 'Office building',
                'lieu'           => 'Douala, Akwa — FICTIF',
                'surface'        => 1200.00,
                'annee'          => 2024,
                'budget_montant' => null, // montant confidentiel — placeholder
                'budget_devise'  => 'XAF',
                'image_principale' => null,
                'galerie'        => [],
                'plans'          => [],
                'parti_pris_fr'  => '[DEMO] Façade bioclimatique, bardage aluminium. Placeholder.',
                'parti_pris_en'  => '[DEMO] Bioclimatic façade, aluminium cladding. Placeholder.',
                'statut'         => 'en_cours',
                'visible'        => true,
                'ordre'          => 3,
            ],
            [
                'titre_fr'       => '[DEMO] Rénovation Appartement Bonamoussadi',
                'titre_en'       => '[DEMO] Bonamoussadi Apartment Renovation',
                'slug'           => 'demo-renovation-appartement-bonamoussadi',
                'entreprise_id'  => $tkd->id,
                'typologie_fr'   => 'Rénovation appartement',
                'typologie_en'   => 'Apartment renovation',
                'lieu'           => 'Douala, Bonamoussadi — FICTIF',
                'surface'        => 95.00,
                'annee'          => 2023,
                'budget_montant' => 12000000.00,
                'budget_devise'  => 'XAF',
                'image_principale' => null,
                'galerie'        => [],
                'plans'          => [],
                'parti_pris_fr'  => '[DEMO] Réhabilitation complète avec matériaux locaux. Placeholder.',
                'parti_pris_en'  => '[DEMO] Full rehabilitation with local materials. Placeholder.',
                'statut'         => 'realise',
                'visible'        => true,
                'ordre'          => 4,
            ],
        ];

        foreach ($projets as $data) {
            Projet::create($data);
        }
    }
}
