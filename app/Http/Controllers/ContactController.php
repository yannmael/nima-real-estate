<?php

namespace App\Http\Controllers;

use App\Services\NewsletterService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('contact', [
            'mapLat'  => config('nima.map.lat'),
            'mapLng'  => config('nima.map.lng'),
            'mapZoom' => config('nima.map.zoom'),
        ]);
    }

    /**
     * Le paramètre $locale doit être déclaré en premier car il vient du préfixe de groupe
     * de routes /{locale}/... et Laravel le lie positionellement avant le service container.
     */
    public function confirmerNewsletter(string $locale, string $token, NewsletterService $service): RedirectResponse
    {
        $subscriber = $service->confirmer($token);

        if ($subscriber === null) {
            return redirect()
                ->route('locale.contact', ['locale' => $locale])
                ->with('newsletter_erreur', true);
        }

        return redirect()
            ->route('locale.contact', ['locale' => $locale])
            ->with('newsletter_confirme', true);
    }
}
