<?php

namespace Database\Seeders;

// DONNÉES DE DÉMONSTRATION FICTIVES — contenu et chiffres entièrement inventés
use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'slug_fr'             => 'demo-investir-immobilier-cameroun-2025',
                'slug_en'             => 'demo-invest-real-estate-cameroon-2025',
                'titre_fr'            => '[DEMO] Pourquoi investir dans l\'immobilier au Cameroun en 2025 ?',
                'titre_en'            => '[DEMO] Why invest in real estate in Cameroon in 2025?',
                'contenu_fr'          => '<p><strong>[CONTENU DE DÉMONSTRATION — à remplacer par le texte réel du client avec sources vérifiées]</strong></p><h2>Un marché en pleine expansion</h2><p>Le Cameroun connaît une croissance démographique soutenue qui alimente mécaniquement la demande de logements neufs et de surfaces commerciales dans les grandes agglomérations. Yaoundé et Douala concentrent l\'essentiel des flux d\'investissement, mais les villes secondaires comme Bafoussam et Kribi gagnent en attractivité.</p><h2>Des fondamentaux solides</h2><p>La stabilité politique relative de la zone CEMAC et l\'ancrage de la monnaie à l\'euro (XAF/EUR, parité fixe garantie) réduisent le risque de change pour les investisseurs internationaux. Ces éléments constituent des avantages structurels rares sur le continent africain.</p><h2>Points de vigilance</h2><p>Comme tout marché émergent, l\'investissement immobilier au Cameroun nécessite une due diligence rigoureuse : vérification du titre foncier, contrôle des servitudes et des autorisations d\'urbanisme. NIMA Real Estate vous accompagne dans toutes ces démarches.</p>',
                'contenu_en'          => '<p><strong>[DEMO CONTENT — to be replaced with the client\'s actual text and verified sources]</strong></p><h2>An expanding market</h2><p>Cameroon\'s sustained demographic growth is mechanically fuelling demand for new housing and commercial space in major urban centres. Yaoundé and Douala attract the bulk of investment flows, but secondary cities such as Bafoussam and Kribi are gaining in appeal.</p><h2>Sound fundamentals</h2><p>The relative political stability of the CEMAC zone and the currency peg to the euro (XAF/EUR, fixed guaranteed parity) reduce currency risk for international investors — a rare structural advantage on the African continent.</p><h2>Key considerations</h2><p>As with any emerging market, real estate investment in Cameroon requires rigorous due diligence: verifying the land title, checking easements and planning permissions. NIMA Real Estate guides you through every step.</p>',
                'image_couverture'    => null,
                'categories'          => ['investissement', 'marche'],
                'tags'                => ['Cameroun', 'immobilier', '2025'],
                'meta_titre_fr'       => '[DEMO] Investir au Cameroun 2025 — NIMA Real Estate',
                'meta_titre_en'       => '[DEMO] Invest in Cameroon 2025 — NIMA Real Estate',
                'meta_description_fr' => '[DEMO] Placeholder meta-description FR — à rédiger par le client.',
                'meta_description_en' => '[DEMO] Placeholder meta-description EN — to be written by the client.',
                'statut'              => 'publie',
                'published_at'        => now()->subDays(10),
            ],
            [
                'slug_fr'             => 'demo-criteres-choisir-terrain-douala',
                'slug_en'             => 'demo-criteria-choose-plot-douala',
                'titre_fr'            => '[DEMO] 5 critères pour choisir votre terrain à Douala',
                'titre_en'            => '[DEMO] 5 criteria for choosing your plot in Douala',
                'contenu_fr'          => '<p><strong>[CONTENU DE DÉMONSTRATION — à remplacer]</strong></p><h2>1. Le titre foncier</h2><p>C\'est le critère non-négociable. Un terrain sans titre foncier enregistré au livre foncier expose l\'acquéreur à des risques juridiques majeurs. Exigez toujours la copie certifiée du titre avant toute transaction.</p><h2>2. L\'accessibilité</h2><p>La desserte par une voie bitumée, la proximité des axes principaux et l\'accès aux transports en commun conditionnent fortement la valeur locative et la liquidité du bien à la revente.</p><h2>3. Les viabilités</h2><p>Eau, électricité, réseau d\'assainissement : vérifiez les raccordements existants ou le coût de mise en viabilité avant d\'intégrer le terrain dans votre plan de financement.</p><h2>4. Le zonage</h2><p>Le Plan d\'Occupation des Sols (POS) définit les droits à construire. Un terrain classé R2 n\'autorise pas les mêmes gabarits qu\'un terrain R4. Consultez les services d\'urbanisme de la CUD.</p><h2>5. La topographie</h2><p>Un terrain en pente nécessite des terrassements coûteux. Les zones inondables ou marécageuses impliquent des fondations spéciales qui peuvent doubler le coût de construction.</p>',
                'contenu_en'          => '<p><strong>[DEMO CONTENT — to be replaced]</strong></p><h2>1. The land title</h2><p>This is the non-negotiable criterion. A plot without a land title registered in the land register exposes the buyer to major legal risks. Always require a certified copy of the title before any transaction.</p><h2>2. Accessibility</h2><p>Access via a paved road, proximity to main arteries, and public transport links are key drivers of rental value and resale liquidity.</p><h2>3. Utilities</h2><p>Water, electricity, sewage network: check existing connections or the cost of utility installation before factoring the plot into your financing plan.</p><h2>4. Zoning</h2><p>The Local Development Plan (POS) defines building rights. An R2-classified plot does not allow the same floor-area ratio as an R4 plot. Consult the CUD urban planning department.</p><h2>5. Topography</h2><p>A sloping plot requires costly earthworks. Flood-prone or marshy areas require special foundations that can double construction costs.</p>',
                'image_couverture'    => null,
                'categories'          => ['conseils', 'achat'],
                'tags'                => ['terrain', 'Douala', 'guide'],
                'meta_titre_fr'       => '[DEMO] Choisir un terrain à Douala — guide NIMA',
                'meta_titre_en'       => '[DEMO] Choosing a plot in Douala — NIMA guide',
                'meta_description_fr' => '[DEMO] Placeholder meta-description FR.',
                'meta_description_en' => '[DEMO] Placeholder meta-description EN.',
                'statut'              => 'publie',
                'published_at'        => now()->subDays(3),
            ],
            [
                'slug_fr'             => 'demo-comprendre-titre-foncier-cameroun',
                'slug_en'             => 'demo-understanding-land-title-cameroon',
                'titre_fr'            => '[DEMO] Le titre foncier au Cameroun : tout ce qu\'il faut savoir',
                'titre_en'            => '[DEMO] The land title in Cameroon: everything you need to know',
                'contenu_fr'          => '<p><strong>[CONTENU DE DÉMONSTRATION — à remplacer par un texte juridiquement validé]</strong></p><h2>Qu\'est-ce que le titre foncier ?</h2><p>Le titre foncier est l\'acte juridique qui consacre et garantit la propriété foncière au Cameroun. Institué par l\'ordonnance n° 74-1 du 6 juillet 1974, il est inattaquable, intangible et imprescriptible. Il est le seul document qui prouve la propriété de manière absolue.</p><h2>La procédure d\'immatriculation</h2><p>L\'immatriculation est le processus d\'inscription d\'un immeuble au Livre Foncier. Elle peut être initiée par le propriétaire (immatriculation directe) ou découlée d\'une mutation (vente, donation, héritage). Les délais moyens constatés varient selon la juridiction compétente.</p><h2>Risques des terrains sans titre</h2><p>L\'achat d\'un terrain muni d\'un simple acte de vente sous seing privé, sans titre foncier établi, expose l\'acquéreur à des revendications concurrentes et à l\'impossibilité d\'hypothéquer le bien pour obtenir un financement bancaire.</p><h2>Notre accompagnement</h2><p>NIMA Real Estate travaille avec un réseau de notaires et géomètres experts partenaires pour sécuriser l\'ensemble de vos transactions foncières, de la vérification du titre à la mutation définitive.</p>',
                'contenu_en'          => '<p><strong>[DEMO CONTENT — to be replaced with legally validated text]</strong></p><h2>What is a land title?</h2><p>The land title is the legal document that consecrates and guarantees land ownership in Cameroon. Established by Ordinance No. 74-1 of 6 July 1974, it is incontestable, immutable and imprescriptible — the only document that proves ownership absolutely.</p><h2>The registration process</h2><p>Registration is the process of recording a property in the Land Register. It can be initiated by the owner (direct registration) or arise from a transfer (sale, gift, inheritance). Average timelines vary by competent jurisdiction.</p><h2>Risks of untitled land</h2><p>Purchasing land backed only by a private deed, without an established land title, exposes the buyer to competing claims and makes it impossible to mortgage the property for bank financing.</p><h2>Our support</h2><p>NIMA Real Estate works with a network of partner notaries and expert surveyors to secure all your land transactions, from title verification to final transfer.</p>',
                'image_couverture'    => null,
                'categories'          => ['juridique', 'achat'],
                'tags'                => ['titre foncier', 'Cameroun', 'foncier'],
                'meta_titre_fr'       => '[DEMO] Titre foncier Cameroun — guide complet NIMA',
                'meta_titre_en'       => '[DEMO] Cameroon land title — complete NIMA guide',
                'meta_description_fr' => '[DEMO] Tout savoir sur le titre foncier au Cameroun : procédure, délais, risques. Guide NIMA Real Estate.',
                'meta_description_en' => '[DEMO] Everything about the land title in Cameroon: process, timelines, risks. NIMA Real Estate guide.',
                'statut'              => 'publie',
                'published_at'        => now()->subDays(18),
            ],
            [
                'slug_fr'             => 'demo-construire-maison-yaaounde-etapes',
                'slug_en'             => 'demo-building-house-yaounde-steps',
                'titre_fr'            => '[DEMO] Construire sa maison à Yaoundé : les étapes clés',
                'titre_en'            => '[DEMO] Building your house in Yaoundé: the key steps',
                'contenu_fr'          => '<p><strong>[CONTENU DE DÉMONSTRATION — à remplacer]</strong></p><h2>Étape 1 : L\'acquisition du terrain</h2><p>Avant toute chose, sécurisez le foncier avec un titre foncier régulier. C\'est la base indispensable sur laquelle repose tout le projet de construction.</p><h2>Étape 2 : L\'étude de faisabilité</h2><p>Un architecte agréé réalise l\'étude de sol, le plan de masse et l\'avant-projet sommaire (APS). Cette phase détermine la nature des fondations et les contraintes réglementaires applicables au terrain.</p><h2>Étape 3 : Le permis de construire</h2><p>Le permis de construire est obligatoire pour toute construction de plus de [SURFACE — à préciser] m². Il est instruit par la commune d\'arrondissement compétente. Le délai d\'instruction est en moyenne de [DÉLAI — à sourcer] mois.</p><h2>Étape 4 : Le chantier</h2><p>TKD Construction, notre filiale spécialisée, assure la maîtrise d\'œuvre et le suivi de chantier. Chaque étape est jalonnée par des réceptions partielles documentées.</p><h2>Étape 5 : La réception et la livraison</h2><p>La réception des travaux est un acte contractuel important qui marque le transfert de responsabilité de l\'entreprise au maître d\'ouvrage. Elle doit être formalisée par un procès-verbal signé des deux parties.</p>',
                'contenu_en'          => '<p><strong>[DEMO CONTENT — to be replaced]</strong></p><h2>Step 1: Securing the land</h2><p>First and foremost, secure the land with a proper land title. This is the essential foundation on which the entire construction project rests.</p><h2>Step 2: Feasibility study</h2><p>A licensed architect carries out the soil survey, site plan and preliminary sketch design (APS). This phase determines the type of foundations required and the regulatory constraints applicable to the plot.</p><h2>Step 3: Building permit</h2><p>A building permit is mandatory for any construction exceeding [AREA — to specify] m². It is processed by the competent district council. Average processing time is [TIMELINE — to source] months.</p><h2>Step 4: Construction</h2><p>TKD Construction, our specialist subsidiary, handles project management and site supervision. Each phase is marked by documented partial acceptances.</p><h2>Step 5: Handover</h2><p>The handover is a key contractual act marking the transfer of responsibility from the contractor to the owner. It must be formalised by a handover report signed by both parties.</p>',
                'image_couverture'    => null,
                'categories'          => ['construction', 'conseils'],
                'tags'                => ['Yaoundé', 'construction', 'permis de construire'],
                'meta_titre_fr'       => '[DEMO] Construire à Yaoundé — guide étapes NIMA',
                'meta_titre_en'       => '[DEMO] Building in Yaoundé — step-by-step NIMA guide',
                'meta_description_fr' => '[DEMO] Les étapes pour construire votre maison à Yaoundé avec NIMA Real Estate et TKD Construction.',
                'meta_description_en' => '[DEMO] Steps to build your house in Yaoundé with NIMA Real Estate and TKD Construction.',
                'statut'              => 'publie',
                'published_at'        => now()->subDays(25),
            ],
            [
                'slug_fr'             => 'demo-fiscalite-revenus-locatifs-cameroun',
                'slug_en'             => 'demo-rental-income-tax-cameroon',
                'titre_fr'            => '[DEMO] Fiscalité des revenus locatifs au Cameroun : ce que dit la loi',
                'titre_en'            => '[DEMO] Rental income tax in Cameroon: what the law says',
                'contenu_fr'          => '<p><strong>[CONTENU DE DÉMONSTRATION — à remplacer par un texte fiscalement validé, en citant les articles du CGI en vigueur]</strong></p><h2>L\'impôt sur les revenus fonciers</h2><p>Les revenus tirés de la location de biens immobiliers sont soumis à l\'impôt sur le revenu des personnes physiques (IRPP) dans la catégorie des revenus fonciers. [TAUX ET MODALITÉS — à préciser en citant le Code Général des Impôts du Cameroun, articles à identifier].</p><h2>Le cas des non-résidents</h2><p>Pour les propriétaires non-résidents, une retenue à la source s\'applique sur les loyers versés. [TAUX DE RETENUE — à sourcer]. Les conventions fiscales éventuellement conclues entre le Cameroun et le pays de résidence de l\'investisseur peuvent modifier ce régime.</p><h2>La Taxe Foncière sur les Propriétés Bâties (TFPB)</h2><p>La TFPB est due annuellement par le propriétaire. Elle est calculée sur la valeur locative cadastrale du bien. [TAUX ET EXONÉRATIONS — à préciser selon le CGI en vigueur].</p><h2>Optimisation légale</h2><p>Certains régimes permettent de déduire des charges réelles de vos revenus bruts (travaux d\'entretien, intérêts d\'emprunt, primes d\'assurance). Consultez un expert-comptable agréé pour optimiser votre situation fiscale dans le respect du droit camerounais.</p>',
                'contenu_en'          => '<p><strong>[DEMO CONTENT — to be replaced with fiscally validated text, citing current CGI articles]</strong></p><h2>Tax on rental income</h2><p>Income from renting real estate is subject to personal income tax (IRPP) under the rental income category. [RATES AND CONDITIONS — to be specified citing the Cameroon General Tax Code, articles to be identified].</p><h2>Non-resident owners</h2><p>For non-resident property owners, withholding tax applies to rental payments. [WITHHOLDING RATE — to source]. Tax treaties between Cameroon and the investor\'s country of residence may modify this regime.</p><h2>Property tax on built properties (TFPB)</h2><p>TFPB is due annually by the owner. It is calculated on the cadastral rental value of the property. [RATES AND EXEMPTIONS — to specify per current CGI].</p><h2>Legal optimisation</h2><p>Certain regimes allow you to deduct actual expenses from gross income (maintenance works, loan interest, insurance premiums). Consult a licensed accountant to optimise your tax situation within Cameroonian law.</p>',
                'image_couverture'    => null,
                'categories'          => ['juridique', 'investissement'],
                'tags'                => ['fiscalité', 'Cameroun', 'location'],
                'meta_titre_fr'       => '[DEMO] Fiscalité locative Cameroun — NIMA Real Estate',
                'meta_titre_en'       => '[DEMO] Rental tax Cameroon — NIMA Real Estate',
                'meta_description_fr' => '[DEMO] Comprendre la fiscalité des revenus locatifs au Cameroun : IRPP, retenue non-résidents, TFPB.',
                'meta_description_en' => '[DEMO] Understanding rental income tax in Cameroon: IRPP, non-resident withholding, TFPB.',
                'statut'              => 'publie',
                'published_at'        => now()->subDays(32),
            ],
            [
                'slug_fr'             => 'demo-gestion-locative-a-distance',
                'slug_en'             => 'demo-remote-property-management',
                'titre_fr'            => '[DEMO] Gérer votre bien immobilier à distance depuis l\'étranger',
                'titre_en'            => '[DEMO] Managing your property remotely from abroad',
                'contenu_fr'          => '<p><strong>[CONTENU DE DÉMONSTRATION — à remplacer par le texte de l\'équipe NIMA]</strong></p><h2>Les défis de la gestion à distance</h2><p>Posséder un bien immobilier au Cameroun depuis l\'étranger soulève des questions pratiques : qui assure la relation locataire ? Qui gère les impayés et les réparations d\'urgence ? Comment recevoir ses loyers dans la devise de son choix ?</p><h2>Notre solution de gestion locative</h2><p>NIMA Real Estate propose un service de gestion locative clé en main qui couvre la recherche et la sélection des locataires, l\'encaissement des loyers, le suivi des travaux d\'entretien et le reporting mensuel détaillé.</p><h2>Le reporting investisseur</h2><p>Chaque mois, vous recevez un rapport de gestion complet : état des encaissements, dépenses engagées, taux d\'occupation, compte rendu des visites d\'entretien et signalement de tout incident locatif.</p><h2>Le virement des fonds</h2><p>Les loyers collectés sont virés mensuellement sur le compte bancaire de votre choix, dans le respect de la réglementation de change CEMAC applicable aux transferts de capitaux. [DÉLAIS ET FRAIS DE VIREMENT — à préciser].</p>',
                'contenu_en'          => '<p><strong>[DEMO CONTENT — to be replaced with NIMA team text]</strong></p><h2>The challenges of remote management</h2><p>Owning property in Cameroon from abroad raises practical questions: who manages the tenant relationship? Who handles late payments and emergency repairs? How do you receive rent in your preferred currency?</p><h2>Our property management solution</h2><p>NIMA Real Estate offers a turnkey property management service covering tenant search and selection, rent collection, maintenance works follow-up and detailed monthly reporting.</p><h2>Investor reporting</h2><p>Each month you receive a comprehensive management report: rent collection status, expenses incurred, occupancy rate, maintenance visit summaries and any tenancy incident notifications.</p><h2>Fund transfers</h2><p>Collected rents are wired monthly to your nominated bank account, in compliance with the CEMAC foreign exchange regulations applicable to capital transfers. [TRANSFER TIMES AND FEES — to specify].</p>',
                'image_couverture'    => null,
                'categories'          => ['investissement', 'conseils'],
                'tags'                => ['gestion locative', 'non-résident', 'Cameroun'],
                'meta_titre_fr'       => '[DEMO] Gestion locative à distance Cameroun — NIMA',
                'meta_titre_en'       => '[DEMO] Remote property management Cameroon — NIMA',
                'meta_description_fr' => '[DEMO] NIMA Real Estate gère votre bien immobilier camerounais depuis l\'étranger : reporting, loyers, entretien.',
                'meta_description_en' => '[DEMO] NIMA Real Estate manages your Cameroonian property from abroad: reporting, rents, maintenance.',
                'statut'              => 'publie',
                'published_at'        => now()->subDays(40),
            ],
            [
                'slug_fr'             => 'demo-article-brouillon',
                'slug_en'             => 'demo-draft-article',
                'titre_fr'            => '[DEMO] Article en brouillon — titre à définir',
                'titre_en'            => '[DEMO] Draft article — title to be defined',
                'contenu_fr'          => null,
                'contenu_en'          => null,
                'image_couverture'    => null,
                'categories'          => [],
                'tags'                => [],
                'meta_titre_fr'       => null,
                'meta_titre_en'       => null,
                'meta_description_fr' => null,
                'meta_description_en' => null,
                'statut'              => 'brouillon',
                'published_at'        => null,
            ],
        ];

        foreach ($articles as $data) {
            Article::updateOrCreate(['slug_fr' => $data['slug_fr']], $data);
        }
    }
}
