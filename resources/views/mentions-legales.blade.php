@extends('layouts.app')

@php $locale = app()->getLocale(); @endphp

@section('meta_titre',       __('legal.ml_meta_titre'))
@section('meta_description', __('legal.ml_meta_description'))
@section('canonical',        url()->current())
@section('meta_robots',      'noindex, follow')

@push('head')
@php
    $schemaMl = \App\Services\SeoService::graph(
        [
            '@type' => 'WebPage',
            'name'  => __('legal.ml_meta_titre'),
            'url'   => url()->current(),
        ],
        \App\Services\SeoService::breadcrumb([
            ['name' => __('app.nav_home'),        'url' => route('locale.home',           ['locale' => $locale])],
            ['name' => __('legal.ml_breadcrumb'), 'url' => route('locale.mentions-legales', ['locale' => $locale])],
        ]),
    );
@endphp
<x-seo.json-ld :data="$schemaMl" />
@endpush

@section('content')


{{-- ============================================================
     HERO
     ============================================================ --}}
<section class="hero-pattern py-14 lg:py-20" aria-labelledby="ml-heading">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

        <nav aria-label="{{ $locale === 'fr' ? 'Fil d\'Ariane' : 'Breadcrumb' }}" class="mb-8">
            <ol class="flex items-center gap-2 text-xs text-white/60">
                <li>
                    <a href="{{ route('locale.home', ['locale' => $locale]) }}"
                       class="hover:text-white transition-colors">
                        {{ __('app.nav_home') }}
                    </a>
                </li>
                <li aria-hidden="true" class="text-white/30">/</li>
                <li class="text-white/80" aria-current="page">{{ __('legal.ml_breadcrumb') }}</li>
            </ol>
        </nav>

        <x-ui.section-heading
            id="ml-heading"
            tag="h1"
            :badge="__('legal.ml_badge')"
            :sub="__('legal.ml_sous_titre')"
            light>
            {{ __('legal.ml_titre') }}
        </x-ui.section-heading>

        <p class="mt-4 text-xs text-white/40">{{ __('legal.ml_maj') }}</p>

    </div>
</section>
{{-- /hero --}}


{{-- ============================================================
     CONTENU
     ============================================================ --}}
