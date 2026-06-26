<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Entreprise;
use App\Models\Projet;

class SeoService
{
    /** Nœud LocalBusiness partagé — NIMA SARL / NIMA Real Estate */
    public static function localBusiness(array $overrides = []): array
    {
        return array_replace_recursive([
            '@type'     => 'LocalBusiness',
            '@id'       => config('app.url') . '/#organization',
            'name'      => 'NIMA Real Estate',
            'legalName' => 'NIMA SARL',
            'url'       => config('app.url'),
            'logo'      => config('nima.seo.og_image'),
            'image'     => config('nima.seo.og_image'),
            'telephone' => config('nima.contact.phone'),
            'email'     => config('nima.contact.email'),
            'address'   => [
                '@type'           => 'PostalAddress',
                'streetAddress'   => config('nima.contact.address'),
                'addressLocality' => 'Yaoundé',
                'addressRegion'   => 'Centre',
                'addressCountry'  => 'CM',
            ],
            'geo' => [
                '@type'     => 'GeoCoordinates',
                'latitude'  => (float) config('nima.map.lat'),
                'longitude' => (float) config('nima.map.lng'),
            ],
        ], $overrides);
    }

    /** Nœud WebSite racine */
    public static function website(): array
    {
        return [
            '@type'     => 'WebSite',
            '@id'       => config('app.url') . '/#website',
            'url'       => config('app.url'),
            'name'      => 'NIMA Real Estate',
            'inLanguage' => ['fr-FR', 'en-GB'],
            'publisher' => ['@id' => config('app.url') . '/#organization'],
        ];
    }

    /** BreadcrumbList générique — $items = [['name' => '...', 'url' => '...'], ...] */
    public static function breadcrumb(array $items): array
    {
        return [
            '@type'           => 'BreadcrumbList',
            'itemListElement' => array_map(static function (array $item, int $idx): array {
                $el = [
                    '@type'    => 'ListItem',
                    'position' => $idx + 1,
                    'name'     => $item['name'],
                ];
                if (!empty($item['url'])) {
                    $el['item'] = $item['url'];
                }
                return $el;
            }, $items, array_keys($items)),
        ];
    }

    /** Enveloppe @graph (plusieurs types sur une même page) */
    public static function graph(array ...$nodes): array
    {
        return [
            '@context' => 'https://schema.org',
            '@graph'   => array_values($nodes),
        ];
    }

    /** Schéma Project pour une fiche projet */
    public static function project(Projet $projet, string $locale): array
    {
        $schema = [
            '@type'    => 'Project',
            'name'     => $projet->titre,
            'url'      => route('locale.projet', ['locale' => $locale, 'slug' => $projet->slug]),
            'location' => [
                '@type'          => 'Place',
                'name'           => $projet->lieu,
                'addressCountry' => 'CM',
            ],
        ];

        if ($projet->parti_pris) {
            $schema['description'] = mb_substr(strip_tags($projet->parti_pris), 0, 300);
        }

        if ($projet->image_principale) {
            $schema['image'] = asset($projet->image_principale);
        }

        if ($projet->annee) {
            $schema['startDate'] = (string) $projet->annee;
        }

        if ($projet->surface) {
            $schema['additionalProperty'] = [
                '@type' => 'PropertyValue',
                'name'  => 'Surface',
                'value' => $projet->surface . ' m²',
            ];
        }

        return $schema;
    }

    /** Schéma BlogPosting pour un article */
    public static function blogPosting(Article $article, string $locale): array
    {
        $colSlug = $locale === 'en' ? 'slug_en' : 'slug_fr';
        $url     = route('locale.article', ['locale' => $locale, 'slug' => $article->{$colSlug}]);

        $schema = [
            '@type'            => 'BlogPosting',
            'headline'         => $article->titre,
            'url'              => $url,
            'datePublished'    => $article->published_at?->toIso8601String(),
            'dateModified'     => $article->updated_at?->toIso8601String(),
            'inLanguage'       => $locale,
            'author'           => [
                '@type' => 'Organization',
                'name'  => 'NIMA Real Estate',
                'url'   => config('app.url'),
            ],
            'publisher'        => [
                '@type' => 'Organization',
                'name'  => 'NIMA Real Estate',
                'logo'  => ['@type' => 'ImageObject', 'url' => config('nima.seo.og_image')],
            ],
            'mainEntityOfPage' => ['@type' => 'WebPage', '@id' => $url],
        ];

        if ($article->meta_description) {
            $schema['description'] = $article->meta_description;
        }

        if ($article->image_couverture) {
            $schema['image'] = asset($article->image_couverture);
        }

        return $schema;
    }

    /** Schéma RealEstateAgent pour une entité */
    public static function realEstateAgent(Entreprise $entreprise, string $locale): array
    {
        return [
            '@type'       => 'RealEstateAgent',
            '@id'         => route('locale.entite', ['locale' => $locale, 'slug' => $entreprise->slug]) . '#entity',
            'name'        => $entreprise->nom,
            'description' => mb_substr(strip_tags($entreprise->description ?? ''), 0, 300),
            'url'         => route('locale.entite', ['locale' => $locale, 'slug' => $entreprise->slug]),
            'parentOrganization' => ['@id' => config('app.url') . '/#organization'],
            'logo'        => config('nima.seo.og_image'),
            'address'     => [
                '@type'           => 'PostalAddress',
                'addressLocality' => 'Yaoundé',
                'addressCountry'  => 'CM',
            ],
        ];
    }
}
