<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    private const LOCALES_SUPPORTEES = ['fr', 'en'];

    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->route('locale');

        if (!in_array($locale, self::LOCALES_SUPPORTEES, strict: true)) {
            abort(404);
        }

        App::setLocale($locale);

        return $next($request);
    }
}
