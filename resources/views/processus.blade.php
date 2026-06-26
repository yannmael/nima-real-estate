@extends('layouts.app')

@php
    $locale = app()->getLocale();

    $etapes = [
        [
            'num'   => '01',
            'titre' => __('processus.etape_1_titre'),
            'desc'  => __('processus.etape_1_desc'),
            'duree' => __('processus.etape_1_duree'),
            'icone' => 'contact',
        ],
        [
            'num'   => '02',
            'titre' => __('processus.etape_2_titre'),
            'desc'  => __('processus.etape_2_desc'),
            'duree' => __('processus.etape_2_duree'),
            'icone' => 'study',
        ],
        [
            'num'   => '03',
            'titre' => __('processus.etape_3_titre'),
            'desc'  => __('processus.etape_3_desc'),
            'duree' => __('processus.etape_3_duree'),
            'icone' => 'plan',
        ],
        [
            'num'   => '04',
            'titre' => __('processus.etape_4_titre'),
            'desc'  => __('processus.etape_4_desc'),
            'duree' => __('processus.etape_4_duree'),
            'icone' => 'permit',
        ],
        [
            'num'   => '05',
            'titre' => __('processus.etape_5_titre'),
            'desc'  => __('processus.etape_5_desc'),
            'duree' => __('processus.etape_5_duree'),
            'icone' => 'site',
        ],
        [
            'num'   => '06',
            'titre' => __('processus.etape_6_titre'),
            'desc'  => __('processus.etape_6_desc'),
            'duree' => __('processus.etape_6_duree'),
            'icone' => 'delivery',
        ],
    ];

    $faq = [
        ['q' => __('processus.faq_1_q'), 'r' => __('processus.faq_1_a')],
        ['q' => __('processus.faq_2_q'), 'r' => __('processus.faq_2_a')],
        ['q' => __('processus.faq_3_q'), 'r' => __('processus.faq_3_a')],
        ['q' => __('processus.faq_4_q'), 'r' => __('processus.faq_4_a')],
    ];
@endphp

@section('meta_titre',       __('processus.meta_titre'))
@section('meta_description', __('processus.meta_description'))

@push('head')
@php
    $schemaProcessus = \App\Services\SeoService::graph(
        \App\Services\SeoService::localBusiness(),
        \App\Services\SeoService::breadcrumb([
            ['name' => __('app.nav_home'),     'url' => route('locale.home',      ['locale' => $locale])],
            ['name' => __('app.nav_services'), 'url' => route('locale.services',  ['locale' => $locale])],
            ['name' => __('processus.titre'),  'url' => route('locale.processus', ['locale' => $locale])],
        ]),
    );
@endphp
<x-seo.json-ld :data="$schemaProcessus" />
@endpush

@section('content')


{{-- ============================================================
     HERO
     ============================================================ --}}
<section class="hero-pattern py-16 lg:py-24" aria-labelledby="processus-page-heading">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Breadcrumb --}}
        <nav aria-label="Fil d'Ariane" class="mb-8">
            <ol class="flex flex-wrap items-center gap-2 text-xs text-white/60">
                <li>
                    <a href="{{ route('locale.home', ['locale' => $locale]) }}"
                       class="hover:text-white transition-colors">
                        {{ __('app.nav_home') }}
                    </a>
                </li>
                <li aria-hidden="true" class="text-white/30">/</li>
                <li>
                    <a href="{{ route('locale.services', ['locale' => $locale]) }}"
                       class="hover:text-white transition-colors">
                        {{ __('app.nav_services') }}
                    </a>
                </li>
                <li aria-hidden="true" class="text-white/30">/</li>
                <li class="text-white/80" aria-current="page">
                    {{ __('processus.titre') }}
                </li>
            </ol>
        </nav>

        <x-ui.section-heading
            id="processus-page-heading"
            tag="h1"
            :badge="__('processus.badge')"
            :sub="__('processus.sous_titre')"
            light>
            {{ __('processus.titre') }}
        </x-ui.section-heading>

    </div>
