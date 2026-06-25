<?php

namespace App\Http\Controllers;

use App\Models\FaqInvestisseur;
use App\Models\IndicateurMarche;
use Illuminate\View\View;

class InvestirController extends Controller
{
    public function index(): View
    {
        return view('investir', [
            'indicateursMarche'     => IndicateurMarche::deCategorie('marche'),
            'indicateursRendements' => IndicateurMarche::deCategorie('rendements'),
            'indicateursJuridique'  => IndicateurMarche::deCategorie('juridique'),
            'faqs'                  => FaqInvestisseur::publiees(),
        ]);
    }
}
