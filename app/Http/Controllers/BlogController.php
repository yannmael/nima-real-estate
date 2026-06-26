<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Services\SeoService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        return view('blog');
    }

    /**
     * $locale doit être déclaré en premier car il vient du préfixe de groupe /{locale}/…
     * Laravel le lie positionellement avant le service container.
     */
    public function show(string $locale, string $slug): View|RedirectResponse
    {
        $colSlug = $locale === 'en' ? 'slug_en' : 'slug_fr';

        $article = Article::publie()
            ->where($colSlug, $slug)
            ->firstOrFail();

        $articlesLies = Article::publie()
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->limit(3)
            ->get();

        $schemaOrg = SeoService::graph(
            SeoService::blogPosting($article, $locale),
            SeoService::breadcrumb([
                ['name' => __('app.nav_home'), 'url' => route('locale.home', ['locale' => $locale])],
                ['name' => __('blog.breadcrumb'), 'url' => route('locale.blog', ['locale' => $locale])],
                ['name' => $article->titre,       'url' => url()->current()],
            ]),
        );

        return view('article', compact('article', 'articlesLies', 'schemaOrg'));
    }
}
