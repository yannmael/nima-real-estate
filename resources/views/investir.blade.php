@extends('layouts.app')

@php $locale = app()->getLocale(); @endphp

@section('meta_titre',       __('investir.meta_titre'))
@section('meta_description', __('investir.meta_description'))
@section('canonical',        url()->current())

@push('head')
@php
    $schemaInvestir = \App\Services\SeoService::graph(
        \App\Services\SeoService::localBusiness(),
        \App\Services\SeoService::breadcrumb([
            ['name' => __('app.nav_home'),        'url' => route('locale.home',    ['locale' => $locale])],
            ['name' => __('investir.breadcrumb'), 'url' => route('locale.investir', ['locale' => $locale])],
        ]),
    );
@endphp
<x-seo.json-ld :data="$schemaInvestir" />
@endpush

@section('content')


{{-- ============================================================
     HERO
     ============================================================ --}}
<section class="hero-pattern py-16 lg:py-24" aria-labelledby="investir-page-heading">
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
                <li class="text-white/80" aria-current="page">
                    {{ __('investir.breadcrumb') }}
                </li>
            </ol>
        </nav>

        <x-ui.section-heading
            id="investir-page-heading"
            tag="h1"
            :badge="__('investir.badge')"
            :sub="__('investir.sous_titre')"
            light>
            {{ __('investir.titre') }}
        </x-ui.section-heading>

        {{-- Ancres rapides --}}
        <div class="mt-10 flex flex-wrap gap-3" role="navigation" aria-label="{{ $locale === 'fr' ? 'Sections de la page' : 'Page sections' }}">
            @foreach([
                ['href' => '#marche',    'label' => __('investir.marche_badge')],
                ['href' => '#rendements','label' => __('investir.rendements_badge')],
                ['href' => '#juridique', 'label' => __('investir.juridique_badge')],
                ['href' => '#processus', 'label' => __('investir.processus_badge')],
                ['href' => '#faq',       'label' => __('investir.faq_badge')],
                ['href' => '#contact-investisseur', 'label' => __('investir.contact_badge')],
            ] as $ancre)
            <a href="{{ $ancre['href'] }}"
               class="inline-flex items-center gap-1.5 text-xs font-semibold text-white/70
                      border border-white/20 rounded-full px-3 py-1.5
                      hover:bg-white/10 hover:text-white transition-all duration-150">
                {{ $ancre['label'] }}
            </a>
            @endforeach
        </div>

    </div>
</section>
{{-- /hero --}}


{{-- ============================================================
     SECTION 1 — MARCHÉ & OPPORTUNITÉS
     ============================================================ --}}
<section id="marche" class="py-16 lg:py-24 bg-white" aria-labelledby="marche-heading">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-14">
            <x-ui.section-heading
                id="marche-heading"
                :badge="__('investir.marche_badge')"
                :sub="__('investir.marche_sous_titre')"
                center>
                {{ __('investir.marche_titre') }}
            </x-ui.section-heading>
        </div>

        {{-- KPI Cards — données en base --}}
        @if($indicateursMarche->count())
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 mb-16" role="list">
            @foreach($indicateursMarche as $ind)
            <div class="relative group bg-gray-50 hover:bg-primary hover:text-white
                        border border-gray-100 rounded-2xl p-5 text-center
                        transition-all duration-200 cursor-default"
                 role="listitem">

                {{-- Badge placeholder visible --}}
                @if($ind->est_placeholder)
                <span class="absolute top-2 right-2 text-[9px] font-bold uppercase
                             tracking-wider bg-amber-100 text-amber-700 rounded px-1 py-0.5
                             border border-amber-200"
                      aria-label="{{ __('investir.marche_placeholder_avertissement') }}">
                    À sourcer
                </span>
                @endif

                <p class="text-2xl sm:text-3xl font-black text-primary group-hover:text-white
                           transition-colors duration-200 leading-none mb-1">
                    {{ $ind->valeur }}
                </p>
                @if($ind->unite)
                <p class="text-xs text-gold-dark font-semibold mb-2">
                    {{ $ind->unite }}
                </p>
                @endif
                <p class="text-xs text-gray-500 group-hover:text-white/70 leading-snug
                           transition-colors duration-200">
                    {{ $ind->libelle }}
                </p>

            </div>
            @endforeach
        </div>
        @endif

        {{-- Atouts qualitatifs — 4 colonnes --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['num' => 1, 'icon' => 'chart'],
                ['num' => 2, 'icon' => 'city'],
                ['num' => 3, 'icon' => 'building'],
                ['num' => 4, 'icon' => 'currency'],
            ] as $atout)
            <article class="bg-gray-50 rounded-2xl p-6 border border-gray-100">

                <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center
                            justify-center mb-4 flex-shrink-0">
                    @if($atout['icon'] === 'chart')
                    <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                    @elseif($atout['icon'] === 'city')
                    <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3 21h18M9 21V7l3-4 3 4v14M5 21V11l4-3M15 21v-3a3 3 0 016 0v3"/>
                    </svg>
                    @elseif($atout['icon'] === 'building')
                    <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    @else
                    <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    @endif
                </div>

                <h3 class="font-bold text-primary text-sm leading-snug mb-2">
                    {{ __('investir.atout_'.$atout['num'].'_titre') }}
                </h3>
                <p class="text-xs text-gray-500 leading-relaxed">
                    {{ __('investir.atout_'.$atout['num'].'_texte') }}
                </p>

            </article>
            @endforeach
        </div>

    </div>
