<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Lead;
use App\Models\Projet;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'projets'  => Projet::count(),
            'articles' => Article::count(),
            'leads'    => Lead::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
