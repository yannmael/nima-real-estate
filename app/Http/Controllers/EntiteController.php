<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use App\Services\SeoService;

class EntiteController extends Controller
{
    public function show(string $locale, string $slug)
    {
        $entreprise = Entreprise::where('slug', $slug)
            ->where('actif', true)
            ->firstOrFail();

        $projets = $entreprise->projets()
            ->where('visible', true)
            ->orderBy('ordre')
            ->limit(6)
            ->get();

        $schemaOrg = SeoService::graph(
            SeoService::realEstateAgent($entreprise, $locale),
            SeoService::breadcrumb([
                ['name' => __('app.nav_home'),   'url' => route('locale.home',  ['locale' => $locale])],
                ['name' => $entreprise->nom,      'url' => route('locale.entite', ['locale' => $locale, 'slug' => $entreprise->slug])],
            ]),
        );

        return view('entite', compact('entreprise', 'projets', 'schemaOrg'));
    }
}
