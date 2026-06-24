@extends('layouts.app')

@php $locale = app()->getLocale(); @endphp

@section('meta_titre',       __('services.meta_titre'))
@section('meta_description', __('services.meta_description'))

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
            "name": "{{ __('services.titre') }}",
            "item": "{{ url()->current() }}"
        }
    ]
}
</script>
@endpush

@section('content')


{{-- ============================================================
     HERO
     ============================================================ --}}
<section class="hero-pattern py-16 lg:py-24" aria-labelledby="services-page-heading">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Breadcrumb --}}
        <nav aria-label="Fil d'Ariane" class="mb-8">
            <ol class="flex items-center gap-2 text-xs text-white/60">
                <li>
                    <a href="{{ route('locale.home', ['locale' => $locale]) }}"
                       class="hover:text-white transition-colors">
                        {{ __('app.nav_home') }}
                    </a>
                </li>
                <li aria-hidden="true" class="text-white/30">/</li>
                <li class="text-white/80" aria-current="page">
                    {{ __('services.titre') }}
                </li>
            </ol>
        </nav>

        <x-ui.section-heading
            id="services-page-heading"
            tag="h1"
            :badge="__('services.badge')"
            :sub="__('services.sous_titre')"
            light>
            {{ __('services.titre') }}
        </x-ui.section-heading>

    </div>
</section>
{{-- /hero --}}


{{-- ============================================================
     SERVICES PAR ENTITÉ
     ============================================================ --}}
<section class="py-16 lg:py-24 bg-white" aria-labelledby="par-entite-heading">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-14 text-center">
            <x-ui.section-heading
                id="par-entite-heading"
                :badge="__('services.par_entite_badge')"
                :sub="__('services.par_entite_sous_titre')"
                center>
                {{ __('services.par_entite_titre') }}
            </x-ui.section-heading>
        </div>

        {{-- Une section par entité --}}
        <div class="space-y-20 lg:space-y-28">

            @foreach($entreprises as $i => $entreprise)
            @php
                $couleur  = $entreprise->couleur_accent;
                $services = $entreprise->services_localises;
            @endphp

            <article aria-labelledby="entite-{{ $entreprise->slug }}-heading">

                {{-- En-tête entité --}}
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-10
                            pb-6 border-b-2" style="border-color: {{ $couleur }}20;">

                    <div class="flex items-center gap-4">
                        {{-- Monogramme couleur entité --}}
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center
                                    text-white font-black text-xl flex-shrink-0 shadow-sm"
                             style="background-color: {{ $couleur }};"
                             aria-hidden="true">
                            {{ mb_strtoupper(mb_substr($entreprise->nom, 0, 1)) }}
                        </div>

                        <div>
                            <h2 id="entite-{{ $entreprise->slug }}-heading"
                                class="text-xl font-bold text-primary leading-tight">
                                {{ $entreprise->nom }}
                            </h2>
                            <p class="text-sm text-gray-500 mt-0.5 leading-snug max-w-xl">
                                {{ $entreprise->description }}
                            </p>
                        </div>
                    </div>

                    <x-ui.btn
                        :href="route('locale.entite', ['locale' => $locale, 'slug' => $entreprise->slug])"
                        type="outline"
                        size="sm"
                        class="flex-shrink-0 self-start sm:self-auto">
                        {{ __('services.voir_entite') }}
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </x-ui.btn>

                </div>

                {{-- Grille des services --}}
                @if(count($services))
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach($services as $j => $service)
                    <div class="group flex items-start gap-4 bg-gray-50 hover:bg-white
                                border border-gray-100 hover:border-gray-200 hover:shadow-sm
                                rounded-2xl p-6 transition-all duration-200">

                        {{-- Puce colorée --}}
                        <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0"
                             style="background-color: {{ $couleur }}15; border: 1px solid {{ $couleur }}30;">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2"
                                 style="color: {{ $couleur }};" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>

                        <div class="min-w-0">
                            <h3 class="font-bold text-primary text-sm leading-snug mb-1.5">
                                {{ $service }}
                            </h3>
                            <p class="text-xs text-gray-400 leading-relaxed font-mono">
                                {{ __('services.service_placeholder') }}
                            </p>
                        </div>

                    </div>
                    @endforeach
                </div>
                @endif

            </article>
            @endforeach

        </div>

    </div>
</section>
{{-- /services par entité --}}


{{-- ============================================================
     APERÇU DU PROCESSUS — 6 étapes condensées
     ============================================================ --}}
<section class="bg-gray-950 py-16 lg:py-24" aria-labelledby="processus-apercu-heading">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-8 mb-14">
            <x-ui.section-heading
                id="processus-apercu-heading"
                :badge="__('services.processus_badge')"
                :sub="__('services.processus_sous_titre')"
                light>
                {{ __('services.processus_titre') }}
            </x-ui.section-heading>

            <x-ui.btn
                :href="route('locale.processus', ['locale' => $locale])"
                type="outline-white"
                class="flex-shrink-0 self-start lg:self-auto">
                {{ __('services.processus_cta') }}
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </x-ui.btn>
        </div>

        {{-- Timeline 6 étapes condensée --}}
        <div class="relative">

            {{-- Ligne connectrice desktop --}}
            <div class="hidden lg:block absolute top-5 left-0 right-0 h-px bg-white/10"
                 aria-hidden="true"></div>

            <ol class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-6 lg:gap-4">
                @php
                    $etapesServices = [
                        ['num' => '01', 'key' => 'etape_1', 'icone' => 'chat'],
                        ['num' => '02', 'key' => 'etape_2', 'icone' => 'search'],
                        ['num' => '03', 'key' => 'etape_3', 'icone' => 'pencil'],
                        ['num' => '04', 'key' => 'etape_4', 'icone' => 'document'],
                        ['num' => '05', 'key' => 'etape_5', 'icone' => 'wrench'],
                        ['num' => '06', 'key' => 'etape_6', 'icone' => 'key'],
                    ];
                @endphp

                @foreach($etapesServices as $etape)
                <li class="flex flex-col items-center text-center">

                    {{-- Cercle numéro (au-dessus de la ligne) --}}
                    <div class="relative w-10 h-10 rounded-full flex items-center justify-center
                                text-white text-xs font-bold mb-4 z-10
                                bg-gold shadow-sm shadow-gold/20">
                        {{ $etape['num'] }}
                    </div>

                    <h3 class="text-white text-sm font-semibold leading-snug">
                        {{ __('services.' . $etape['key']) }}
                    </h3>

                </li>
                @endforeach
            </ol>

        </div>

    </div>
</section>
{{-- /processus aperçu --}}


{{-- ============================================================
     CTA FINAL
     ============================================================ --}}
<x-home.cta-band
    :badge="__('app.cta_contact')"
    :btn-label="__('app.nav_contact')"
    :btn-href="route('locale.contact', ['locale' => $locale])"
    :btn-alt="__('app.nav_portfolio')"
    :btn-alt-href="route('locale.portfolio', ['locale' => $locale])" />

@endsection
