<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use App\Models\TauxChange;
use App\Services\SeoService;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function index(): View
    {
        return view('portfolio');
    }

    public function show(string $locale, string $slug): View
    {
        $projet = Projet::where('slug', $slug)
            ->where('visible', true)
            ->with(['entreprise', 'temoignage'])
            ->firstOrFail();

        // Taux en base (XAF = pivot) : { "EUR": 655.957, "USD": 615.0 }
        $tauxXAF = TauxChange::pluck('taux_xaf', 'devise')
            ->map(fn ($t) => (float) $t)
            ->all();

        $schemaOrg = SeoService::graph(
            SeoService::project($projet, $locale),
            SeoService::breadcrumb([
                ['name' => __('app.nav_home'),      'url' => route('locale.home',      ['locale' => $locale])],
                ['name' => __('app.nav_portfolio'),  'url' => route('locale.portfolio', ['locale' => $locale])],
                ['name' => $projet->titre,            'url' => route('locale.projet',   ['locale' => $locale, 'slug' => $projet->slug])],
            ]),
        );

        return view('projet', compact('projet', 'tauxXAF', 'schemaOrg'));
    }
}
