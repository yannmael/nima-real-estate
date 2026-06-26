@extends('layouts.app')

@php $locale = app()->getLocale(); @endphp

@section('meta_titre', __('portfolio.meta_titre'))
@section('meta_description', __('portfolio.meta_description'))

@push('head')
@php
    $schemaPortfolio = \App\Services\SeoService::graph(
        [
            '@type'       => 'CollectionPage',
            'name'        => __('portfolio.meta_titre'),
            'description' => __('portfolio.meta_description'),
            'url'         => route('locale.portfolio', ['locale' => $locale]),
            'publisher'   => ['@id' => config('app.url') . '/#organization'],
        ],
        \App\Services\SeoService::breadcrumb([
            ['name' => __('app.nav_home'),      'url' => route('locale.home',      ['locale' => $locale])],
            ['name' => __('app.nav_portfolio'), 'url' => route('locale.portfolio', ['locale' => $locale])],
        ]),
    );
@endphp
<x-seo.json-ld :data="$schemaPortfolio" />
@endpush

@section('content')

    {{-- Hero --}}
    <section class="hero-pattern py-16 lg:py-24" aria-labelledby="portfolio-heading">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <x-ui.section-heading
                id="portfolio-heading"
                tag="h1"
                :badge="__('portfolio.badge')"
                :sub="__('portfolio.sous_titre')"
                center
                light
            >
                {{ __('portfolio.titre') }}
            </x-ui.section-heading>
        </div>
    </section>

    {{-- Grille filtrable Livewire --}}
    <livewire:portfolio.grille-portfolio />

@endsection
