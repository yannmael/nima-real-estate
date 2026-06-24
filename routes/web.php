<?php

use App\Http\Controllers\EntiteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ServicesController;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Redirection racine → locale préférée du navigateur (FR par défaut)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    $preferred = request()->getPreferredLanguage(['fr', 'en']) ?? 'fr';
    $locale    = in_array($preferred, ['fr', 'en'], strict: true) ? $preferred : 'fr';

    return redirect("/{$locale}", 302);
});

/*
|--------------------------------------------------------------------------
| Routes localisées  /fr/...  et  /en/...
|--------------------------------------------------------------------------
*/
Route::prefix('{locale}')
    ->where(['locale' => 'fr|en'])
    ->middleware(SetLocale::class)
    ->name('locale.')
    ->group(function () {

        // Accueil
        Route::get('/', [HomeController::class, 'index'])->name('home');

        // Pages à implémenter aux étapes suivantes (retournent 404 pour l'instant)
        // Étape 5 — Entités
        Route::get('/entites/{slug}', [EntiteController::class, 'show'])->name('entite');

        // Étape 6 — Portfolio
        Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio');
        Route::get('/portfolio/{slug}', [PortfolioController::class, 'show'])->name('projet');

        // Étape 7 — Services & Processus
        Route::get('/services',   [ServicesController::class, 'index'])->name('services');
        Route::get('/processus',  [ServicesController::class, 'processus'])->name('processus');

        // Étape 8 — Contact
        Route::get('/contact', fn () => abort(404))->name('contact');

        // Étape 9 — Investir
        Route::get('/investir', fn () => abort(404))->name('investir');

        // Étape 10 — Blog
        Route::get('/blog', fn () => abort(404))->name('blog');
        Route::get('/blog/{slug}', fn () => abort(404))->name('article');

        // Étape 11 — Légal / RGPD
        Route::get('/mentions-legales', fn () => abort(404))->name('mentions-legales');
        Route::get('/politique-de-confidentialite', fn () => abort(404))->name('confidentialite');

    });
