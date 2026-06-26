<?php

use App\Http\Controllers\Admin\AuthController as AdminAuth;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\TwoFactorController as Admin2FA;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EntiteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvestirController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\SitemapController;
use App\Http\Middleware\EnsureAdmin2FA;
use App\Http\Middleware\EnsureIsAdmin;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Administration — login + 2FA + tableau de bord
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {

    // Connexion (sans authentification)
    Route::get('/login',  [AdminAuth::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuth::class, 'login']);
    Route::post('/logout', [AdminAuth::class, 'logout'])->name('logout');

    // 2FA — accessible après authentification simple
    Route::middleware(EnsureIsAdmin::class)->group(function () {
        Route::get('/2fa/setup',    [Admin2FA::class, 'showSetup'])->name('2fa.setup');
        Route::post('/2fa/setup',   [Admin2FA::class, 'confirmSetup'])->name('2fa.confirm');
        Route::get('/2fa/challenge',  [Admin2FA::class, 'showChallenge'])->name('2fa.challenge');
        Route::post('/2fa/challenge', [Admin2FA::class, 'challenge'])->name('2fa.challenge.verify');
    });

    // Tableau de bord — nécessite auth + 2FA validé
    Route::middleware([EnsureIsAdmin::class, EnsureAdmin2FA::class])->group(function () {
        Route::get('/', [AdminDashboard::class, 'index'])->name('dashboard');
    });
});

/*
|--------------------------------------------------------------------------
| SEO — Sitemap & Robots
|--------------------------------------------------------------------------
*/
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

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
        Route::get('/contact', [ContactController::class, 'index'])->name('contact');
        Route::get('/newsletter/confirmer/{token}', [ContactController::class, 'confirmerNewsletter'])
            ->where('token', '[A-Za-z0-9]{64}')
            ->name('newsletter.confirmer');

        // Étape 9 — Investir au Cameroun
        Route::get('/investir', [InvestirController::class, 'index'])->name('investir');

        // Étape 10 — Blog
        Route::get('/blog', [BlogController::class, 'index'])->name('blog');
        Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('article');

        // Étape 11 — Légal / RGPD
        Route::get('/mentions-legales', [LegalController::class, 'mentionsLegales'])->name('mentions-legales');
        Route::get('/politique-de-confidentialite', [LegalController::class, 'confidentialite'])->name('confidentialite');

    });
