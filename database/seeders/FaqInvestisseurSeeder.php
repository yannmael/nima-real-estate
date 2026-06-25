<?php

namespace Database\Seeders;

use App\Models\FaqInvestisseur;
use Illuminate\Database\Seeder;

/**
 * FAQ investisseurs — questions structurelles (procédures, droit, fiscalité).
 * Les réponses sont des templates à compléter par le client avec les détails exacts.
 * Modifier via le back-office admin sans toucher au code.
 */
class FaqInvestisseurSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'ordre'       => 1,
                'question_fr' => 'Un étranger non-résident peut-il acheter un bien immobilier au Cameroun ?',
                'question_en' => 'Can a non-resident foreigner buy real estate in Cameroon?',
                'reponse_fr'  => '[À COMPLÉTER PAR LE CLIENT — Indiquer les conditions légales, les restrictions éventuelles sur la propriété foncière par les étrangers, et les types de titres accessibles (titre foncier, bail emphytéotique…). Source : code foncier camerounais, ordonnance n° 74-1 du 6 juillet 1974.]',
                'reponse_en'  => '[TO BE COMPLETED BY CLIENT — Describe the legal conditions, any restrictions on foreign land ownership, and accessible title types (freehold, long lease…). Source: Cameroonian land law, Ordinance No. 74-1 of 6 July 1974.]',
                'publiee'     => true,
            ],
            [
                'ordre'       => 2,
                'question_fr' => 'Comment transférer des fonds vers le Cameroun pour un investissement immobilier ?',
                'question_en' => 'How do I transfer funds to Cameroon for a real estate investment?',
                'reponse_fr'  => '[À COMPLÉTER PAR LE CLIENT — Décrire les réglementations CEMAC sur les transferts de capitaux, les documents requis par les banques camerounaises, les délais moyens constatés et les éventuels plafonds. Mentionner si virement SWIFT ou mobile money sont utilisables.]',
                'reponse_en'  => '[TO BE COMPLETED BY CLIENT — Describe CEMAC capital transfer regulations, documents required by Cameroonian banks, typical processing times and any thresholds. Specify whether SWIFT wire transfer or mobile money can be used.]',
                'publiee'     => true,
            ],
            [
                'ordre'       => 3,
                'question_fr' => 'Quelle est la fiscalité applicable aux loyers perçus au Cameroun par un non-résident ?',
                'question_en' => 'What tax applies to rental income received in Cameroon by a non-resident?',
                'reponse_fr'  => '[À COMPLÉTER PAR LE CLIENT — Indiquer le taux de retenue à la source sur les loyers pour non-résidents, l\'existence éventuelle de conventions fiscales entre le Cameroun et les pays concernés, et les obligations déclaratives. Source : Code Général des Impôts du Cameroun.]',
                'reponse_en'  => '[TO BE COMPLETED BY CLIENT — Specify the withholding tax rate on rental income for non-residents, any applicable tax treaties between Cameroon and relevant countries, and filing obligations. Source: Cameroon General Tax Code.]',
                'publiee'     => true,
            ],
            [
                'ordre'       => 4,
                'question_fr' => 'Qu\'est-ce que le titre foncier et pourquoi est-il indispensable ?',
                'question_en' => 'What is a land title (titre foncier) and why is it essential?',
                'reponse_fr'  => '[À COMPLÉTER PAR LE CLIENT — Expliquer que le titre foncier est l\'acte juridique qui garantit la propriété au Cameroun, la différence avec un simple acte de vente notarié, le risque des terrains sans titre, et la procédure d\'immatriculation. Source : MINDHU / notaires partenaires NIMA.]',
                'reponse_en'  => '[TO BE COMPLETED BY CLIENT — Explain that the land title is the legal document guaranteeing ownership in Cameroon, the difference from a notarised deed alone, risks of untitled land, and the registration process. Source: MINDHU / NIMA partner notaries.]',
                'publiee'     => true,
            ],
            [
                'ordre'       => 5,
                'question_fr' => 'NIMA Real Estate peut-il gérer mon bien à distance ?',
                'question_en' => 'Can NIMA Real Estate manage my property remotely?',
                'reponse_fr'  => '[À COMPLÉTER PAR LE CLIENT — Décrire les services de gestion locative proposés (recherche de locataires, encaissement, entretien, reporting), les honoraires correspondants, et la façon dont les loyers sont reversés à l\'investisseur non-résident.]',
                'reponse_en'  => '[TO BE COMPLETED BY CLIENT — Describe the property management services offered (tenant sourcing, rent collection, maintenance, reporting), the associated fees, and how rental income is remitted to non-resident investors.]',
                'publiee'     => true,
            ],
            [
                'ordre'       => 6,
                'question_fr' => 'Quelles sont les villes les plus rentables pour investir au Cameroun ?',
                'question_en' => 'Which cities offer the best returns for real estate investment in Cameroon?',
                'reponse_fr'  => '[À COMPLÉTER PAR LE CLIENT — Comparer Yaoundé, Douala et les villes secondaires (Bafoussam, Limbé, Kribi…) selon les critères de rendement locatif, demande locative, projets d\'infrastructure. Utiliser les données de l\'étude interne NIMA ou des sources tierces citées.]',
                'reponse_en'  => '[TO BE COMPLETED BY CLIENT — Compare Yaoundé, Douala and secondary cities (Bafoussam, Limbé, Kribi…) by rental yield, rental demand, and infrastructure projects. Use NIMA internal study data or cited third-party sources.]',
                'publiee'     => true,
            ],
        ];

        foreach ($faqs as $data) {
            FaqInvestisseur::updateOrCreate(
                ['question_fr' => $data['question_fr']],
                $data
            );
        }
    }
}
