@extends('layouts.app')

@section('meta_titre', __('portfolio.meta_titre'))
@section('meta_description', __('portfolio.meta_description'))

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
