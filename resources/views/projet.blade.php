@extends('layouts.app')

@php
    $locale      = app()->getLocale();
    $couleur     = $projet->entreprise->couleur_accent ?? '#1A3C5E';
    $devises     = ['XAF' => 'FCFA', 'EUR' => '€', 'USD' => '$'];
    $deviseLabel = $devises[$projet->budget_devise] ?? $projet->budget_devise;
    $budgetTexte = $projet->budget_montant
        ? number_format((float) $projet->budget_montant, 0, ',', ' ') . ' ' . $deviseLabel
        : __('portfolio.fiche_budget_confidentiel');
    $galerieImages = array_values(array_filter($projet->galerie ?? []));
    $plansImages   = array_values(array_filter($projet->plans ?? []));
    $statutColors  = [
        'realise'  => 'bg-green-100 text-green-700',
        'en_cours' => 'bg-amber-100 text-amber-700',
        'a_vendre' => 'bg-blue-100 text-blue-700',
    ];
    $descMeta = mb_substr(strip_tags($projet->parti_pris ?? $projet->lieu ?? ''), 0, 160);
@endphp

@section('meta_titre', $projet->titre . ' — ' . __('portfolio.meta_titre_suffix'))
@section('meta_description', $descMeta)
@section('og_type', 'article')

@push('head')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        {
            "@type": "ListItem",
            "position": 1,
            "name": "{{ __('app.nav_home') }}",
            "item": "{{ url('/'.$locale) }}"
        },
        {
            "@type": "ListItem",
            "position": 2,
            "name": "{{ __('app.nav_portfolio') }}",
            "item": "{{ route('locale.portfolio', ['locale' => $locale]) }}"
        },
        {
            "@type": "ListItem",
            "position": 3,
            "name": {{ json_encode($projet->titre) }},
            "item": "{{ url()->current() }}"
        }
    ]
}
</script>
@endpush

@section('content')

{{-- ============================================================
     HERO — image pleine largeur + titre superposé
     ============================================================ --}}
<section class="relative bg-primary" aria-labelledby="projet-titre">

    {{-- Image principale --}}
    <div class="relative h-72 sm:h-96 lg:h-[520px] w-full overflow-hidden">
        @if($projet->image_principale)
            <img
                src="{{ asset($projet->image_principale) }}"
                alt="{{ $projet->titre }}"
                class="w-full h-full object-cover"
                fetchpriority="high"
                decoding="async"
            >
        @else
            <x-ui.placeholder-img
                :label="$projet->titre . ' — ' . __('portfolio.fiche_image_principale')"
                dimensions="1920×1080 px"
                ratio="16/9"
                rounded=""
                class="absolute inset-0 w-full h-full"
            />
        @endif
        {{-- Dégradé pour lisibilité du texte --}}
        <div class="absolute inset-0 bg-gradient-to-t from-primary via-primary/50 to-transparent"
             aria-hidden="true"></div>
    </div>

    {{-- Texte superposé --}}
    <div class="absolute inset-x-0 bottom-0 max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 pb-8 lg:pb-12">

        {{-- Breadcrumb --}}
        <nav aria-label="Fil d'Ariane" class="mb-4">
            <ol class="flex flex-wrap items-center gap-2 text-xs text-white/60">
                <li>
                    <a href="{{ route('locale.home', ['locale' => $locale]) }}"
                       class="hover:text-white transition-colors duration-150">
                        {{ __('app.nav_home') }}
                    </a>
                </li>
                <li aria-hidden="true" class="text-white/30">/</li>
                <li>
                    <a href="{{ route('locale.portfolio', ['locale' => $locale]) }}"
                       class="hover:text-white transition-colors duration-150">
                        {{ __('app.nav_portfolio') }}
                    </a>
                </li>
                <li aria-hidden="true" class="text-white/30">/</li>
                <li class="text-white/80 truncate max-w-[200px]" aria-current="page">
                    {{ $projet->titre }}
                </li>
            </ol>
        </nav>

        {{-- Badges --}}
        <div class="flex flex-wrap items-center gap-2 mb-4">
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                         {{ $statutColors[$projet->statut] ?? 'bg-gray-100 text-gray-600' }}">
                {{ __('portfolio.statut_' . $projet->statut) }}
            </span>
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                         bg-white/15 text-white/90 border border-white/20">
                {{ $projet->entreprise->nom }}
            </span>
            @if($projet->typologie)
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                             bg-white/10 text-white/80 border border-white/15">
                    {{ $projet->typologie }}
                </span>
            @endif
        </div>

        {{-- Trait + titre --}}
        <div class="w-10 h-0.5 rounded-full mb-3" style="background-color: {{ $couleur }};"
             aria-hidden="true"></div>
        <h1 id="projet-titre"
            class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white leading-tight max-w-3xl">
            {{ $projet->titre }}
        </h1>

    </div>
