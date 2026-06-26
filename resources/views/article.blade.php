@extends('layouts.app')

@php
    $locale     = app()->getLocale();
    $metaTitre  = $article->meta_titre ?: $article->titre . ' — NIMA Real Estate';
    $metaDesc   = $article->meta_description ?: '';
@endphp

@section('meta_titre',       $metaTitre)
@section('meta_description', $metaDesc)
@section('canonical',        url()->current())
@section('og_type',          'article')
@section('og_image', $article->image_couverture ? asset($article->image_couverture) : config('nima.seo.og_image'))

@push('head')
<meta property="article:published_time" content="{{ $article->published_at->toIso8601String() }}">
<meta property="article:modified_time"  content="{{ $article->updated_at->toIso8601String() }}">
<x-seo.json-ld :data="$schemaOrg" />
@endpush

@section('content')


{{-- ============================================================
     HERO ARTICLE
     ============================================================ --}}
<section class="hero-pattern py-12 lg:py-20" aria-labelledby="article-heading">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Breadcrumb --}}
        <nav aria-label="{{ $locale === 'fr' ? 'Fil d\'Ariane' : 'Breadcrumb' }}" class="mb-8">
            <ol class="flex flex-wrap items-center gap-2 text-xs text-white/60">
                <li>
                    <a href="{{ route('locale.home', ['locale' => $locale]) }}"
                       class="hover:text-white transition-colors">
                        {{ __('app.nav_home') }}
                    </a>
                </li>
                <li aria-hidden="true" class="text-white/30">/</li>
                <li>
                    <a href="{{ route('locale.blog', ['locale' => $locale]) }}"
                       class="hover:text-white transition-colors">
                        {{ __('blog.breadcrumb') }}
                    </a>
                </li>
                <li aria-hidden="true" class="text-white/30">/</li>
                <li class="text-white/80 truncate max-w-[200px] sm:max-w-none" aria-current="page">
                    {{ $article->titre }}
                </li>
            </ol>
        </nav>

        {{-- Catégories --}}
        @if(!empty($article->categories))
        <div class="flex flex-wrap gap-2 mb-6"
             aria-label="{{ __('blog.article_categories') }}">
            @foreach($article->categories as $cat)
            <a href="{{ route('locale.blog', ['locale' => $locale, 'categorie' => $cat]) }}"
               class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                      bg-white/10 text-white/80 border border-white/20
                      hover:bg-white/20 hover:text-white transition-all duration-150">
                {{ $cat }}
            </a>
            @endforeach
        </div>
        @endif

        {{-- Titre --}}
        <h1 id="article-heading"
            class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white leading-tight max-w-3xl mb-6">
            {{ $article->titre }}
        </h1>

        {{-- Méta --}}
        <div class="flex flex-wrap items-center gap-x-5 gap-y-2 text-sm text-white/60">

            <span class="flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                {{ __('blog.article_auteur') }}
            </span>

            <time datetime="{{ $article->published_at->toDateString() }}"
                  class="flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                {{ __('blog.article_publie_le') }}
                {{ $article->published_at->translatedFormat($locale === 'fr' ? 'j F Y' : 'F j, Y') }}
            </time>

            <span class="flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ $article->temps_lecture }}&nbsp;{{ __('blog.article_temps_lecture') }}
            </span>

        </div>

    </div>
</section>
{{-- /hero --}}


{{-- ============================================================
     CORPS DE L'ARTICLE
     ============================================================ --}}