</section>
{{-- /hero --}}


{{-- ============================================================
     INTRODUCTION — texte + image
     ============================================================ --}}
<section class="py-16 lg:py-24 bg-white" aria-labelledby="processus-intro-heading">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">

            {{-- Image --}}
            <div>
                <x-ui.placeholder-img
                    :label="__('processus.intro_img_alt')"
                    dimensions="1200×800 px"
                    ratio="3/2"
                    rounded="2xl"
                    class="w-full shadow-xl" />
            </div>

            {{-- Texte --}}
            <div>
                <div class="w-10 h-0.5 rounded-full bg-gold mb-6" aria-hidden="true"></div>

                <x-ui.section-heading
                    id="processus-intro-heading"
                    :badge="__('processus.intro_badge')">
                    {{ __('processus.intro_titre') }}
                </x-ui.section-heading>

                <p class="mt-6 text-gray-600 leading-relaxed font-mono text-sm">
                    {{ __('processus.intro_texte') }}
                </p>

                <div class="mt-8">
                    <x-ui.btn
                        :href="route('locale.contact', ['locale' => $locale])"
                        type="primary"
                        size="md">
                        {{ __('app.nav_contact') }}
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </x-ui.btn>
                </div>
            </div>

        </div>
    </div>
</section>
{{-- /introduction --}}


{{-- ============================================================
     TIMELINE DES 6 ÉTAPES
     ============================================================ --}}
<section class="bg-gray-50 py-16 lg:py-24" aria-labelledby="etapes-heading">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-14 text-center">
            <x-ui.section-heading
                id="etapes-heading"
                :badge="__('processus.etapes_badge')"
                :sub="__('processus.etapes_sous_titre')"
                center>
                {{ __('processus.etapes_titre') }}
            </x-ui.section-heading>
        </div>

        {{-- ---- MOBILE : liste verticale ---- --}}
        <ol class="lg:hidden relative space-y-0" aria-label="{{ __('processus.etapes_badge') }}">

            {{-- Ligne verticale --}}
            <div class="absolute top-5 bottom-5 left-5 w-px bg-gray-200" aria-hidden="true"></div>

            @foreach($etapes as $etape)
            <li class="relative flex gap-6 pb-10 last:pb-0">

                {{-- Cercle numéro --}}
                <div class="w-10 h-10 rounded-full bg-primary text-white text-xs font-bold
                            flex items-center justify-center flex-shrink-0 z-10 shadow-sm">
                    {{ $etape['num'] }}
                </div>

                {{-- Contenu --}}
                <div class="pt-1.5 min-w-0">
                    <h3 class="text-primary font-bold text-base leading-snug mb-2">
                        {{ $etape['titre'] }}
                    </h3>
                    <p class="text-sm text-gray-500 leading-relaxed font-mono mb-3">
                        {{ $etape['desc'] }}
                    </p>
                    <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-gold-dark">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ __('processus.duree_label') }} : {{ $etape['duree'] }}
                    </span>
                </div>

            </li>
            @endforeach

        </ol>

        {{-- ---- DESKTOP : grille horizontale ---- --}}
        <div class="hidden lg:block">

            {{-- Ligne connectrice --}}
            <div class="relative mb-8">
                <div class="absolute top-1/2 left-16 right-16 h-px bg-gray-300 -translate-y-1/2"
                     aria-hidden="true"></div>

                <ol class="grid grid-cols-6 gap-4" aria-label="{{ __('processus.etapes_badge') }}">
                    @foreach($etapes as $etape)
                    <li class="flex flex-col items-center text-center">
                        {{-- Cercle --}}
                        <div class="relative w-10 h-10 rounded-full bg-primary text-white text-xs
                                    font-bold flex items-center justify-center z-10 shadow-md mb-0">
                            {{ $etape['num'] }}
                        </div>
                    </li>
                    @endforeach
                </ol>
            </div>

            {{-- Cartes détaillées sous les cercles --}}
            <div class="grid grid-cols-6 gap-4">
                @foreach($etapes as $loop_i => $etape)
                <article class="bg-white rounded-2xl border border-gray-100 p-5
                                shadow-sm hover:shadow-md hover:-translate-y-0.5
                                transition-all duration-200">

                    {{-- Numéro décoratif --}}
                    <span class="block text-4xl font-black tabular-nums text-primary/10 leading-none mb-3">
                        {{ $etape['num'] }}
                    </span>

                    <h3 class="text-primary font-bold text-sm leading-snug mb-2">
                        {{ $etape['titre'] }}
                    </h3>

                    <p class="text-xs text-gray-500 leading-relaxed font-mono mb-4">
                        {{ $etape['desc'] }}
                    </p>

                    <div class="flex items-center gap-1.5 text-[10px] font-semibold text-gold-dark">
                        <svg class="w-3 h-3 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $etape['duree'] }}
                    </div>

                </article>
                @endforeach
            </div>

        </div>

    </div>
