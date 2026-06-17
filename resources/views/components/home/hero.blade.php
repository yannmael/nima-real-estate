@php $locale = app()->getLocale(); @endphp

<section
    aria-labelledby="hero-heading"
    class="relative flex items-center min-h-[calc(100vh-4rem)] overflow-hidden hero-pattern">

    {{-- Overlay gradient --}}
    <div class="absolute inset-0 bg-gradient-to-r from-primary-800/95 via-primary-800/80 to-primary/40"
         aria-hidden="true"></div>

    {{-- Zone image placeholder (desktop droite) --}}
    <div class="absolute inset-y-0 right-0 w-1/2 hidden lg:block" aria-hidden="true">
        <div class="h-full w-full bg-primary-700/30 flex items-center justify-center">
            <div class="text-center px-8 space-y-2">
                <div class="w-16 h-16 rounded-2xl bg-white/10 flex items-center justify-center mx-auto">
                    <svg class="w-8 h-8 text-gold/60" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v13.5a1.5 1.5 0 001.5 1.5z"/>
                    </svg>
                </div>
                <p class="text-xs font-mono text-white/30 leading-relaxed max-w-xs">
                    [PLACEHOLDER IMAGE HERO]<br>
                    Photo projet phare · 1920×1080 px<br>
                    Format WebP/AVIF
                </p>
            </div>
        </div>
    </div>

    {{-- Contenu --}}
    <div class="relative max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32 w-full">
        <div class="max-w-xl lg:max-w-2xl">

            {{-- Badge --}}
            <div class="inline-flex items-center gap-2 bg-gold/15 border border-gold/30
                        text-gold text-xs font-semibold uppercase tracking-widest
                        rounded-full px-4 py-1.5 mb-6">
                <span class="w-1.5 h-1.5 rounded-full bg-gold" aria-hidden="true"></span>
                {{ __('home.hero_badge') }}
            </div>

            {{-- Titre h1 --}}
            <h1 id="hero-heading"
                class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-bold text-white
                       leading-tight tracking-tight mb-6">
                {{ __('home.hero_titre') }}
            </h1>

            {{-- Sous-titre --}}
            <p class="text-base sm:text-lg text-primary-100/80 leading-relaxed mb-10 max-w-lg">
                {{ __('home.hero_sous_titre') }}
            </p>

            {{-- CTAs — href en single quotes avec la syntaxe :href pour éviter
                 les guillemets imbriqués dans les attributs de composant Blade --}}
            <div class="flex flex-col sm:flex-row gap-4">

                <x-ui.btn
                    :href="url('/'.$locale.'/portfolio')"
                    type="gold"
                    size="lg">
                    {{ __('home.hero_cta_projets') }}
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </x-ui.btn>

                <x-ui.btn
                    :href="url('/'.$locale.'/contact')"
                    type="outline-white"
                    size="lg">
                    {{ __('home.hero_cta_contact') }}
                </x-ui.btn>

            </div>

        </div>
    </div>

    {{-- Indicateur de défilement --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2"
         aria-hidden="true">
        <span class="text-white/40 text-xs font-mono tracking-widest uppercase">
            {{ __('home.hero_scroll') }}
        </span>
        <div class="w-5 h-8 rounded-full border border-white/20 flex items-start justify-center pt-1.5">
            <div class="w-1 h-2 rounded-full bg-gold animate-bounce"></div>
        </div>
    </div>

</section>
