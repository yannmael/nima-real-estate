@extends('layouts.app')

@php
    $locale = app()->getLocale();
    $desc   = mb_substr($entreprise->description, 0, 160);
@endphp

@section('meta_titre',       $entreprise->nom . ' — ' . __('app.site_name'))
@section('meta_description', $desc)
@section('og_image',         config('nima.seo.og_image'))

@push('head')
{{-- Schema.org BreadcrumbList + LocalBusiness --}}
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@graph": [
        {
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
                    "name": "{{ __('entite.breadcrumb_entities') }}",
                    "item": "{{ url('/'.$locale.'/entites') }}"
                },
                {
                    "@type": "ListItem",
                    "position": 3,
                    "name": "{{ $entreprise->nom }}",
                    "item": "{{ url()->current() }}"
                }
            ]
        },
        {
            "@type": "LocalBusiness",
            "name": "{{ $entreprise->nom }}",
            "url": "{{ url()->current() }}",
            "description": "{{ $desc }}"
        }
    ]
}
</script>
@endpush

@section('content')

    {{-- 1. Hero — accent couleur entité --}}
    <x-entite.hero :entreprise="$entreprise" />

    {{-- 2. À propos / Histoire --}}
    <x-entite.propos :entreprise="$entreprise" />

    {{-- 3. Services — fond sombre --}}
    <x-entite.services :entreprise="$entreprise" />

    {{-- 4. Valeurs --}}
    <x-entite.valeurs :entreprise="$entreprise" />

    {{-- 5. Équipe --}}
    <x-entite.equipe :entreprise="$entreprise" />

    {{-- 6. Projets associés --}}
    <x-entite.projets-apercu :entreprise="$entreprise" :projets="$projets" />

    {{-- 7. CTA final paramétré pour l'entité --}}
    <x-home.cta-band
        :titre="__('entite.cta_badge') . ' — ' . $entreprise->nom"
        :btn-label="__('entite.cta_btn')"
        :btn-href="url('/'.$locale.'/contact')"
        :btn-alt="__('entite.cta_btn_alt')"
        :btn-alt-href="url('/'.$locale.'/services')" />

@endsection
