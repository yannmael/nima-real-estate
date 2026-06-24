<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use App\Models\TauxChange;
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

        return view('projet', compact('projet', 'tauxXAF'));
    }
}
