<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // HSTS — force HTTPS pendant 1 an, activé uniquement en production
        if (app()->isProduction()) {
            $response->headers->set(
                'Strict-Transport-Security',
                'max-age=31536000; includeSubDomains; preload'
            );
        }

        // Anti-clickjacking : interdit toute intégration dans un <iframe> tiers
        $response->headers->set('X-Frame-Options', 'DENY');

        // Anti-MIME-sniffing : le navigateur respecte le Content-Type déclaré
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Fuite d'URL : envoie seulement l'origine en cross-site (pas le chemin complet)
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Désactive les APIs matérielles non utilisées sur ce site
        $response->headers->set(
            'Permissions-Policy',
            'camera=(), microphone=(), geolocation=(), payment=(), usb=()'
        );

        // Content Security Policy
        // Note : 'unsafe-inline' et 'unsafe-eval' sont requis par Alpine.js v3
        // (utilise new Function() pour évaluer les directives x-data, x-on…)
        // et par GTM (injection dynamique de scripts).
        // La valeur de sécurité réelle repose sur les directives restrictives :
        // img-src, connect-src, form-action, object-src, base-uri, frame-ancestors.
        $domains = implode(' ', [
            'https://www.googletagmanager.com',
            'https://www.google-analytics.com',
            'https://unpkg.com',
        ]);

        $analyticsDomains = implode(' ', [
            'https://www.google-analytics.com',
            'https://analytics.google.com',
            'https://stats.g.doubleclick.net',
            'https://www.googletagmanager.com',
            'https://region1.google-analytics.com',
        ]);

        $directives = [
            "default-src 'self'",
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' {$domains}",
            "style-src 'self' 'unsafe-inline'",
            "img-src 'self' data: blob: https://*.openstreetmap.org https://www.google-analytics.com https://www.googletagmanager.com",
            "connect-src 'self' {$analyticsDomains}",
            "font-src 'self'",
            "frame-ancestors 'none'",
            "object-src 'none'",
            "base-uri 'self'",
            "form-action 'self'",
        ];

        if (app()->isProduction()) {
            $directives[] = 'upgrade-insecure-requests';
        }

        $response->headers->set('Content-Security-Policy', implode('; ', $directives));

        return $response;
    }
}
