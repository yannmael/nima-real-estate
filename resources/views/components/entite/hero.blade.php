@props(['entreprise'])

@php
    $locale  = app()->getLocale();
    $initial = mb_strtoupper(mb_substr($entreprise->nom, 0, 1));
    $couleur = $entreprise->couleur_accent;
@endphp

<section
    aria-labelledby="entite-hero-heading"
    class="relative min-h-[60vh] flex flex-col justify-end overflow-hidden"
    style="background-color: {{ $couleur }};">

    {{-- Motif grille architectural (identique au hero home) --}}
    <div class="absolute inset-0 hero-pattern opacity-30" aria-hidden="true"></div>

    {{-- Overlay sombre pour lisibilité --}}
    <div class="absolute inset-0 bg-black/50" aria-hidden="true"></div>

    {{-- Placeholder image (plein écran derrière l'overlay) --}}
    <div class="absolute inset-0" aria-hidden="true">
        <div class="h-full w-full flex items-center justify-end pr-8 lg:pr-16 opacity-20">
            <div class="hidden lg:flex flex-col items-center gap-2">
                <svg class="w-16 h-16 text-white" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="0.75">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v13.5a1.5 1.5 0 001.5 1.5z"/>
                </svg>
                <p class="text-white text-xs font-mono">[PLACEHOLDER IMAGE ENTITÉ]<br>1920×1080 px · WebP</p>
            </div>
        </div>
    </div>

    {{-- Contenu --}}
    <div class="relative max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20 w-full">

        {{-- Fil d'Ariane --}}
        <nav aria-label="Fil d'Ariane" class="mb-8">
            <ol class="flex items-center gap-2 text-xs text-white/60 font-medium">
                <li>
                    <a href="{{ url("/{$locale}") }}"
                       class="hover:text-white transition-colors">
                        {{ __('app.nav_home') }}
                    </a>
                </li>
                <li aria-hidden="true"><span class="mx-1">›</span></li>
                <li>
                    <span class="text-white/60">{{ __('entite.breadcrumb_entities') }}</span>
                </li>
                <li aria-hidden="true"><span class="mx-1">›</span></li>
                <li aria-current="page">
                    <span class="text-white font-semibold">{{ $entreprise->nom }}</span>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col lg:flex-row lg:items-end lg:gap-12">

            {{-- Gauche : logo + nom + description --}}
            <div class="flex-1">

                {{-- Logo placeholder --}}
                <div class="w-16 h-16 lg:w-20 lg:h-20 rounded-2xl flex items-center justify-center
                            text-white font-black text-3xl lg:text-4xl shadow-lg mb-6 flex-shrink-0"
                     style="background-color: {{ $couleur }}; border: 3px solid rgba(255,255,255,0.3);"
                     aria-hidden="true">
                    {{ $initial }}
                </div>

                <h1 id="entite-hero-heading"
                    class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-bold text-white
                           leading-tight tracking-tight mb-4">
                    {{ $entreprise->nom }}
                </h1>

                <p class="text-base sm:text-lg text-white/80 leading-relaxed max-w-2xl mb-8">
                    {{ $entreprise->description }}
                </p>

                {{-- Badges services --}}
                @if(count($entreprise->services_localises))
                    <div class="flex flex-wrap gap-2" role="list" aria-label="{{ __('entite.services_badge') }}">
                        @foreach($entreprise->services_localises as $service)
                            <span role="listitem"
                                  class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                         bg-white/15 text-white border border-white/25 backdrop-blur-sm">
                                {{ $service }}
                            </span>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>
    </div>

    {{-- Barre d'accent en bas --}}
    <div class="relative h-1 w-full" style="background-color: {{ $couleur }}; opacity: 0.6;"></div>

</section>
