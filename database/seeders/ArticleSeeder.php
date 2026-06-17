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
                'titre_fr'            => '[DEMO] Pourquoi investir dans l\'immobilier au Cameroun en 2025 ?',
                'titre_en'            => '[DEMO] Why invest in real estate in Cameroon in 2025?',
                'slug_fr'             => 'demo-investir-immobilier-cameroun-2025',
                'slug_en'             => 'demo-invest-real-estate-cameroon-2025',
                'contenu_fr'          => '<p><strong>[CONTENU DE DÉMONSTRATION — à remplacer par le texte réel du client avec sources vérifiées]</strong></p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>',
                'contenu_en'          => '<p><strong>[DEMO CONTENT — to be replaced with the client\'s actual text and verified sources]</strong></p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>',
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
                'titre_fr'            => '[DEMO] 5 critères pour choisir votre terrain à Douala',
                'titre_en'            => '[DEMO] 5 criteria for choosing your plot in Douala',
                'slug_fr'             => 'demo-criteres-choisir-terrain-douala',
                'slug_en'             => 'demo-criteria-choose-plot-douala',
                'contenu_fr'          => '<p><strong>[CONTENU DE DÉMONSTRATION — à remplacer]</strong></p><p>Cras accumsan lorem velit, at scelerisque nibh scelerisque sed.</p>',
                'contenu_en'          => '<p><strong>[DEMO CONTENT — to be replaced]</strong></p><p>Cras accumsan lorem velit, at scelerisque nibh scelerisque sed.</p>',
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
                'titre_fr'            => '[DEMO] Article en brouillon — titre à définir',
                'titre_en'            => '[DEMO] Draft article — title to be defined',
                'slug_fr'             => 'demo-article-brouillon',
                'slug_en'             => 'demo-draft-article',
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
            Article::create($data);
        }
    }
}
