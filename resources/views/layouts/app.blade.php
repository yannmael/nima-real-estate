<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="@yield('meta_robots', 'index, follow')">

    {{-- Titre : chaque page fournit @section('meta_titre') ou on utilise le défaut --}}
    <title>@yield('meta_titre', __('app.meta_titre_defaut'))</title>

    {{-- Meta description --}}
    <meta name="description" content="@yield('meta_description', __('app.meta_description_defaut'))">

    {{-- Canonical — évite le duplicate content FR/EN --}}
    <link rel="canonical" href="@yield('canonical', url()->current())">

    {{-- Alternate hreflang FR ↔ EN --}}
    @php
        $locale    = app()->getLocale();
        $altLocale = $locale === 'fr' ? 'en' : 'fr';
        $altUrl    = preg_replace('#^/(fr|en)#', '/' . $altLocale, request()->getRequestUri());
    @endphp
    <link rel="alternate" hreflang="{{ $locale }}"    href="{{ url()->current() }}">
    <link rel="alternate" hreflang="{{ $altLocale }}" href="{{ url($altUrl) }}">
    <link rel="alternate" hreflang="x-default"       href="{{ url('/fr') }}">

    {{-- Open Graph --}}
    <meta property="og:type"        content="@yield('og_type', 'website')">
    <meta property="og:title"       content="@yield('meta_titre', __('app.meta_titre_defaut'))">
    <meta property="og:description" content="@yield('meta_description', __('app.meta_description_defaut'))">
    <meta property="og:url"         content="{{ url()->current() }}">
    <meta property="og:image"       content="@yield('og_image', config('nima.seo.og_image'))">
    <meta property="og:locale"      content="{{ $locale === 'fr' ? 'fr_FR' : 'en_US' }}">
    <meta property="og:site_name"   content="{{ __('app.site_name') }}">

    {{-- Twitter Card --}}
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="@yield('meta_titre', __('app.meta_titre_defaut'))">
    <meta name="twitter:description" content="@yield('meta_description', __('app.meta_description_defaut'))">
    <meta name="twitter:image"       content="@yield('og_image', config('nima.seo.og_image'))">

    {{-- Favicon (placeholder — remplacer par les fichiers réels du client) --}}
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">

    {{-- Google Analytics 4 + Consent Mode v2 --}}
    @if(config('nima.ga4.measurement_id'))
        @include('partials.ga4')
    @endif

    {{-- Assets Vite (Tailwind + JS) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Livewire styles --}}
    @livewireStyles

    {{-- Slot pour ressources supplémentaires par page (fonts, preload, schema.org…) --}}
    @stack('head')
</head>
<body class="bg-white text-gray-900 antialiased flex flex-col min-h-screen">

    {{-- Lien d'évitement — accessibilité clavier (WCAG 2.4.1) --}}
    <a href="#main-content"
       class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-[100]
              focus:px-4 focus:py-2 focus:bg-primary focus:text-white focus:rounded-lg
              focus:text-sm focus:font-semibold">
        {{ __('app.skip_to_content') }}
    </a>

    {{-- Header --}}
    <x-layout.header />

    {{-- Contenu principal --}}
    <main id="main-content" class="flex-1">
        @yield('content')
    </main>

    {{-- Footer --}}
    <x-layout.footer />

    {{-- Bouton WhatsApp flottant --}}
    <x-layout.whatsapp-button />

    {{-- Bandeau cookies (placeholder étape 11) --}}
    <x-layout.cookie-banner />

    {{-- Livewire scripts (inclut Alpine.js v3) --}}
    @livewireScripts

    {{-- Slot JS supplémentaires par page --}}
    @stack('scripts')

</body>
</html>
