@extends('layouts.app')

@php $locale = app()->getLocale(); @endphp

@section('meta_titre',       __('blog.meta_titre'))
@section('meta_description', __('blog.meta_description'))
@section('canonical',        url()->current())

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
            "name": "{{ __('blog.breadcrumb') }}",
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
<section class="hero-pattern py-16 lg:py-24" aria-labelledby="blog-page-heading">
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
                <li class="text-white/80" aria-current="page">{{ __('blog.breadcrumb') }}</li>
            </ol>
        </nav>

        <x-ui.section-heading
            id="blog-page-heading"
            tag="h1"
            :badge="__('blog.badge')"
            :sub="__('blog.sous_titre')"
            light>
            {{ __('blog.titre') }}
        </x-ui.section-heading>

    </div>
</section>
{{-- /hero --}}


{{-- ============================================================
     LISTING LIVEWIRE (filtres + grille + pagination)
     ============================================================ --}}
@livewire('blog.listing-blog')


@endsection