</section>
{{-- /hero --}}


{{-- ============================================================
     FICHE TECHNIQUE + PARTI PRIS
     ============================================================ --}}
<section class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-start">

        {{-- Fiche technique --}}
        <div>
            <h2 class="text-lg font-bold text-primary mb-6 flex items-center gap-2.5">
                <span class="w-1 h-5 rounded-full flex-shrink-0"
                      style="background-color: {{ $couleur }};" aria-hidden="true"></span>
                {{ __('portfolio.fiche_titre') }}
            </h2>

            <dl class="divide-y divide-gray-100">

                <div class="flex gap-4 py-3.5">
                    <dt class="w-32 flex-shrink-0 text-xs font-semibold uppercase tracking-widest text-gray-400 pt-0.5">
                        {{ __('portfolio.fiche_entite') }}
                    </dt>
                    <dd class="text-sm text-primary font-medium">{{ $projet->entreprise->nom }}</dd>
                </div>

                @if($projet->lieu)
                <div class="flex gap-4 py-3.5">
                    <dt class="w-32 flex-shrink-0 text-xs font-semibold uppercase tracking-widest text-gray-400 pt-0.5">
                        {{ __('portfolio.fiche_lieu') }}
                    </dt>
                    <dd class="text-sm text-primary font-medium">{{ $projet->lieu }}</dd>
                </div>
                @endif

                @if($projet->surface)
                <div class="flex gap-4 py-3.5">
                    <dt class="w-32 flex-shrink-0 text-xs font-semibold uppercase tracking-widest text-gray-400 pt-0.5">
                        {{ __('portfolio.fiche_surface') }}
                    </dt>
                    <dd class="text-sm text-primary font-medium">
                        {{ number_format((float) $projet->surface, 0, ',', ' ') }}&nbsp;m²
                    </dd>
                </div>
                @endif

                <div
                    @if($projet->budget_montant)
                    x-data="{
                        devise: '{{ $projet->budget_devise }}',
                        montantBase: {{ (float) $projet->budget_montant }},
                        deviseBase: '{{ $projet->budget_devise }}',
                        tauxXAF: @js($tauxXAF),
                        get montantConverti() {
                            const enXAF = this.deviseBase === 'XAF'
                                ? this.montantBase
                                : this.montantBase * (this.tauxXAF[this.deviseBase] ?? 1);
                            if (this.devise === 'XAF') return enXAF;
                            return enXAF / (this.tauxXAF[this.devise] ?? 1);
                        },
                        get montantFormate() {
                            const valeur = Math.round(this.montantConverti).toLocaleString('fr-FR');
                            return valeur + ({ XAF: ' FCFA', EUR: ' €', USD: ' $' }[this.devise] ?? '');
                        },
                    }"
                    @endif
                    class="flex gap-4 py-3.5"
                >
                    <dt class="w-32 flex-shrink-0 text-xs font-semibold uppercase tracking-widest text-gray-400 pt-0.5">
                        {{ __('portfolio.fiche_budget') }}
                    </dt>
                    <dd>
                        @if($projet->budget_montant)
                            {{-- Montant converti (fallback SSR = devise d'origine) --}}
                            <p class="text-sm text-primary font-semibold tabular-nums"
                               x-text="montantFormate">{{ $budgetTexte }}</p>

                            {{-- Sélecteur 3 boutons --}}
                            <div class="flex gap-1 mt-2"
                                 role="group"
                                 aria-label="{{ __('portfolio.devise_selectionner') }}">
                                @foreach(['XAF' => 'FCFA', 'EUR' => 'EUR', 'USD' => 'USD'] as $code => $label)
                                    <button
                                        type="button"
                                        @click="devise = '{{ $code }}'"
                                        :aria-pressed="(devise === '{{ $code }}').toString()"
                                        :class="devise === '{{ $code }}'
                                            ? 'bg-primary text-white shadow-sm'
                                            : 'bg-gray-100 text-gray-500 hover:bg-gray-200 hover:text-primary'"
                                        class="px-2.5 py-1 rounded-md text-[11px] font-semibold
                                               transition-colors duration-150
                                               focus:outline-none focus-visible:ring-2
                                               focus-visible:ring-gold focus-visible:ring-offset-1"
                                    >{{ $label }}</button>
                                @endforeach
                            </div>

                            {{-- Note sur la source des taux --}}
                            <p class="mt-1.5 text-[10px] text-gray-400 leading-tight">
                                {{ __('portfolio.devise_note') }}
                            </p>
                        @else
                            <p class="text-sm text-primary font-medium">
                                {{ __('portfolio.fiche_budget_confidentiel') }}
                            </p>
                        @endif
                    </dd>
                </div>

                <div class="flex gap-4 py-3.5">
                    <dt class="w-32 flex-shrink-0 text-xs font-semibold uppercase tracking-widest text-gray-400 pt-0.5">
                        {{ __('portfolio.fiche_livraison') }}
                    </dt>
                    <dd class="text-sm text-primary font-medium">
                        {{ $projet->annee ?? __('portfolio.fiche_livraison_nc') }}
                    </dd>
                </div>

                <div class="flex gap-4 py-3.5">
                    <dt class="w-32 flex-shrink-0 text-xs font-semibold uppercase tracking-widest text-gray-400 pt-0.5">
                        {{ __('portfolio.fiche_statut') }}
                    </dt>
                    <dd>
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                     {{ $statutColors[$projet->statut] ?? 'bg-gray-100 text-gray-600' }}">
                            {{ __('portfolio.statut_' . $projet->statut) }}
                        </span>
                    </dd>
                </div>

            </dl>
        </div>
        {{-- /fiche technique --}}

        {{-- Parti pris --}}
        @if($projet->parti_pris)
        <div>
            <h2 class="text-lg font-bold text-primary mb-6 flex items-center gap-2.5">
                <span class="w-1 h-5 rounded-full flex-shrink-0"
                      style="background-color: {{ $couleur }};" aria-hidden="true"></span>
                {{ __('portfolio.parti_pris_titre') }}
            </h2>
            <div class="text-sm text-gray-600 leading-relaxed space-y-4">
                {!! nl2br(e($projet->parti_pris)) !!}
            </div>
        </div>
        @endif

    </div>
</section>
{{-- /fiche + parti pris --}}


{{-- ============================================================
     GALERIE HD
     ============================================================ --}}
<section class="bg-gray-50 py-12 lg:py-16" aria-labelledby="galerie-heading">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

        <h2 id="galerie-heading" class="text-lg font-bold text-primary mb-8 flex items-center gap-2.5">
            <span class="w-1 h-5 rounded-full flex-shrink-0"
                  style="background-color: {{ $couleur }};" aria-hidden="true"></span>
            {{ __('portfolio.galerie_titre') }}
        </h2>

        @if(count($galerieImages) > 0)

            <div
                x-data="{
                    ouvert: false,
                    index: 0,
                    images: @js($galerieImages),
                    ouvrir(i) {
                        this.index = i;
                        this.ouvert = true;
                        document.body.style.overflow = 'hidden';
                        this.$nextTick(() => this.$refs.fermerBtn?.focus());
                    },
                    fermer() {
                        this.ouvert = false;
                        document.body.style.overflow = '';
                    },
                    precedent() { this.index = (this.index - 1 + this.images.length) % this.images.length; },
                    suivant()   { this.index = (this.index + 1) % this.images.length; },
                }"
            >
                {{-- Grille vignettes --}}
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
                    @foreach($galerieImages as $i => $img)
                        <button
                            @click="ouvrir({{ $i }})"
                            type="button"
                            aria-label="{{ __('portfolio.galerie_ouvrir') }} {{ $i + 1 }}"
                            class="group relative aspect-video overflow-hidden rounded-xl
                                   focus:outline-none focus-visible:ring-2 focus-visible:ring-gold focus-visible:ring-offset-2"
                        >
                            <img
                                src="{{ asset($img) }}"
                                alt="{{ $projet->titre }} — {{ __('portfolio.galerie_image') }} {{ $i + 1 }}"
                                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                loading="lazy"
                                decoding="async"
                                width="400"
                                height="225"
                            >
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/25
                                        transition-colors duration-200 flex items-center justify-center"
                                 aria-hidden="true">
                                <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-200"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 15.803 7.5 7.5 0 0016.803 15.803zM10.5 7.5v6m3-3h-6"/>
                                </svg>
                            </div>
                        </button>
                    @endforeach
                </div>

                {{-- Lightbox galerie --}}
                <div
                    x-show="ouvert"
                    x-transition:enter="transition duration-200 ease-out"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition duration-150 ease-in"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    @keydown.escape.window="if(ouvert) fermer()"
                    @keydown.arrow-left.window="if(ouvert) precedent()"
                    @keydown.arrow-right.window="if(ouvert) suivant()"
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black/90 p-4"
                    role="dialog"
                    aria-modal="true"
                    :aria-label="'{{ __('portfolio.galerie_titre') }}'"
                    x-cloak
                >
                    <button
                        x-ref="fermerBtn"
                        @click="fermer()"
                        type="button"
                        aria-label="{{ __('portfolio.fermer_lightbox') }}"
                        class="absolute top-4 right-4 w-10 h-10 flex items-center justify-center
                               rounded-full bg-white/10 hover:bg-white/20 text-white
                               transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-white"
                    >
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    <button
                        @click="precedent()"
                        x-show="images.length > 1"
                        type="button"
                        aria-label="{{ __('portfolio.image_precedente') }}"
                        class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 flex items-center justify-center
                               rounded-full bg-white/10 hover:bg-white/20 text-white
                               transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-white"
                    >
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>

                    <img
                        :src="images[index]"
                        :alt="'{{ $projet->titre }} — {{ __('portfolio.galerie_image') }} ' + (index + 1)"
                        class="max-h-[85vh] max-w-[90vw] object-contain rounded-lg shadow-2xl"
                    >

                    <button
                        @click="suivant()"
                        x-show="images.length > 1"
                        type="button"
                        aria-label="{{ __('portfolio.image_suivante') }}"
                        class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 flex items-center justify-center
                               rounded-full bg-white/10 hover:bg-white/20 text-white
                               transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-white"
                    >
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>

                    <p class="absolute bottom-4 left-1/2 -translate-x-1/2 text-white/60 text-sm tabular-nums select-none"
                       aria-live="polite">
                        <span x-text="index + 1"></span> / <span x-text="images.length"></span>
                    </p>
                </div>

            </div>

        @else
            {{-- Placeholders visuels --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
                @for($i = 0; $i < 4; $i++)
                    <x-ui.placeholder-img
                        :label="__('portfolio.galerie_vide')"
                        ratio="16/9"
                        rounded="xl"
                    />
                @endfor
            </div>
            <p class="mt-4 text-center text-xs text-gray-400">{{ __('portfolio.galerie_vide') }}</p>
        @endif

    </div>
</section>
{{-- /galerie --}}


{{-- ============================================================
     PLANS ARCHITECTURAUX
     ============================================================ --}}
<section class="py-12 lg:py-16" aria-labelledby="plans-heading">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

        <h2 id="plans-heading" class="text-lg font-bold text-primary mb-8 flex items-center gap-2.5">
            <span class="w-1 h-5 rounded-full flex-shrink-0"
                  style="background-color: {{ $couleur }};" aria-hidden="true"></span>
            {{ __('portfolio.plans_titre') }}
        </h2>

        @if(count($plansImages) > 0)

            <div
                x-data="{
                    ouvert: false,
                    index: 0,
                    images: @js($plansImages),
                    ouvrir(i) {
                        this.index = i;
                        this.ouvert = true;
                        document.body.style.overflow = 'hidden';
                        this.$nextTick(() => this.$refs.fermerBtnPlans?.focus());
                    },
                    fermer() {
                        this.ouvert = false;
                        document.body.style.overflow = '';
                    },
                    precedent() { this.index = (this.index - 1 + this.images.length) % this.images.length; },
                    suivant()   { this.index = (this.index + 1) % this.images.length; },
                }"
            >
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($plansImages as $i => $plan)
                        <button
                            @click="ouvrir({{ $i }})"
                            type="button"
                            aria-label="{{ __('portfolio.plans_ouvrir') }} {{ $i + 1 }}"
                            class="group relative aspect-[4/3] overflow-hidden rounded-xl border border-gray-200
                                   bg-white hover:border-gray-300 transition-colors
                                   focus:outline-none focus-visible:ring-2 focus-visible:ring-gold focus-visible:ring-offset-2"
                        >
                            <img
                                src="{{ asset($plan) }}"
                                alt="{{ $projet->titre }} — {{ __('portfolio.plans_plan') }} {{ $i + 1 }}"
                                class="w-full h-full object-contain p-2 transition-transform duration-300 group-hover:scale-105"
                                loading="lazy"
                                decoding="async"
                            >
                        </button>
                    @endforeach
                </div>

                {{-- Lightbox plans --}}
                <div
                    x-show="ouvert"
                    x-transition:enter="transition duration-200 ease-out"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition duration-150 ease-in"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    @keydown.escape.window="if(ouvert) fermer()"
                    @keydown.arrow-left.window="if(ouvert) precedent()"
                    @keydown.arrow-right.window="if(ouvert) suivant()"
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black/90 p-4"
                    role="dialog"
                    aria-modal="true"
                    :aria-label="'{{ __('portfolio.plans_titre') }}'"
                    x-cloak
                >
                    <button
                        x-ref="fermerBtnPlans"
                        @click="fermer()"
                        type="button"
                        aria-label="{{ __('portfolio.fermer_lightbox') }}"
                        class="absolute top-4 right-4 w-10 h-10 flex items-center justify-center
                               rounded-full bg-white/10 hover:bg-white/20 text-white
                               transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-white"
                    >
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    <button
                        @click="precedent()"
                        x-show="images.length > 1"
                        type="button"
                        aria-label="{{ __('portfolio.image_precedente') }}"
                        class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 flex items-center justify-center
                               rounded-full bg-white/10 hover:bg-white/20 text-white
                               transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-white"
                    >
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>

                    <img
                        :src="images[index]"
                        :alt="'{{ $projet->titre }} — {{ __('portfolio.plans_plan') }} ' + (index + 1)"
                        class="max-h-[85vh] max-w-[90vw] object-contain rounded-lg shadow-2xl bg-white p-3"
                    >

                    <button
                        @click="suivant()"
                        x-show="images.length > 1"
                        type="button"
                        aria-label="{{ __('portfolio.image_suivante') }}"
                        class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 flex items-center justify-center
                               rounded-full bg-white/10 hover:bg-white/20 text-white
                               transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-white"
                    >
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>

                    <p class="absolute bottom-4 left-1/2 -translate-x-1/2 text-white/60 text-sm tabular-nums select-none"
                       aria-live="polite">
                        <span x-text="index + 1"></span> / <span x-text="images.length"></span>
                    </p>
                </div>

            </div>

        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @for($i = 0; $i < 3; $i++)
                    <x-ui.placeholder-img
                        :label="__('portfolio.plans_vide')"
                        dimensions="A3 / PDF"
                        ratio="4/3"
                        rounded="xl"
                    />
                @endfor
            </div>
            <p class="mt-4 text-center text-xs text-gray-400">{{ __('portfolio.plans_vide') }}</p>
        @endif

    </div>
</section>
{{-- /plans --}}


{{-- ============================================================
     TÉMOIGNAGE (affiché uniquement si visible et autorisé)
     ============================================================ --}}
@if($projet->temoignage && $projet->temoignage->visible)
<section class="bg-primary py-12 lg:py-16" aria-labelledby="temoignage-heading">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

        <p id="temoignage-heading"
           class="text-xs font-semibold uppercase tracking-widest text-gold mb-8">
            {{ __('portfolio.temoignage_titre') }}
        </p>

        <figure class="max-w-2xl">
            <blockquote class="relative">
                <svg class="w-10 h-10 text-gold/25 mb-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                </svg>
                <p class="text-white/90 text-lg leading-relaxed italic">
                    "{{ $projet->temoignage->contenu }}"
                </p>
            </blockquote>
            <figcaption class="mt-6 flex items-center gap-3">
                @if($projet->temoignage->photo)
                    <img
                        src="{{ asset($projet->temoignage->photo) }}"
                        alt="{{ $projet->temoignage->auteur }}"
                        class="w-10 h-10 rounded-full object-cover flex-shrink-0"
                        loading="lazy"
                        width="40" height="40"
                    >
                @else
                    <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center flex-shrink-0"
                         aria-hidden="true">
                        <svg class="w-5 h-5 text-white/40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                        </svg>
                    </div>
                @endif
                <div>
                    <p class="text-white font-semibold text-sm">{{ $projet->temoignage->auteur }}</p>
                    @if($projet->temoignage->fonction)
                        <p class="text-white/55 text-xs mt-0.5">{{ $projet->temoignage->fonction }}</p>
                    @endif
                </div>
            </figcaption>
        </figure>

    </div>
</section>
@endif
{{-- /témoignage --}}


{{-- ============================================================
     CTA — RETOUR PORTFOLIO
     ============================================================ --}}
<section class="border-t border-gray-100 py-10">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8
                flex flex-col sm:flex-row items-center justify-between gap-4">

        <a
            href="{{ route('locale.portfolio', ['locale' => $locale]) }}"
            class="inline-flex items-center gap-2 text-sm font-semibold text-primary
                   hover:text-gold transition-colors duration-200
                   focus:outline-none focus-visible:ring-2 focus-visible:ring-gold focus-visible:ring-offset-2 rounded"
        >
            <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            {{ __('portfolio.retour_portfolio') }}
        </a>

        <a
            href="{{ route('locale.contact', ['locale' => $locale]) }}"
            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl
                   bg-primary text-white text-sm font-semibold
                   hover:bg-primary/90 transition-colors duration-200
                   focus:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2"
        >
            {{ __('portfolio.cta_contact') }}
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>

    </div>
</section>
{{-- /cta retour --}}

@endsection
