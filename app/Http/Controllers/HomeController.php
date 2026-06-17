<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;

class HomeController extends Controller
{
    public function index()
    {
        $entreprises = Entreprise::where('actif', true)
            ->orderBy('ordre')
            ->get();

        return view('home', compact('entreprises'));
    }
}