</section>
{{-- /timeline --}}


{{-- ============================================================
     FAQ — accordéon Alpine.js
     ============================================================ --}}
<section class="bg-white py-16 lg:py-24" aria-labelledby="faq-heading">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 lg:gap-16">

            {{-- Titre colonne gauche --}}
            <div class="lg:sticky lg:top-28 lg:self-start">
                <x-ui.section-heading
                    id="faq-heading"
                    :badge="__('processus.faq_badge')"
                    :sub="__('processus.faq_sous_titre')">
                    {{ __('processus.faq_titre') }}
                </x-ui.section-heading>

                <div class="mt-8">
                    <x-ui.btn
                        :href="route('locale.contact', ['locale' => $locale])"
                        type="outline"
                        size="md">
                        {{ __('app.cta_contact') }}
                    </x-ui.btn>
                </div>
            </div>

            {{-- Accordéon --}}
            <div class="lg:col-span-2"
                 x-data="{ ouvert: 0 }"
                 role="list">

                @foreach($faq as $i => $item)
                <div class="border-b border-gray-100 last:border-0" role="listitem">

                    <button
                        type="button"
                        @click="ouvert = ouvert === {{ $i }} ? null : {{ $i }}"
                        :aria-expanded="(ouvert === {{ $i }}).toString()"
                        aria-controls="faq-answer-{{ $i }}"
                        class="flex w-full items-start justify-between gap-4
                               py-5 text-left focus:outline-none
                               focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 rounded"
                    >
                        <span class="font-semibold text-primary text-sm sm:text-base leading-snug font-mono">
                            {{ $item['q'] }}
                        </span>
                        <svg class="w-5 h-5 text-gold flex-shrink-0 transition-transform duration-200 mt-0.5"
                             :class="{ 'rotate-45': ouvert === {{ $i }} }"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                             aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                    </button>

                    <div
                        id="faq-answer-{{ $i }}"
                        x-show="ouvert === {{ $i }}"
                        x-collapse
                        x-cloak
                    >
                        <p class="pb-5 text-sm text-gray-500 leading-relaxed font-mono">
                            {{ $item['r'] }}
                        </p>
                    </div>

                </div>
                @endforeach

            </div>
        </div>

    </div>
</section>
{{-- /faq --}}


{{-- ============================================================
     CTA FINAL
     ============================================================ --}}
<x-home.cta-band
    :badge="__('processus.cta_badge')"
    :titre="__('processus.cta_titre')"
    :sous-titre="__('processus.cta_sous_titre')"
    :btn-label="__('processus.cta_btn')"
    :btn-href="route('locale.contact', ['locale' => $locale])"
    :btn-alt="__('processus.cta_btn_alt')"
    :btn-alt-href="route('locale.portfolio', ['locale' => $locale])" />

@endsection