</section>
{{-- /marché --}}


{{-- ============================================================
     SECTION 2 — RENDEMENTS LOCATIFS
     ============================================================ --}}
<section id="rendements" class="py-16 lg:py-24 bg-gray-950" aria-labelledby="rendements-heading">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-8 mb-14">
            <x-ui.section-heading
                id="rendements-heading"
                :badge="__('investir.rendements_badge')"
                :sub="__('investir.rendements_sous_titre')"
                light>
                {{ __('investir.rendements_titre') }}
            </x-ui.section-heading>
        </div>

        {{-- Grille rendements par ville — données en base --}}
        @if($indicateursRendements->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-8" role="list">
            @foreach($indicateursRendements as $ind)
            <div class="relative bg-white/5 border border-white/10 rounded-2xl p-6
                        hover:bg-white/10 transition-colors duration-150"
                 role="listitem">

                @if($ind->est_placeholder)
                <span class="absolute top-3 right-3 text-[9px] font-bold uppercase
                             tracking-wider bg-amber-400/20 text-amber-300 rounded px-1.5 py-0.5
                             border border-amber-400/30"
                      aria-label="{{ __('investir.marche_placeholder_avertissement') }}">
                    À sourcer
                </span>
                @endif

                <p class="text-xs font-semibold uppercase tracking-widest text-white/40 mb-3">
                    {{ $ind->libelle }}
                </p>

                <p class="text-4xl font-black text-gold leading-none mb-1">
                    {{ $ind->valeur }}
                </p>
                @if($ind->unite)
                <p class="text-xs text-white/50">{{ $ind->unite }}</p>
                @endif

            </div>
            @endforeach
        </div>
        @endif

        <p class="text-xs text-white/30 leading-relaxed max-w-3xl">
            {{ __('investir.rendements_note') }}
        </p>

    </div>
</section>
{{-- /rendements --}}


{{-- ============================================================
     SECTION 3 — CADRE JURIDIQUE
     ============================================================ --}}
<section id="juridique" class="py-16 lg:py-24 bg-white" aria-labelledby="juridique-heading">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-start">

            {{-- Texte intro --}}
            <div>
                <x-ui.section-heading
                    id="juridique-heading"
                    :badge="__('investir.juridique_badge')"
                    :sub="__('investir.juridique_sous_titre')">
                    {{ __('investir.juridique_titre') }}
                </x-ui.section-heading>

                {{-- Indicateurs juridiques — données en base --}}
                @if($indicateursJuridique->count())
                <div class="mt-8 space-y-4" role="list">
                    @foreach($indicateursJuridique as $ind)
                    <div class="relative flex items-center justify-between
                                bg-gray-50 border border-gray-100 rounded-xl px-5 py-4"
                         role="listitem">

                        @if($ind->est_placeholder)
                        <span class="absolute top-2 right-2 text-[9px] font-bold uppercase
                                     tracking-wider bg-amber-100 text-amber-700 rounded px-1 py-0.5
                                     border border-amber-200">
                            À sourcer
                        </span>
                        @endif

                        <span class="text-sm text-gray-600 leading-snug max-w-xs pr-4">
                            {{ $ind->libelle }}
                        </span>
                        <span class="flex-shrink-0 text-right">
                            <span class="block text-lg font-black text-primary leading-none">
                                {{ $ind->valeur }}
                            </span>
                            @if($ind->unite)
                            <span class="text-xs text-gray-400">{{ $ind->unite }}</span>
                            @endif
                        </span>

                    </div>
                    @endforeach
                </div>
                @endif

                <div class="mt-8">
                    <x-ui.btn
                        :href="route('locale.contact', ['locale' => $locale])"
                        type="outline">
                        {{ __('investir.juridique_cta') }}
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </x-ui.btn>
                </div>
            </div>

            {{-- Blocs texte éditoriaux (dans lang files) --}}
            <div class="space-y-5">
                @foreach([1, 2, 3, 4] as $n)
                @php
                    $titreKey  = 'investir.juridique_bloc_'.$n.'_titre';
                    $texteKey  = 'investir.juridique_bloc_'.$n.'_texte';
                    $texte     = __($texteKey);
                    $isPlaceholder = str_starts_with($texte, '[À COMPLÉTER') || str_starts_with($texte, '[TO BE COMPLETED');
                @endphp
                <article class="relative bg-gray-50 border border-gray-100 rounded-2xl p-6">

                    @if($isPlaceholder)
                    <div class="mb-3 flex items-center gap-2">
                        <span class="text-[10px] font-bold uppercase tracking-wider
                                     bg-amber-100 text-amber-700 rounded px-2 py-0.5
                                     border border-amber-200">
                            À compléter par le client
                        </span>
                    </div>
                    @endif

                    <h3 class="font-bold text-primary mb-2 text-sm leading-snug">
                        {{ __($titreKey) }}
                    </h3>
                    <p class="text-sm text-gray-500 leading-relaxed
                               {{ $isPlaceholder ? 'italic text-amber-800/70 font-mono text-xs' : '' }}">
                        {{ $texte }}
                    </p>

                </article>
                @endforeach
            </div>

        </div>

    </div>
</section>
{{-- /juridique --}}


{{-- ============================================================
     SECTION 4 — PROCESSUS POUR NON-RÉSIDENTS
     ============================================================ --}}
<section id="processus" class="py-16 lg:py-24 bg-primary" aria-labelledby="processus-investir-heading">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-14">
            <x-ui.section-heading
                id="processus-investir-heading"
                :badge="__('investir.processus_badge')"
                :sub="__('investir.processus_sous_titre')"
                center
                light>
                {{ __('investir.processus_titre') }}
            </x-ui.section-heading>
        </div>

        <ol class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([1, 2, 3, 4, 5, 6] as $n)
            <li class="relative bg-white/5 border border-white/10 rounded-2xl p-6
                        hover:bg-white/10 transition-colors duration-150">

                <div class="flex items-start gap-4">

                    {{-- Numéro --}}
                    <div class="w-10 h-10 rounded-full bg-gold flex items-center justify-center
                                flex-shrink-0 text-primary text-xs font-black shadow-sm"
                         aria-hidden="true">
                        {{ __('investir.processus_etape_'.$n.'_num') }}
                    </div>

                    <div class="min-w-0">
                        <h3 class="font-bold text-white text-sm leading-snug mb-2">
                            {{ __('investir.processus_etape_'.$n.'_titre') }}
                        </h3>
                        <p class="text-xs text-white/60 leading-relaxed">
                            {{ __('investir.processus_etape_'.$n.'_texte') }}
                        </p>
                    </div>

                </div>

                {{-- Connecteur entre étapes (desktop, rangée 1) --}}
                @if(in_array($n, [1, 2, 4, 5]))
                <div class="hidden lg:block absolute top-10 -right-3 w-6 h-px bg-white/20"
                     aria-hidden="true"></div>
                @endif

            </li>
            @endforeach
        </ol>

    </div>
</section>
{{-- /processus --}}


{{-- ============================================================
     SECTION 5 — FAQ INVESTISSEURS
     ============================================================ --}}
<section id="faq" class="py-16 lg:py-24 bg-gray-50" aria-labelledby="faq-heading">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 lg:gap-16">

            {{-- Titre --}}
            <div>
                <x-ui.section-heading
                    id="faq-heading"
                    :badge="__('investir.faq_badge')"
                    :sub="__('investir.faq_sous_titre')">
                    {{ __('investir.faq_titre') }}
                </x-ui.section-heading>

                <div class="mt-8">
                    <x-ui.btn
                        :href="'#contact-investisseur'"
                        type="gold">
                        {{ __('investir.contact_badge') }}
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </x-ui.btn>
                </div>
            </div>

            {{-- Accordéon FAQ — Alpine.js --}}
            <div class="lg:col-span-2">

                @if($faqs->count())
                <dl class="space-y-3" x-data="{ ouvert: null }">
                    @foreach($faqs as $faq)
                    <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm"
                         x-data>

                        <dt>
                            <button
                                type="button"
                                class="w-full flex items-center justify-between gap-4
                                       px-6 py-5 text-left text-sm font-semibold text-primary
                                       hover:bg-gray-50 transition-colors duration-150
                                       focus-visible:ring-2 focus-visible:ring-gold focus-visible:ring-inset"
                                :aria-expanded="ouvert === {{ $loop->index }} ? 'true' : 'false'"
                                :aria-controls="'faq-reponse-{{ $loop->index }}'"
                                @click="ouvert = ouvert === {{ $loop->index }} ? null : {{ $loop->index }}">

                                <span>{{ $faq->question }}</span>

                                <svg class="w-5 h-5 flex-shrink-0 text-gold transition-transform duration-200"
                                     :class="ouvert === {{ $loop->index }} ? 'rotate-180' : ''"
                                     fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                                </svg>

                            </button>
                        </dt>

                        <dd
                            id="faq-reponse-{{ $loop->index }}"
                            x-show="ouvert === {{ $loop->index }}"
                            x-collapse
                            class="border-t border-gray-100">

                            @php
                                $rep = $faq->reponse;
                                $repIsPlaceholder = str_starts_with($rep, '[À COMPLÉTER') || str_starts_with($rep, '[TO BE COMPLETED');
                            @endphp

                            <div class="px-6 py-5">
                                @if($repIsPlaceholder)
                                <div class="flex items-start gap-2 mb-3">
                                    <span class="text-[10px] font-bold uppercase tracking-wider
                                                 bg-amber-100 text-amber-700 rounded px-2 py-0.5
                                                 border border-amber-200 flex-shrink-0">
                                        À compléter
                                    </span>
                                </div>
                                <p class="text-xs text-amber-800/70 italic font-mono leading-relaxed">
                                    {{ $rep }}
                                </p>
                                @else
                                <p class="text-sm text-gray-600 leading-relaxed">
                                    {{ $rep }}
                                </p>
                                @endif
                            </div>

                        </dd>

                    </div>
                    @endforeach
                </dl>
                @else
                <p class="text-sm text-gray-400 italic">{{ __('investir.faq_vide') }}</p>
                @endif

            </div>

        </div>

    </div>
</section>
{{-- /faq --}}


{{-- ============================================================
     SECTION 6 — CONTACT DÉDIÉ INVESTISSEURS
     ============================================================ --}}
<section id="contact-investisseur" class="py-16 lg:py-24 bg-white" aria-labelledby="contact-investisseur-heading">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 lg:gap-16 items-start">

            {{-- Intro --}}
            <div>
                <x-ui.section-heading
                    id="contact-investisseur-heading"
                    :badge="__('investir.contact_badge')"
                    :sub="__('investir.contact_sous_titre')">
                    {{ __('investir.contact_titre') }}
                </x-ui.section-heading>

                {{-- Bloc info direct --}}
                <div class="mt-8 bg-primary/5 border border-primary/10 rounded-2xl p-6">

                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-9 h-9 rounded-xl bg-gold/20 flex items-center
                                    justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-gold" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-primary text-sm">
                            {{ __('investir.contact_info_titre') }}
                        </h3>
                    </div>

                    <p class="text-xs text-gray-500 leading-relaxed
                               {{ str_starts_with(__('investir.contact_info_texte'), '[MONTANT') ? 'italic text-amber-800/70 font-mono' : '' }}">
                        {{ __('investir.contact_info_texte') }}
                    </p>

                    <div class="mt-4 pt-4 border-t border-primary/10 space-y-3">

                        <a href="mailto:{{ config('nima.contact.email') }}"
                           class="flex items-center gap-2 text-sm text-primary font-semibold
                                  hover:text-gold transition-colors duration-150">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            {{ config('nima.contact.email') }}
                        </a>

                        <a href="https://wa.me/{{ preg_replace('/\D/', '', config('nima.whatsapp.number')) }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="flex items-center gap-2 text-sm text-green-600 font-semibold
                                  hover:text-green-700 transition-colors duration-150">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                            WhatsApp
                        </a>

                    </div>
                </div>
            </div>

            {{-- Formulaire Livewire — réutilisation du composant contact existant --}}
            <div class="lg:col-span-2">
                <div class="bg-white border border-gray-100 rounded-3xl p-6 sm:p-8 shadow-sm">
                    @livewire('contact.formulaire-contact')
                </div>
            </div>

        </div>

    </div>
</section>
{{-- /contact investisseur --}}


@endsection
