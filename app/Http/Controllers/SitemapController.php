<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Entreprise;
use App\Models\Projet;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $locales = ['fr', 'en'];
        $urls    = [];

        $staticPages = [
            'locale.home'             => ['priority' => '1.0', 'changefreq' => 'weekly'],
            'locale.portfolio'        => ['priority' => '0.9', 'changefreq' => 'weekly'],
            'locale.services'         => ['priority' => '0.8', 'changefreq' => 'monthly'],
            'locale.processus'        => ['priority' => '0.7', 'changefreq' => 'monthly'],
            'locale.contact'          => ['priority' => '0.8', 'changefreq' => 'monthly'],
            'locale.investir'         => ['priority' => '0.7', 'changefreq' => 'monthly'],
            'locale.blog'             => ['priority' => '0.8', 'changefreq' => 'weekly'],
            'locale.mentions-legales' => ['priority' => '0.3', 'changefreq' => 'yearly'],
            'locale.confidentialite'  => ['priority' => '0.3', 'changefreq' => 'yearly'],
        ];

        foreach ($staticPages as $routeName => $meta) {
            $alternates = [];
            foreach ($locales as $locale) {
                $alternates[$locale] = route($routeName, ['locale' => $locale]);
            }
            $urls[] = array_merge($meta, [
                'loc'        => $alternates['fr'],
                'lastmod'    => now()->toDateString(),
                'alternates' => $alternates,
            ]);
        }

        foreach (Entreprise::where('actif', true)->get() as $entreprise) {
            $alternates = [];
            foreach ($locales as $locale) {
                $alternates[$locale] = route('locale.entite', ['locale' => $locale, 'slug' => $entreprise->slug]);
            }
            $urls[] = [
                'loc'        => $alternates['fr'],
                'lastmod'    => $entreprise->updated_at->toDateString(),
                'priority'   => '0.8',
                'changefreq' => 'monthly',
                'alternates' => $alternates,
            ];
        }

        foreach (Projet::where('visible', true)->get() as $projet) {
            $alternates = [];
            foreach ($locales as $locale) {
                $alternates[$locale] = route('locale.projet', ['locale' => $locale, 'slug' => $projet->slug]);
            }
            $urls[] = [
                'loc'        => $alternates['fr'],
                'lastmod'    => $projet->updated_at->toDateString(),
                'priority'   => '0.7',
                'changefreq' => 'monthly',
                'alternates' => $alternates,
            ];
        }

        foreach (Article::publie()->get() as $article) {
            if (!$article->slug_fr) {
                continue;
            }
            $frUrl = route('locale.article', ['locale' => 'fr', 'slug' => $article->slug_fr]);
            $enUrl = $article->slug_en
                ? route('locale.article', ['locale' => 'en', 'slug' => $article->slug_en])
                : $frUrl;

            $urls[] = [
                'loc'        => $frUrl,
                'lastmod'    => ($article->updated_at ?? $article->published_at)->toDateString(),
                'priority'   => '0.6',
                'changefreq' => 'monthly',
                'alternates' => ['fr' => $frUrl, 'en' => $enUrl],
            ];
        }

        return response()
            ->view('sitemap', compact('urls'))
            ->header('Content-Type', 'text/xml; charset=utf-8');
    }
}
