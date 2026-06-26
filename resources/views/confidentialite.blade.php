@extends('layouts.app')

@php $locale = app()->getLocale(); @endphp

@section('meta_titre',       __('legal.pc_meta_titre'))
@section('meta_description', __('legal.pc_meta_description'))
@section('canonical',        url()->current())
@section('meta_robots',      'noindex, follow')

@push('head')
@php
    $schemaPc = \App\Services\SeoService::graph(
        [
            '@type' => 'WebPage',
            'name'  => __('legal.pc_meta_titre'),
            'url'   => url()->current(),
        ],
        \App\Services\SeoService::breadcrumb([
            ['name' => __('app.nav_home'),        'url' => route('locale.home',            ['locale' => $locale])],
            ['name' => __('legal.pc_breadcrumb'), 'url' => route('locale.confidentialite', ['locale' => $locale])],
        ]),
    );
@endphp
<x-seo.json-ld :data="$schemaPc" />
@endpush

@section('content')


{{-- ============================================================
     HERO
     ============================================================ --}}
<section class="hero-pattern py-14 lg:py-20" aria-labelledby="pc-heading">
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
                <li class="text-white/80" aria-current="page">{{ __('legal.pc_breadcrumb') }}</li>
            </ol>
        </nav>

        <x-ui.section-heading
            id="pc-heading"
            tag="h1"
            :badge="__('legal.pc_badge')"
            :sub="__('legal.pc_sous_titre')"
            light>
            {{ __('legal.pc_titre') }}
        </x-ui.section-heading>

        <p class="mt-4 text-xs text-white/40">{{ __('legal.pc_maj') }}</p>

    </div>
</section>
{{-- /hero --}}


{{-- ============================================================
     CONTENU
     ============================================================ --}}