<div class="bg-white py-14 lg:py-20">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="max-w-3xl mx-auto">


            {{-- ──────────────────────────────────────
                 1. ÉDITEUR
                 ────────────────────────────────────── --}}
            <section class="mb-10" aria-labelledby="ml-editeur">
                <h2 id="ml-editeur"
                    class="text-lg font-bold text-primary mb-4 pb-2 border-b border-gray-100">
                    {{ __('legal.ml_editeur_titre') }}
                </h2>
                <p class="text-sm text-gray-600 mb-4">{{ __('legal.ml_editeur_intro') }}</p>
                <dl class="text-sm space-y-2">
                    <div class="grid grid-cols-[140px_1fr] gap-2">
                        <dt class="font-semibold text-gray-700">{{ $locale === 'fr' ? 'Dénomination' : 'Company name' }}</dt>
                        <dd class="text-gray-600">{{ config('nima.legal.raison_sociale') }}</dd>
                    </div>
                    <div class="grid grid-cols-[140px_1fr] gap-2">
                        <dt class="font-semibold text-gray-700">{{ $locale === 'fr' ? 'Forme juridique' : 'Legal form' }}</dt>
                        <dd class="text-gray-600">{{ config('nima.legal.forme_juridique') }}</dd>
                    </div>
                    <div class="grid grid-cols-[140px_1fr] gap-2">
                        <dt class="font-semibold text-gray-700">{{ $locale === 'fr' ? 'Capital social' : 'Share capital' }}</dt>
                        <dd class="text-gray-600">{{ config('nima.legal.capital') }}</dd>
                    </div>
                    <div class="grid grid-cols-[140px_1fr] gap-2">
                        <dt class="font-semibold text-gray-700">RCCM</dt>
                        <dd class="text-gray-600">{{ config('nima.legal.rccm') }}</dd>
                    </div>
                    <div class="grid grid-cols-[140px_1fr] gap-2">
                        <dt class="font-semibold text-gray-700">{{ $locale === 'fr' ? 'Siège social' : 'Registered office' }}</dt>
                        <dd class="text-gray-600">{{ config('nima.legal.siege') }}</dd>
                    </div>
                    <div class="grid grid-cols-[140px_1fr] gap-2">
                        <dt class="font-semibold text-gray-700">{{ $locale === 'fr' ? 'Téléphone' : 'Phone' }}</dt>
                        <dd class="text-gray-600">
                            <a href="tel:{{ config('nima.contact.phone') }}"
                               class="text-primary hover:text-gold transition-colors">
                                {{ config('nima.contact.phone') }}
                            </a>
                        </dd>
                    </div>
                    <div class="grid grid-cols-[140px_1fr] gap-2">
                        <dt class="font-semibold text-gray-700">{{ $locale === 'fr' ? 'E-mail' : 'Email' }}</dt>
                        <dd class="text-gray-600">
                            <a href="mailto:{{ config('nima.contact.email') }}"
                               class="text-primary hover:text-gold transition-colors">
                                {{ config('nima.contact.email') }}
                            </a>
                        </dd>
                    </div>
                </dl>
            </section>

            {{-- ──────────────────────────────────────
                 2. DIRECTEUR DE PUBLICATION
                 ────────────────────────────────────── --}}
            <section class="mb-10" aria-labelledby="ml-directeur">
                <h2 id="ml-directeur"
                    class="text-lg font-bold text-primary mb-4 pb-2 border-b border-gray-100">
                    {{ __('legal.ml_directeur_titre') }}
                </h2>
                <dl class="text-sm space-y-2">
                    <div class="grid grid-cols-[140px_1fr] gap-2">
                        <dt class="font-semibold text-gray-700">{{ $locale === 'fr' ? 'Nom' : 'Name' }}</dt>
                        <dd class="text-gray-600">{{ config('nima.legal.dirigeant') }}</dd>
                    </div>
                    <div class="grid grid-cols-[140px_1fr] gap-2">
                        <dt class="font-semibold text-gray-700">{{ $locale === 'fr' ? 'Qualité' : 'Title' }}</dt>
                        <dd class="text-gray-600">{{ config('nima.legal.qualite_dirigeant') }}</dd>
                    </div>
                </dl>
            </section>

            {{-- ──────────────────────────────────────
                 3. HÉBERGEMENT
                 ────────────────────────────────────── --}}
            <section class="mb-10" aria-labelledby="ml-hebergeur">
                <h2 id="ml-hebergeur"
                    class="text-lg font-bold text-primary mb-4 pb-2 border-b border-gray-100">
                    {{ __('legal.ml_hebergeur_titre') }}
                </h2>
                <p class="text-sm text-gray-600 mb-3">{{ __('legal.ml_hebergeur_intro') }}</p>
                <dl class="text-sm space-y-2">
                    <div class="grid grid-cols-[140px_1fr] gap-2">
                        <dt class="font-semibold text-gray-700">{{ $locale === 'fr' ? 'Société' : 'Company' }}</dt>
                        <dd class="text-gray-600">{{ __('legal.ml_hebergeur_nom') }}</dd>
                    </div>
                    <div class="grid grid-cols-[140px_1fr] gap-2">
                        <dt class="font-semibold text-gray-700">{{ $locale === 'fr' ? 'Adresse' : 'Address' }}</dt>
                        <dd class="text-gray-600">{{ __('legal.ml_hebergeur_adresse') }}</dd>
                    </div>
                    <div class="grid grid-cols-[140px_1fr] gap-2">
                        <dt class="font-semibold text-gray-700">{{ $locale === 'fr' ? 'Site' : 'Website' }}</dt>
                        <dd class="text-gray-600">{{ __('legal.ml_hebergeur_site') }}</dd>
                    </div>
                </dl>

                <div class="mt-4 p-4 bg-gray-50 rounded-xl text-sm text-gray-600">
                    <p class="font-semibold text-gray-700 text-xs uppercase tracking-wider mb-1">
                        {{ __('legal.ml_cdn_titre') }}
                    </p>
                    <p>{{ __('legal.ml_cdn_texte') }}</p>
                </div>
            </section>

            {{-- ──────────────────────────────────────
                 4. PROPRIÉTÉ INTELLECTUELLE
                 ────────────────────────────────────── --}}
            <section class="mb-10" aria-labelledby="ml-pi">
                <h2 id="ml-pi"
                    class="text-lg font-bold text-primary mb-4 pb-2 border-b border-gray-100">
                    {{ __('legal.ml_pi_titre') }}
                </h2>
                <ul class="text-sm text-gray-600 space-y-2 list-none">
                    @foreach(__('legal.ml_pi_items') as $item)
                    <li class="flex items-start gap-2">
                        <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-gold flex-shrink-0" aria-hidden="true"></span>
                        <span>{{ $item }}</span>
                    </li>
                    @endforeach
                </ul>
            </section>

            {{-- ──────────────────────────────────────
                 5. LIENS HYPERTEXTES
                 ────────────────────────────────────── --}}
            <section class="mb-10" aria-labelledby="ml-liens">
                <h2 id="ml-liens"
                    class="text-lg font-bold text-primary mb-4 pb-2 border-b border-gray-100">
                    {{ __('legal.ml_liens_titre') }}
                </h2>
                <p class="text-sm text-gray-600">{{ __('legal.ml_liens_texte') }}</p>
            </section>

            {{-- ──────────────────────────────────────
                 6. LIMITATION DE RESPONSABILITÉ
                 ────────────────────────────────────── --}}
            <section class="mb-10" aria-labelledby="ml-resp">
                <h2 id="ml-resp"
                    class="text-lg font-bold text-primary mb-4 pb-2 border-b border-gray-100">
                    {{ __('legal.ml_resp_titre') }}
                </h2>
                <ul class="text-sm text-gray-600 space-y-2 list-none">
                    @foreach(__('legal.ml_resp_items') as $item)
                    <li class="flex items-start gap-2">
                        <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary/40 flex-shrink-0" aria-hidden="true"></span>
                        <span>{{ $item }}</span>
                    </li>
                    @endforeach
                </ul>
            </section>

            {{-- ──────────────────────────────────────
                 7. DONNÉES PERSONNELLES & COOKIES
                 ────────────────────────────────────── --}}
            <section class="mb-10" aria-labelledby="ml-donnees">
                <h2 id="ml-donnees"
                    class="text-lg font-bold text-primary mb-4 pb-2 border-b border-gray-100">
                    {{ __('legal.ml_donnees_titre') }}
                </h2>
                <p class="text-sm text-gray-600 mb-4">{{ __('legal.ml_donnees_texte') }}</p>

                <p class="text-sm text-gray-600 mb-3">{{ __('legal.ml_cookies_titre') }}</p>
                <p class="text-sm text-gray-600">{{ __('legal.ml_cookies_texte') }}</p>

                <div class="mt-4">
                    <a href="{{ route('locale.confidentialite', ['locale' => $locale]) }}"
                       class="inline-flex items-center gap-2 text-sm font-semibold text-primary
                              hover:text-gold transition-colors duration-150">
                        {{ __('legal.pc_breadcrumb') }}
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </section>

            {{-- ──────────────────────────────────────
                 8. DROIT APPLICABLE
                 ────────────────────────────────────── --}}
            <section class="mb-10" aria-labelledby="ml-droit">
                <h2 id="ml-droit"
                    class="text-lg font-bold text-primary mb-4 pb-2 border-b border-gray-100">
                    {{ __('legal.ml_droit_titre') }}
                </h2>
                <p class="text-sm text-gray-600">{{ __('legal.ml_droit_texte') }}</p>
            </section>

            {{-- ──────────────────────────────────────
                 9. CONFORMITÉ ANTIC
                 ────────────────────────────────────── --}}
            <section aria-labelledby="ml-antic">
                <h2 id="ml-antic"
                    class="text-lg font-bold text-primary mb-4 pb-2 border-b border-gray-100">
                    {{ __('legal.ml_antic_titre') }}
                </h2>
                <p class="text-sm text-gray-600">{{ __('legal.ml_antic_texte') }}</p>
            </section>

        </div>{{-- /max-w-3xl --}}
    </div>
</div>
{{-- /contenu --}}


@endsection
