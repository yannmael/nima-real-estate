<?php

namespace Database\Seeders;

// DONNÉES DE DÉMONSTRATION FICTIVES — ne pas utiliser en production sans validation client
use App\Models\Entreprise;
use Illuminate\Database\Seeder;

class EntrepriseSeeder extends Seeder
{
    public function run(): void
    {
        $entreprises = [
            [
                'nom'            => 'NIMA Real Estate',
                'slug'           => 'nima-real-estate',
                'description_fr' => '[DEMO] Spécialiste de l\'immobilier résidentiel et commercial au Cameroun. Placeholder — à remplacer par le texte officiel du client.',
                'description_en' => '[DEMO] Specialist in residential and commercial real estate in Cameroon. Placeholder — to be replaced with the client\'s official text.',
                'logo'           => null,
                'couleur_accent' => '#1A3C5E',
                'actif'          => true,
                'ordre'          => 1,
                'services'       => [
                    ['fr' => 'Vente immobilière',     'en' => 'Property sales'],
                    ['fr' => 'Gestion locative',      'en' => 'Rental management'],
                    ['fr' => 'Conseil investissement', 'en' => 'Investment advisory'],
                ],
            ],
            [
                'nom'            => 'Infinite Sky Blue Design',
                'slug'           => 'infinite-sky-blue-design',
                'description_fr' => '[DEMO] Cabinet d\'architecture et de design d\'intérieur. Placeholder — à remplacer par le texte officiel du client.',
                'description_en' => '[DEMO] Architecture and interior design studio. Placeholder — to be replaced with the client\'s official text.',
                'logo'           => null,
                'couleur_accent' => '#3B82F6',
                'actif'          => true,
                'ordre'          => 2,
                'services'       => [
                    ['fr' => 'Architecture',        'en' => 'Architecture'],
                    ['fr' => 'Design d\'intérieur', 'en' => 'Interior design'],
                    ['fr' => 'Maîtrise d\'oeuvre',  'en' => 'Project management'],
                ],
            ],
            [
                'nom'            => 'TKD Construction',
                'slug'           => 'tkd-construction',
                'description_fr' => '[DEMO] Entreprise de construction générale et de rénovation. Placeholder — à remplacer par le texte officiel du client.',
                'description_en' => '[DEMO] General construction and renovation company. Placeholder — to be replaced with the client\'s official text.',
                'logo'           => null,
                'couleur_accent' => '#F59E0B',
                'actif'          => true,
                'ordre'          => 3,
                'services'       => [
                    ['fr' => 'Gros oeuvre',   'en' => 'Structural work'],
                    ['fr' => 'Second oeuvre', 'en' => 'Finishing works'],
                    ['fr' => 'Rénovation',    'en' => 'Renovation'],
                ],
            ],
            [
                'nom'            => 'Vintage Clean',
                'slug'           => 'vintage-clean',
                'description_fr' => '[DEMO] Services de nettoyage professionnel pour particuliers et entreprises. Placeholder — à remplacer par le texte officiel du client.',
                'description_en' => '[DEMO] Professional cleaning services for individuals and businesses. Placeholder — to be replaced with the client\'s official text.',
                'logo'           => null,
                'couleur_accent' => '#10B981',
                'actif'          => true,
                'ordre'          => 4,
                'services'       => [
                    ['fr' => 'Nettoyage résidentiel', 'en' => 'Residential cleaning'],
                    ['fr' => 'Nettoyage commercial',  'en' => 'Commercial cleaning'],
                    ['fr' => 'Nettoyage de chantier', 'en' => 'Post-construction cleaning'],
                ],
            ],
        ];

        foreach ($entreprises as $data) {
            Entreprise::create($data);
        }
    }
}