<div class="bg-white py-14 lg:py-20">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-[260px_1fr] gap-12 lg:gap-16 items-start">

            {{-- ---- Table des matières (sidebar sticky) ---- --}}
            <nav aria-label="{{ __('legal.pc_toc_titre') }}"
                 class="hidden lg:block sticky top-24 space-y-1.5">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">
                    {{ __('legal.pc_toc_titre') }}
                </p>
                @foreach([
                    'pc-s1' => __('legal.pc_s1_titre'),
                    'pc-s2' => __('legal.pc_s2_titre'),
                    'pc-s3' => __('legal.pc_s3_titre'),
                    'pc-s4' => __('legal.pc_s4_titre'),
                    'pc-s5' => __('legal.pc_s5_titre'),
                    'pc-s6' => __('legal.pc_s6_titre'),
                    'pc-s7' => __('legal.pc_s7_titre'),
                    'pc-s8' => __('legal.pc_s8_titre'),
                    'pc-s9' => __('legal.pc_s9_titre'),
                ] as $anchor => $label)
                <a href="#{{ $anchor }}"
                   class="block text-xs text-gray-500 hover:text-primary transition-colors
                          py-0.5 border-l-2 border-transparent hover:border-gold pl-3
                          focus-visible:ring-2 focus-visible:ring-gold focus-visible:ring-offset-1 rounded-r">
                    {{ $label }}
                </a>
                @endforeach
            </nav>

            {{-- ---- Corps de la politique ---- --}}
            <div class="max-w-2xl space-y-12">

                <p class="text-sm text-gray-600 leading-relaxed">{{ __('legal.pc_intro') }}</p>

                {{-- ──────────────────────────────────────
                     S1 — Responsable de traitement
                     ────────────────────────────────────── --}}
                <section aria-labelledby="pc-s1">
                    <h2 id="pc-s1" class="text-lg font-bold text-primary mb-4 pb-2 border-b border-gray-100">
                        1. {{ __('legal.pc_s1_titre') }}
                    </h2>
                    <p class="text-sm text-gray-600 mb-3">{{ __('legal.pc_s1_texte') }}</p>
                    <dl class="text-sm space-y-2">
                        <div class="grid grid-cols-[130px_1fr] gap-2">
                            <dt class="font-semibold text-gray-700">{{ $locale === 'fr' ? 'Société' : 'Company' }}</dt>
                            <dd class="text-gray-600">{{ config('nima.legal.raison_sociale') }}</dd>
                        </div>
                        <div class="grid grid-cols-[130px_1fr] gap-2">
                            <dt class="font-semibold text-gray-700">{{ $locale === 'fr' ? 'Adresse' : 'Address' }}</dt>
                            <dd class="text-gray-600">{{ config('nima.legal.siege') }}</dd>
                        </div>
                        <div class="grid grid-cols-[130px_1fr] gap-2">
                            <dt class="font-semibold text-gray-700">{{ $locale === 'fr' ? 'Contact RGPD' : 'GDPR contact' }}</dt>
                            <dd class="text-gray-600">
                                <a href="mailto:{{ config('nima.legal.email_rgpd') }}"
                                   class="text-primary hover:text-gold transition-colors">
                                    {{ config('nima.legal.email_rgpd') }}
                                </a>
                            </dd>
                        </div>
                    </dl>
                    <p class="mt-3 text-xs text-gray-500 italic">{{ __('legal.pc_s1_dpo') }}</p>
                </section>

                {{-- ──────────────────────────────────────
                     S2 — Données collectées
                     ────────────────────────────────────── --}}
                <section aria-labelledby="pc-s2">
                    <h2 id="pc-s2" class="text-lg font-bold text-primary mb-4 pb-2 border-b border-gray-100">
                        2. {{ __('legal.pc_s2_titre') }}
                    </h2>
                    <p class="text-sm text-gray-600 mb-5">{{ __('legal.pc_s2_intro') }}</p>
                    <div class="overflow-x-auto rounded-xl border border-gray-200">
                        <table class="min-w-full text-xs" aria-label="{{ __('legal.pc_s2_titre') }}">
                            <thead class="bg-primary text-white">
                                <tr>
                                    @foreach(__('legal.pc_s2_tableau_head') as $h)
                                    <th scope="col" class="px-4 py-3 text-left font-semibold whitespace-nowrap">
                                        {{ $h }}
                                    </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach(__('legal.pc_s2_lignes') as $ligne)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    @foreach($ligne as $cellule)
                                    <td class="px-4 py-3 text-gray-600 leading-relaxed align-top">{{ $cellule }}</td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>

                {{-- ──────────────────────────────────────
                     S3 — Sous-traitants
                     ────────────────────────────────────── --}}
                <section aria-labelledby="pc-s3">
                    <h2 id="pc-s3" class="text-lg font-bold text-primary mb-4 pb-2 border-b border-gray-100">
                        3. {{ __('legal.pc_s3_titre') }}
                    </h2>
                    <p class="text-sm text-gray-600 mb-5">{{ __('legal.pc_s3_intro') }}</p>
                    <div class="overflow-x-auto rounded-xl border border-gray-200">
                        <table class="min-w-full text-xs" aria-label="{{ __('legal.pc_s3_titre') }}">
                            <thead class="bg-gray-50 text-gray-700 border-b border-gray-200">
                                <tr>
                                    @foreach(__('legal.pc_s3_tableau_head') as $h)
                                    <th scope="col" class="px-4 py-3 text-left font-semibold">{{ $h }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach(__('legal.pc_s3_lignes') as $ligne)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    @foreach($ligne as $cellule)
                                    <td class="px-4 py-3 text-gray-600 align-top">{{ $cellule }}</td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <p class="mt-3 text-xs text-gray-500 italic">{{ __('legal.pc_s3_note') }}</p>
                </section>

                {{-- ──────────────────────────────────────
                     S4 — Droits des personnes
                     ────────────────────────────────────── --}}
                <section aria-labelledby="pc-s4">
                    <h2 id="pc-s4" class="text-lg font-bold text-primary mb-4 pb-2 border-b border-gray-100">
                        4. {{ __('legal.pc_s4_titre') }}
                    </h2>
                    <p class="text-sm text-gray-600 mb-5">{{ __('legal.pc_s4_intro') }}</p>
                    <dl class="space-y-3">
                        @foreach(__('legal.pc_s4_droits') as [$droit, $desc])
                        <div class="flex items-start gap-3 p-3 rounded-xl bg-gray-50">
                            <span class="mt-0.5 w-1.5 h-1.5 rounded-full bg-gold flex-shrink-0" aria-hidden="true"></span>
                            <div>
                                <dt class="text-xs font-bold text-primary">{{ $droit }}</dt>
                                <dd class="text-xs text-gray-600 mt-0.5">{{ $desc }}</dd>
                            </div>
                        </div>
                        @endforeach
                    </dl>
                    <p class="mt-4 text-sm text-gray-600 leading-relaxed">
                        {{ __('legal.pc_s4_exercer') }}
                    </p>
                </section>

                {{-- ──────────────────────────────────────
                     S5 — Cookies
                     ────────────────────────────────────── --}}
                <section aria-labelledby="pc-s5">
                    <h2 id="pc-s5" class="text-lg font-bold text-primary mb-4 pb-2 border-b border-gray-100">
                        5. {{ __('legal.pc_s5_titre') }}
                    </h2>
                    <p class="text-sm text-gray-600 mb-5 leading-relaxed">{{ __('legal.pc_s5_intro') }}</p>
                    <div class="overflow-x-auto rounded-xl border border-gray-200">
                        <table class="min-w-full text-xs" aria-label="{{ __('legal.pc_s5_titre') }}">
                            <thead class="bg-gray-50 text-gray-700 border-b border-gray-200">
                                <tr>
                                    @foreach(__('legal.pc_s5_tableau_head') as $h)
                                    <th scope="col" class="px-4 py-3 text-left font-semibold">{{ $h }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach(__('legal.pc_s5_lignes') as $ligne)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    @foreach($ligne as $cellule)
                                    <td class="px-4 py-3 text-gray-600 leading-relaxed align-top">{{ $cellule }}</td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>

                {{-- ──────────────────────────────────────
                     S6 — Gestion des préférences (widget)
                     ────────────────────────────────────── --}}
                <section aria-labelledby="pc-s6">
                    <h2 id="pc-s6" class="text-lg font-bold text-primary mb-4 pb-2 border-b border-gray-100">
                        6. {{ __('legal.pc_s6_titre') }}
                    </h2>
                    <p class="text-sm text-gray-600 mb-5">{{ __('legal.pc_s6_intro') }}</p>

                    <div class="p-5 rounded-2xl bg-primary/5 border border-primary/20 space-y-3">
                        <div class="flex flex-wrap gap-3">
                            {{-- Ouvrir le panneau de préférences --}}
                            <button
                                type="button"
                                onclick="window.dispatchEvent(new CustomEvent('nima:openPreferences'))"
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl
                                       bg-primary text-white text-sm font-semibold
                                       hover:bg-primary-800 transition-colors duration-150
                                       focus-visible:ring-2 focus-visible:ring-gold focus-visible:ring-offset-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                {{ __('legal.pc_s6_btn_gerer') }}
                            </button>

                            {{-- Retirer le consentement --}}
                            <button
                                type="button"
                                onclick="
                                    localStorage.removeItem('nima_consent');
                                    window.dispatchEvent(new CustomEvent('nima:openPreferences'));
                                "
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl
                                       border-2 border-primary text-primary text-sm font-semibold
                                       hover:bg-primary hover:text-white transition-all duration-150
                                       focus-visible:ring-2 focus-visible:ring-gold focus-visible:ring-offset-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                {{ __('legal.pc_s6_btn_retirer') }}
                            </button>
                        </div>

                        <p class="text-xs text-gray-500 italic">{{ __('legal.pc_s6_note') }}</p>
                    </div>
                </section>

                {{-- ──────────────────────────────────────
                     S7 — Cadre légal camerounais
                     ────────────────────────────────────── --}}
                <section aria-labelledby="pc-s7">
                    <h2 id="pc-s7" class="text-lg font-bold text-primary mb-4 pb-2 border-b border-gray-100">
                        7. {{ __('legal.pc_s7_titre') }}
                    </h2>
                    <p class="text-sm text-gray-600 leading-relaxed">{{ __('legal.pc_s7_texte') }}</p>
                </section>

                {{-- ──────────────────────────────────────
                     S8 — Modifications
                     ────────────────────────────────────── --}}
                <section aria-labelledby="pc-s8">
                    <h2 id="pc-s8" class="text-lg font-bold text-primary mb-4 pb-2 border-b border-gray-100">
                        8. {{ __('legal.pc_s8_titre') }}
                    </h2>
                    <p class="text-sm text-gray-600 leading-relaxed">{{ __('legal.pc_s8_texte') }}</p>
                </section>

                {{-- ──────────────────────────────────────
                     S9 — Contact & réclamations
                     ────────────────────────────────────── --}}
                <section aria-labelledby="pc-s9">
                    <h2 id="pc-s9" class="text-lg font-bold text-primary mb-4 pb-2 border-b border-gray-100">
                        9. {{ __('legal.pc_s9_titre') }}
                    </h2>
                    <p class="text-sm text-gray-600 mb-4">{{ __('legal.pc_s9_texte') }}</p>
                    <ul class="text-sm space-y-2">
                        <li class="flex items-start gap-2">
                            <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-gold flex-shrink-0" aria-hidden="true"></span>
                            <span class="text-gray-600">
                                {{ $locale === 'fr' ? 'E-mail :' : 'Email:' }}
                                <a href="mailto:{{ config('nima.legal.email_rgpd') }}"
                                   class="text-primary hover:text-gold transition-colors font-medium">
                                    {{ config('nima.legal.email_rgpd') }}
                                </a>
                            </span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary/40 flex-shrink-0" aria-hidden="true"></span>
                            <span class="text-gray-600">{{ __('legal.pc_s9_cnil') }}</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary/40 flex-shrink-0" aria-hidden="true"></span>
                            <span class="text-gray-600">{{ __('legal.pc_s9_antic') }}</span>
                        </li>
                    </ul>
                </section>

            </div>{{-- /corps --}}
        </div>{{-- /grid --}}
    </div>
</div>
{{-- /contenu --}}


@endsection
