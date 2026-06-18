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
                'histoire_fr'    => '[DEMO/FICTIF] Fondée en 2019 à Yaoundé, NIMA Real Estate s\'est imposée comme un acteur de référence du marché immobilier camerounais. Notre approche combine expertise locale et standards internationaux pour offrir des biens de qualité, de la première esquisse à la remise des clés. [PLACEHOLDER — texte définitif à fournir par le client]',
                'histoire_en'    => '[DEMO/FICTIF] Founded in 2019 in Yaoundé, NIMA Real Estate has established itself as a key player in the Cameroonian real estate market. Our approach combines local expertise with international standards to deliver quality properties, from the first sketch to handover. [PLACEHOLDER — final text to be provided by the client]',
                'logo'           => null,
                'couleur_accent' => '#1A3C5E',
                'actif'          => true,
                'ordre'          => 1,
                'services'       => [
                    ['fr' => 'Vente immobilière',      'en' => 'Property sales'],
                    ['fr' => 'Gestion locative',       'en' => 'Rental management'],
                    ['fr' => 'Conseil investissement', 'en' => 'Investment advisory'],
                ],
                'valeurs' => [
                    ['titre_fr' => '[DEMO] Transparence',  'titre_en' => '[DEMO] Transparency',  'desc_fr' => '[PLACEHOLDER — description de la valeur]', 'desc_en' => '[PLACEHOLDER — value description]'],
                    ['titre_fr' => '[DEMO] Excellence',    'titre_en' => '[DEMO] Excellence',    'desc_fr' => '[PLACEHOLDER — description de la valeur]', 'desc_en' => '[PLACEHOLDER — value description]'],
                    ['titre_fr' => '[DEMO] Proximité',     'titre_en' => '[DEMO] Proximity',     'desc_fr' => '[PLACEHOLDER — description de la valeur]', 'desc_en' => '[PLACEHOLDER — value description]'],
                ],
                'equipe' => [
                    ['nom' => '[DEMO] Prénom NOM', 'fonction_fr' => '[PLACEHOLDER — Directeur Général]',    'fonction_en' => '[PLACEHOLDER — CEO]'],
                    ['nom' => '[DEMO] Prénom NOM', 'fonction_fr' => '[PLACEHOLDER — Responsable commercial]', 'fonction_en' => '[PLACEHOLDER — Sales Manager]'],
                ],
            ],
            [
                'nom'            => 'Infinite Sky Blue Design',
                'slug'           => 'infinite-sky-blue-design',
                'description_fr' => '[DEMO] Cabinet d\'architecture et de design d\'intérieur. Placeholder — à remplacer par le texte officiel du client.',
                'description_en' => '[DEMO] Architecture and interior design studio. Placeholder — to be replaced with the client\'s official text.',
                'histoire_fr'    => '[DEMO/FICTIF] Cabinet d\'architecture fondé par une équipe de passionnés du cadre de vie, Infinite Sky Blue Design traduit vos ambitions en espaces habitables, fonctionnels et esthétiques. Chaque projet est une signature architecturale unique. [PLACEHOLDER — texte définitif à fournir par le client]',
                'histoire_en'    => '[DEMO/FICTIF] An architecture studio founded by a team passionate about living spaces, Infinite Sky Blue Design transforms your ambitions into liveable, functional and aesthetic spaces. Each project is a unique architectural signature. [PLACEHOLDER — final text to be provided by the client]',
                'logo'           => null,
                'couleur_accent' => '#3B82F6',
                'actif'          => true,
                'ordre'          => 2,
                'services'       => [
                    ['fr' => 'Architecture',        'en' => 'Architecture'],
                    ['fr' => 'Design d\'intérieur', 'en' => 'Interior design'],
                    ['fr' => 'Maîtrise d\'œuvre',   'en' => 'Project management'],
                ],
                'valeurs' => [
                    ['titre_fr' => '[DEMO] Créativité',   'titre_en' => '[DEMO] Creativity',    'desc_fr' => '[PLACEHOLDER — description de la valeur]', 'desc_en' => '[PLACEHOLDER — value description]'],
                    ['titre_fr' => '[DEMO] Fonctionnalité','titre_en' => '[DEMO] Functionality', 'desc_fr' => '[PLACEHOLDER — description de la valeur]', 'desc_en' => '[PLACEHOLDER — value description]'],
                    ['titre_fr' => '[DEMO] Durabilité',   'titre_en' => '[DEMO] Sustainability', 'desc_fr' => '[PLACEHOLDER — description de la valeur]', 'desc_en' => '[PLACEHOLDER — value description]'],
                ],
                'equipe' => [
                    ['nom' => '[DEMO] Prénom NOM', 'fonction_fr' => '[PLACEHOLDER — Architecte principal]', 'fonction_en' => '[PLACEHOLDER — Lead Architect]'],
                    ['nom' => '[DEMO] Prénom NOM', 'fonction_fr' => '[PLACEHOLDER — Designer d\'intérieur]', 'fonction_en' => '[PLACEHOLDER — Interior Designer]'],
                ],
            ],
            [
                'nom'            => 'TKD Construction',
                'slug'           => 'tkd-construction',
                'description_fr' => '[DEMO] Entreprise de construction générale et de rénovation. Placeholder — à remplacer par le texte officiel du client.',
                'description_en' => '[DEMO] General construction and renovation company. Placeholder — to be replaced with the client\'s official text.',
                'histoire_fr'    => '[DEMO/FICTIF] Spécialiste des travaux de construction et de rénovation au Cameroun, TKD Construction intervient du gros œuvre à la finition pour garantir des réalisations solides, conformes aux délais et aux budgets. [PLACEHOLDER — texte définitif à fournir par le client]',
                'histoire_en'    => '[DEMO/FICTIF] A specialist in construction and renovation works in Cameroon, TKD Construction handles everything from structural works to finishing to deliver solid results, on time and on budget. [PLACEHOLDER — final text to be provided by the client]',
                'logo'           => null,
                'couleur_accent' => '#F59E0B',
                'actif'          => true,
                'ordre'          => 3,
                'services'       => [
                    ['fr' => 'Gros œuvre',   'en' => 'Structural work'],
                    ['fr' => 'Second œuvre', 'en' => 'Finishing works'],
                    ['fr' => 'Rénovation',   'en' => 'Renovation'],
                ],
                'valeurs' => [
                    ['titre_fr' => '[DEMO] Rigueur',    'titre_en' => '[DEMO] Rigour',    'desc_fr' => '[PLACEHOLDER — description de la valeur]', 'desc_en' => '[PLACEHOLDER — value description]'],
                    ['titre_fr' => '[DEMO] Sécurité',   'titre_en' => '[DEMO] Safety',    'desc_fr' => '[PLACEHOLDER — description de la valeur]', 'desc_en' => '[PLACEHOLDER — value description]'],
                    ['titre_fr' => '[DEMO] Ponctualité','titre_en' => '[DEMO] Punctuality','desc_fr' => '[PLACEHOLDER — description de la valeur]', 'desc_en' => '[PLACEHOLDER — value description]'],
                ],
                'equipe' => [
                    ['nom' => '[DEMO] Prénom NOM', 'fonction_fr' => '[PLACEHOLDER — Chef de chantier]',  'fonction_en' => '[PLACEHOLDER — Site Manager]'],
                    ['nom' => '[DEMO] Prénom NOM', 'fonction_fr' => '[PLACEHOLDER — Ingénieur structure]','fonction_en' => '[PLACEHOLDER — Structural Engineer]'],
                ],
            ],
            [
                'nom'            => 'Vintage Clean',
                'slug'           => 'vintage-clean',
                'description_fr' => '[DEMO] Services de nettoyage professionnel pour particuliers et entreprises. Placeholder — à remplacer par le texte officiel du client.',
                'description_en' => '[DEMO] Professional cleaning services for individuals and businesses. Placeholder — to be replaced with the client\'s official text.',
                'histoire_fr'    => '[DEMO/FICTIF] Prestataire de services de nettoyage professionnel, Vintage Clean s\'adresse aux particuliers et aux entreprises soucieux de maintenir des espaces impeccables. Réactivité, discrétion et produits certifiés sont au cœur de notre offre. [PLACEHOLDER — texte définitif à fournir par le client]',
                'histoire_en'    => '[DEMO/FICTIF] A professional cleaning service provider, Vintage Clean serves individuals and businesses committed to maintaining impeccable spaces. Responsiveness, discretion and certified products are at the heart of our offering. [PLACEHOLDER — final text to be provided by the client]',
                'logo'           => null,
                'couleur_accent' => '#10B981',
                'actif'          => true,
                'ordre'          => 4,
                'services'       => [
                    ['fr' => 'Nettoyage résidentiel', 'en' => 'Residential cleaning'],
                    ['fr' => 'Nettoyage commercial',  'en' => 'Commercial cleaning'],
                    ['fr' => 'Nettoyage de chantier', 'en' => 'Post-construction cleaning'],
                ],
                'valeurs' => [
                    ['titre_fr' => '[DEMO] Propreté',   'titre_en' => '[DEMO] Cleanliness', 'desc_fr' => '[PLACEHOLDER — description de la valeur]', 'desc_en' => '[PLACEHOLDER — value description]'],
                    ['titre_fr' => '[DEMO] Discrétion', 'titre_en' => '[DEMO] Discretion',  'desc_fr' => '[PLACEHOLDER — description de la valeur]', 'desc_en' => '[PLACEHOLDER — value description]'],
                    ['titre_fr' => '[DEMO] Réactivité', 'titre_en' => '[DEMO] Responsiveness','desc_fr' => '[PLACEHOLDER — description de la valeur]', 'desc_en' => '[PLACEHOLDER — value description]'],
                ],
                'equipe' => [
                    ['nom' => '[DEMO] Prénom NOM', 'fonction_fr' => '[PLACEHOLDER — Responsable des opérations]', 'fonction_en' => '[PLACEHOLDER — Operations Manager]'],
                ],
            ],
        ];

        foreach ($entreprises as $data) {
            Entreprise::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
