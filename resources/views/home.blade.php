@extends('layouts.app')

@section('meta_titre',       __('home.meta_titre'))
@section('meta_description', __('home.meta_description'))

@push('head')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "RealEstateAgent",
    "name": "{{ __('app.site_name') }}",
    "url": "{{ url('/') }}",
    "description": "{{ __('home.meta_description') }}",
    "address": {
        "@type": "PostalAddress",
        "addressLocality": "Douala",
        "addressCountry": "CM"
    }
}
</script>
@endpush

@section('content')
@php $locale = app()->getLocale(); @endphp

{{-- ══════════════════════════════════════════════════════
     1. HERO — plein écran
     ═════════════════════════════════════════════════════ --}}
<x-home.hero />


{{-- ══════════════════════════════════════════════════════
     2. ACCÈS AUX UNIVERS — résidentiel / tertiaire / public
     ═════════════════════════════════════════════════════ --}}
<section class="py-20 lg:py-28 bg-white" aria-labelledby="univers-heading">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-14">
            <x-ui.section-heading
                :badge="__('home.univers_titre')"
                :sub="__('home.univers_sous_titre')"
                center>
                {{ __('home.univers_titre') }}
            </x-ui.section-heading>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">

            <x-home.univers-card
                icon="residentiel"
                accent="primary"
                :titre="__('home.univers_residentiel_titre')"
                :desc="__('home.univers_residentiel_desc')"
                :cta="__('home.univers_residentiel_cta')"
                :href="url('/'.$locale.'/portfolio?type=residentiel')" />

            <x-home.univers-card
                icon="tertiaire"
                accent="gold"
                :titre="__('home.univers_tertiaire_titre')"
                :desc="__('home.univers_tertiaire_desc')"
                :cta="__('home.univers_tertiaire_cta')"
                :href="url('/'.$locale.'/portfolio?type=tertiaire')" />

            <x-home.univers-card
                icon="public"
                accent="slate"
                :titre="__('home.univers_public_titre')"
                :desc="__('home.univers_public_desc')"
                :cta="__('home.univers_public_cta')"
                :href="url('/'.$locale.'/portfolio?type=public')" />

        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════════════════
     3. ENTITÉS DU GROUPE (données DB)
     ═════════════════════════════════════════════════════ --}}
<section class="py-20 lg:py-28 bg-gray-50" aria-labelledby="entites-heading">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-8 mb-14">
            <x-ui.section-heading
                :badge="__('home.entites_badge')"
                :sub="__('home.entites_sous_titre')">
                {{ __('home.entites_titre') }}
            </x-ui.section-heading>

            <x-ui.btn
                :href="url('/'.$locale.'/portfolio')"
                type="outline"
                class="flex-shrink-0 self-start lg:self-auto">
                {{ __('home.hero_cta_projets') }}
            </x-ui.btn>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">
            @foreach($entreprises as $entreprise)
                <x-home.entity-card :entreprise="$entreprise" />
            @endforeach
        </div>

    </div>
</section>


{{-- ══════════════════════════════════════════════════════
     4. CHIFFRES CLÉS
     ═════════════════════════════════════════════════════ --}}
<section class="bg-primary py-20 lg:py-24" aria-labelledby="stats-heading">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-14">
            <x-ui.section-heading
                :badge="__('home.stats_badge')"
                :sub="__('home.stats_sous_titre')"
                center
                light>
                {{ __('home.stats_titre') }}
            </x-ui.section-heading>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-8">

            <x-home.stat-item
                :valeur="__('home.stats_projets_val')"
                :label="__('home.stats_projets_label')" />

            <x-home.stat-item
                :valeur="__('home.stats_surface_val')"
                :unite="__('home.stats_surface_unite')"
                :label="__('home.stats_surface_label')" />

            <x-home.stat-item
                :valeur="__('home.stats_experience_val')"
                :label="__('home.stats_experience_label')" />

            <x-home.stat-item
                :valeur="__('home.stats_clients_val')"
                :label="__('home.stats_clients_label')" />

        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════════════════
     5. LOGOS PARTENAIRES / CLIENTS
     ═════════════════════════════════════════════════════ --}}
<section class="py-16 lg:py-20 bg-white border-t border-gray-100"
         aria-labelledby="partenaires-heading">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-12">
            <x-ui.section-heading
                :badge="__('home.partenaires_badge')"
                :sub="__('home.partenaires_sous_titre')"
                center>
                {{ __('home.partenaires_titre') }}
            </x-ui.section-heading>
        </div>

        <div class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-6 gap-4 items-center">
            @for($i = 1; $i <= 6; $i++)
                <div class="flex items-center justify-center p-4 rounded-xl border border-gray-100
                            bg-gray-50 hover:bg-primary-100 transition-colors duration-200 group"
                     role="img"
                     aria-label="{{ __('home.partenaire_logo_alt') }} {{ $i }}">
                    <div class="text-center space-y-1.5">
                        <div class="w-10 h-10 rounded-lg bg-gray-200 group-hover:bg-primary/10
                                    flex items-center justify-center mx-auto transition-colors">
                            <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5"/>
                            </svg>
                        </div>
                        <p class="text-xs font-mono text-gray-300 leading-tight">Logo {{ $i }}</p>
                    </div>
                </div>
            @endfor
        </div>

        <p class="text-center text-xs text-gray-400 font-mono mt-8 max-w-xl mx-auto">
            [PLACEHOLDER — 6 emplacements logos partenaires/clients. Format : SVG ou PNG transparent, 200×80 px. Accord de publication requis.]
        </p>

    </div>
</section>


{{-- ══════════════════════════════════════════════════════
     6. CTA FINAL
     ═════════════════════════════════════════════════════ --}}
<x-home.cta-band />

@endsection