<div class="bg-white py-12 lg:py-20">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-[1fr_300px] gap-12 lg:gap-16 items-start">

            {{-- ---- Colonne contenu ---- --}}
            <div>

                {{-- Image de couverture --}}
                @if($article->image_couverture)
                <div class="mb-10 rounded-2xl overflow-hidden">
                    <img src="{{ asset($article->image_couverture) }}"
                         alt="{{ $article->titre }}"
                         class="w-full aspect-video object-cover"
                         fetchpriority="high"
                         decoding="async">
                </div>
                @else
                <div class="mb-10 rounded-2xl overflow-hidden">
                    <x-ui.placeholder-img
                        :label="$article->titre"
                        dimensions="1200×675 px"
                        ratio="16/9"
                        rounded=""
                        class="w-full"
                    />
                </div>
                @endif

                {{-- Contenu HTML éditorial --}}
                <div class="prose prose-sm sm:prose-base max-w-none
                            prose-headings:text-primary prose-headings:font-bold
                            prose-p:text-gray-600 prose-p:leading-relaxed
                            prose-a:text-gold-dark prose-a:no-underline hover:prose-a:underline
                            prose-strong:text-primary
                            prose-ul:text-gray-600 prose-ol:text-gray-600
                            prose-li:marker:text-gold
                            prose-blockquote:border-l-gold prose-blockquote:text-gray-500
                            prose-h2:text-xl prose-h2:mt-8 prose-h2:mb-4
                            prose-h3:text-base prose-h3:mt-6 prose-h3:mb-3">
                    @if($article->contenu)
                        {!! $article->contenu !!}
                    @else
                        <p class="text-amber-700 italic font-mono text-sm">
                            {{ __('blog.article_contenu_vide') }}
                        </p>
                    @endif
                </div>

                {{-- Tags --}}
                @if(!empty($article->tags))
                <div class="mt-10 pt-8 border-t border-gray-100">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-3">
                        {{ __('blog.article_tags') }}
                    </p>
                    <div class="flex flex-wrap gap-2">
                        @foreach($article->tags as $tag)
                        <a href="{{ route('locale.blog', ['locale' => $locale, 'tag' => $tag]) }}"
                           class="inline-flex items-center px-3 py-1.5 rounded-full
                                  text-xs font-medium bg-gray-100 text-gray-600
                                  hover:bg-primary hover:text-white transition-all duration-150">
                            #{{ $tag }}
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Lien retour --}}
                <div class="mt-10">
                    <a href="{{ route('locale.blog', ['locale' => $locale]) }}"
                       class="inline-flex items-center gap-2 text-sm font-semibold text-primary
                              hover:text-gold transition-colors duration-150">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                        </svg>
                        {{ __('blog.retour_blog') }}
                    </a>
                </div>

            </div>

            {{-- ---- Sidebar ---- --}}
            <aside aria-label="{{ $locale === 'fr' ? 'Informations complémentaires' : 'Additional information' }}">

                <div class="sticky top-24 space-y-6">

                    {{-- Catégories de cet article --}}
                    @if(!empty($article->categories))
                    <div class="bg-gray-50 border border-gray-100 rounded-2xl p-5">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-3">
                            {{ __('blog.article_categories') }}
                        </p>
                        <div class="flex flex-wrap gap-2">
                            @foreach($article->categories as $cat)
                            <a href="{{ route('locale.blog', ['locale' => $locale, 'categorie' => $cat]) }}"
                               class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold
                                      bg-primary text-white hover:bg-primary-800
                                      transition-colors duration-150">
                                {{ $cat }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- CTA contact --}}
                    <div class="bg-primary rounded-2xl p-6 text-center">
                        <div class="w-10 h-10 rounded-xl bg-gold/20 flex items-center
                                    justify-center mx-auto mb-4">
                            <svg class="w-5 h-5 text-gold" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                            </svg>
                        </div>
                        <p class="text-xs font-semibold uppercase tracking-widest text-gold mb-2">
                            {{ __('blog.cta_badge') }}
                        </p>
                        <p class="text-sm font-bold text-white leading-snug mb-4">
                            {{ __('blog.cta_titre') }}
                        </p>
                        <p class="text-xs text-white/60 mb-5 leading-relaxed">
                            {{ __('blog.cta_sous_titre') }}
                        </p>
                        <x-ui.btn
                            :href="route('locale.contact', ['locale' => $locale])"
                            type="gold"
                            size="sm"
                            :full="true">
                            {{ __('blog.cta_btn') }}
                        </x-ui.btn>
                    </div>

                </div>

            </aside>

        </div>

    </div>
</div>
{{-- /corps article --}}


{{-- ============================================================
     ARTICLES LIÉS
     ============================================================ --}}
@if($articlesLies->count())
<section class="bg-gray-50 py-16 lg:py-20" aria-labelledby="articles-lies-heading">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-10">
            <x-ui.section-heading
                id="articles-lies-heading"
                :badge="__('blog.articles_lies_badge')">
                {{ __('blog.articles_lies_titre') }}
            </x-ui.section-heading>

            <x-ui.btn
                :href="route('locale.blog', ['locale' => $locale])"
                type="outline"
                size="sm"
                class="flex-shrink-0 self-start sm:self-auto">
                {{ __('blog.breadcrumb') }}
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </x-ui.btn>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($articlesLies as $lie)
                <x-blog.card-article :article="$lie" :locale="$locale" />
            @endforeach
        </div>

    </div>
</section>
@endif
{{-- /articles liés --}}


{{-- ============================================================
     CTA FINAL
     ============================================================ --}}
<x-home.cta-band
    :badge="__('blog.cta_badge')"
    :btn-label="__('blog.cta_btn')"
    :btn-href="route('locale.contact', ['locale' => $locale])"
    :btn-alt="__('blog.cta_btn_alt')"
    :btn-alt-href="route('locale.investir', ['locale' => $locale])" />


@endsection
