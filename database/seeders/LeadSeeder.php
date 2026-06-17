<?php

namespace Database\Seeders;

// DONNÉES DE DÉMONSTRATION FICTIVES — personnes, emails et numéros entièrement inventés
use App\Models\Lead;
use Illuminate\Database\Seeder;

class LeadSeeder extends Seeder
{
    public function run(): void
    {
        $leads = [
            [
                'prenom'       => 'Alice',
                'nom_contact'  => 'Dupont (FICTIF)',
                'email'        => 'alice.fictif@exemple-demo.com',
                'telephone'    => '+237 6XX XXX XXX',
                'type_projet'  => 'achat',
                'surface'      => 200,
                'budget'       => '60 000 000 - 80 000 000 XAF (fictif)',
                'lieu'         => 'Douala, Akwa',
                'message'      => '[DEMO] Bonjour, je recherche une villa avec jardin pour ma famille. Message fictif.',
                'source'       => 'formulaire_contact',
                'score'        => 75,
                'locale'       => 'fr',
            ],
            [
                'prenom'       => 'John',
                'nom_contact'  => 'Smith (FICTITIOUS)',
                'email'        => 'john.fictitious@example-demo.com',
                'telephone'    => '+33 6XX XXX XXX',
                'type_projet'  => 'investissement',
                'surface'      => null,
                'budget'       => '100 000 EUR (fictitious)',
                'lieu'         => 'Yaoundé',
                'message'      => '[DEMO] I am looking for investment opportunities in Cameroon. Fictitious message.',
                'source'       => 'landing_investir',
                'score'        => 85,
                'locale'       => 'en',
            ],
            [
                'prenom'       => 'Marie',
                'nom_contact'  => 'Nkolo (FICTIF)',
                'email'        => 'marie.fictif@exemple-demo.com',
                'telephone'    => null,
                'type_projet'  => 'location',
                'surface'      => 80,
                'budget'       => '200 000 XAF/mois (fictif)',
                'lieu'         => 'Douala, Bonamoussadi',
                'message'      => '[DEMO] Je cherche un appartement 3 pièces pour septembre. Message fictif.',
                'source'       => 'formulaire_contact',
                'score'        => 40,
                'locale'       => 'fr',
            ],
        ];

        foreach ($leads as $data) {
            Lead::create($data);
        }
    }
}
