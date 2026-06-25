<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class LegalController extends Controller
{
    public function mentionsLegales(): View
    {
        return view('mentions-legales');
    }

    public function confidentialite(): View
    {
        return view('confidentialite');
    }
}
