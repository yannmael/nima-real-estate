@props([
    'badge'      => null,
    'titre'      => null,
    'sousTitre'  => null,
    'btnLabel'   => null,
    'btnHref'    => null,
    'btnAlt'     => null,
    'btnAltHref' => null,
])

@php
    $locale     = app()->getLocale();
    $titre      = $titre      ?? __('home.cta_titre');
    $sousTitre  = $sousTitre  ?? __('home.cta_sous_titre');
    $badge      = $badge      ?? __('home.cta_badge');
    $btnLabel   = $btnLabel   ?? __('home.cta_btn');
    $btnHref    = $btnHref    ?? url("/{$locale}/contact");
    $btnAlt     = $btnAlt     ?? __('home.cta_btn_alt');
    $btnAltHref = $btnAltHref ?? url("/{$locale}/services");
@endphp

<section class="bg-primary hero-pattern" aria-labelledby="cta-heading">

    {{-- Overlay subtil --}}
    <div class="bg-primary/80">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-24 text-center">

            {{-- Ligne décorative --}}
            <div class="flex items-center justify-center gap-4 mb-8" aria-hidden="true">
                <div class="h-px w-12 bg-gold/40"></div>
                <span class="text-gold text-xs font-semibold uppercase tracking-widest">
                    {{ $badge }}
                </span>
                <div class="h-px w-12 bg-gold/40"></div>
            </div>

            <h2 id="cta-heading"
                class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white
                       leading-tight max-w-3xl mx-auto mb-6">
                {{ $titre }}
            </h2>

            <p class="text-primary-100/80 text-base sm:text-lg max-w-xl mx-auto mb-10">
                {{ $sousTitre }}
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <x-ui.btn :href="$btnHref" type="gold" size="lg">
                    {{ $btnLabel }}
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </x-ui.btn>

                @if($btnAlt)
                    <x-ui.btn :href="$btnAltHref" type="outline-white" size="lg">
                        {{ $btnAlt }}
                    </x-ui.btn>
                @endif
            </div>

        </div>
    </div>

</section>
