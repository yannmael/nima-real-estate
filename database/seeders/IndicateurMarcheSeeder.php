<?php

namespace Database\Seeders;

use App\Models\IndicateurMarche;
use Illuminate\Database\Seeder;

/**
 * Données de marché — TOUS les chiffres sont des placeholders [À SOURCER].
 * Le client doit fournir les valeurs réelles avec leurs sources avant mise en ligne.
 * Modifier via le back-office admin ou directement en base, sans toucher au code.
 */
class IndicateurMarcheSeeder extends Seeder
{
    public function run(): void
    {
        $indicateurs = [

            /* ── MARCHÉ IMMOBILIER & MACRO ─────────────────────────────── */
            [
                'cle'             => 'pib_milliards_usd',
                'libelle_fr'      => 'PIB du Cameroun',
                'libelle_en'      => 'Cameroon GDP',
                'valeur'          => '[À SOURCER]',
                'unite_fr'        => 'Mds USD',
                'unite_en'        => 'Bln USD',
                'source_attendue' => 'Banque mondiale / FMI — dernière année disponible',
                'categorie'       => 'marche',
                'ordre'           => 1,
            ],
            [
                'cle'             => 'pib_croissance_pct',
                'libelle_fr'      => 'Croissance du PIB',
                'libelle_en'      => 'GDP growth',
                'valeur'          => '[À SOURCER]',
                'unite_fr'        => '% / an',
                'unite_en'        => '% / year',
                'source_attendue' => 'Banque mondiale / FMI — dernière projection disponible',
                'categorie'       => 'marche',
                'ordre'           => 2,
            ],
            [
                'cle'             => 'population_millions',
                'libelle_fr'      => 'Population',
                'libelle_en'      => 'Population',
                'valeur'          => '[À SOURCER]',
                'unite_fr'        => 'millions d\'hab.',
                'unite_en'        => 'million inhabitants',
                'source_attendue' => 'INS Cameroun / ONU — recensement ou projection',
                'categorie'       => 'marche',
                'ordre'           => 3,
            ],
            [
                'cle'             => 'urbanisation_pct',
                'libelle_fr'      => 'Taux d\'urbanisation',
                'libelle_en'      => 'Urbanisation rate',
                'valeur'          => '[À SOURCER]',
                'unite_fr'        => '%',
                'unite_en'        => '%',
                'source_attendue' => 'INS Cameroun / ONU Habitat',
                'categorie'       => 'marche',
                'ordre'           => 4,
            ],
            [
                'cle'             => 'deficit_logements_unites',
                'libelle_fr'      => 'Déficit de logements',
                'libelle_en'      => 'Housing deficit',
                'valeur'          => '[À SOURCER]',
                'unite_fr'        => 'unités',
                'unite_en'        => 'units',
                'source_attendue' => 'Ministère de l\'Habitat / ONU Habitat — rapport récent',
                'categorie'       => 'marche',
                'ordre'           => 5,
            ],
            [
                'cle'             => 'investissement_etranger_pct',
                'libelle_fr'      => 'Investissements directs étrangers',
                'libelle_en'      => 'Foreign direct investment',
                'valeur'          => '[À SOURCER]',
                'unite_fr'        => '% du PIB',
                'unite_en'        => '% of GDP',
                'source_attendue' => 'CNUCED / Banque mondiale — dernière année disponible',
                'categorie'       => 'marche',
                'ordre'           => 6,
            ],

            /* ── RENDEMENTS LOCATIFS ───────────────────────────────────── */
            [
                'cle'             => 'rendement_locatif_yaounde_pct',
                'libelle_fr'      => 'Rendement locatif brut — Yaoundé',
                'libelle_en'      => 'Gross rental yield — Yaoundé',
                'valeur'          => '[À SOURCER]',
                'unite_fr'        => '% / an',
                'unite_en'        => '% / year',
                'source_attendue' => 'Agences locales / étude de marché NIMA (données propriétaires)',
                'categorie'       => 'rendements',
                'ordre'           => 1,
            ],
            [
                'cle'             => 'rendement_locatif_douala_pct',
                'libelle_fr'      => 'Rendement locatif brut — Douala',
                'libelle_en'      => 'Gross rental yield — Douala',
                'valeur'          => '[À SOURCER]',
                'unite_fr'        => '% / an',
                'unite_en'        => '% / year',
                'source_attendue' => 'Agences locales / étude de marché NIMA (données propriétaires)',
                'categorie'       => 'rendements',
                'ordre'           => 2,
            ],
            [
                'cle'             => 'rendement_locatif_autres_pct',
                'libelle_fr'      => 'Rendement locatif brut — Autres villes',
                'libelle_en'      => 'Gross rental yield — Other cities',
                'valeur'          => '[À SOURCER]',
                'unite_fr'        => '% / an',
                'unite_en'        => '% / year',
                'source_attendue' => 'Agences locales / étude de marché NIMA (données propriétaires)',
                'categorie'       => 'rendements',
                'ordre'           => 3,
            ],
            [
                'cle'             => 'prix_m2_yaounde_fcfa',
                'libelle_fr'      => 'Prix moyen au m² — Yaoundé',
                'libelle_en'      => 'Average price per m² — Yaoundé',
                'valeur'          => '[À SOURCER]',
                'unite_fr'        => 'XAF / m²',
                'unite_en'        => 'XAF / m²',
                'source_attendue' => 'Étude de marché NIMA / annonces comparables — période à préciser',
                'categorie'       => 'rendements',
                'ordre'           => 4,
            ],
            [
                'cle'             => 'prix_m2_douala_fcfa',
                'libelle_fr'      => 'Prix moyen au m² — Douala',
                'libelle_en'      => 'Average price per m² — Douala',
                'valeur'          => '[À SOURCER]',
                'unite_fr'        => 'XAF / m²',
                'unite_en'        => 'XAF / m²',
                'source_attendue' => 'Étude de marché NIMA / annonces comparables — période à préciser',
                'categorie'       => 'rendements',
                'ordre'           => 5,
            ],
            [
                'cle'             => 'valorisation_annuelle_pct',
                'libelle_fr'      => 'Valorisation annuelle du foncier',
                'libelle_en'      => 'Annual land appreciation',
                'valeur'          => '[À SOURCER]',
                'unite_fr'        => '% / an (moy.)',
                'unite_en'        => '% / year (avg.)',
                'source_attendue' => 'Étude notariale / INS Cameroun — période à préciser',
                'categorie'       => 'rendements',
                'ordre'           => 6,
            ],

            /* ── CADRE JURIDIQUE ───────────────────────────────────────── */
            [
                'cle'             => 'droits_enregistrement_pct',
                'libelle_fr'      => 'Droits d\'enregistrement (mutation)',
                'libelle_en'      => 'Registration fees (transfer)',
                'valeur'          => '[À SOURCER]',
                'unite_fr'        => '% du prix de vente',
                'unite_en'        => '% of sale price',
                'source_attendue' => 'Code Général des Impôts du Cameroun — article à préciser',
                'categorie'       => 'juridique',
                'ordre'           => 1,
            ],
            [
                'cle'             => 'delai_titre_foncier_mois',
                'libelle_fr'      => 'Délai d\'obtention du titre foncier',
                'libelle_en'      => 'Land title registration timeline',
                'valeur'          => '[À SOURCER]',
                'unite_fr'        => 'mois (indicatif)',
                'unite_en'        => 'months (indicative)',
                'source_attendue' => 'MINDHU / notaires partenaires NIMA — délai moyen constaté',
                'categorie'       => 'juridique',
                'ordre'           => 2,
            ],
            [
                'cle'             => 'impot_plus_value_pct',
                'libelle_fr'      => 'Impôt sur la plus-value immobilière',
                'libelle_en'      => 'Capital gains tax (real estate)',
                'valeur'          => '[À SOURCER]',
                'unite_fr'        => '%',
                'unite_en'        => '%',
                'source_attendue' => 'Code Général des Impôts du Cameroun — article à préciser',
                'categorie'       => 'juridique',
                'ordre'           => 3,
            ],
            [
                'cle'             => 'duree_bail_residentiel_ans',
                'libelle_fr'      => 'Durée maximale bail résidentiel',
                'libelle_en'      => 'Max residential lease term',
                'valeur'          => '[À SOURCER]',
                'unite_fr'        => 'ans',
                'unite_en'        => 'years',
                'source_attendue' => 'Code Civil camerounais / loi sur les baux',
                'categorie'       => 'juridique',
                'ordre'           => 4,
            ],
        ];

        foreach ($indicateurs as $data) {
            IndicateurMarche::updateOrCreate(['cle' => $data['cle']], $data);
        }
    }
}
