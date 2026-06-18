<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;

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

        return view('entite', compact('entreprise', 'projets'));
    }
}
