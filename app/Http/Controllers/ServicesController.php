<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use Illuminate\View\View;

class ServicesController extends Controller
{
    public function index(): View
    {
        $entreprises = Entreprise::where('actif', true)
            ->orderBy('ordre')
            ->get();

        return view('services', compact('entreprises'));
    }

    public function processus(): View
    {
        return view('processus');
    }
}
