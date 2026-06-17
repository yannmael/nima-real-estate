@props([
    'entreprise',  // instance App\Models\Entreprise
])

@php
    $locale      = app()->getLocale();
    $description = $entreprise->{"description_{$locale}"} ?? $entreprise->description_fr;
    $initial     = mb_strtoupper(mb_substr($entreprise->nom, 0, 1));
    $href        = url("/{$locale}/entites/{$entreprise->slug}");
    $couleur     = $entreprise->couleur_accent ?? '#1A3C5E';
@endphp

<article class="group flex flex-col bg-white rounded-2xl border border-gray-100
                shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden
                hover:-translate-y-1 h-full">

    {{-- Barre colorée au sommet (couleur d'accent de l'entité) --}}
    <div class="h-1.5 w-full" style="background-color: {{ $couleur }};"></div>

    <div class="p-6 flex flex-col flex-1">

        {{-- En-tête : logo lettre + nom --}}
        <div class="flex items-start gap-4 mb-5">

            {{-- Logo placeholder : initiale sur fond coloré --}}
            <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0
                        text-white font-black text-xl shadow-sm"
                 style="background-color: {{ $couleur }};"
                 aria-hidden="true">
                {{ $initial }}
            </div>

            <div>
                <h3 class="font-bold text-primary text-base leading-tight">
                    {{ $entreprise->nom }}
                </h3>
                {{-- Services --}}
                @if($entreprise->services && count($entreprise->services) > 0)
                    <p class="text-xs text-gray-400 mt-0.5">
                        {{ implode(' · ', array_map(fn($s) => $s[$locale] ?? $s['fr'] ?? '', array_slice($entreprise->services, 0, 2))) }}
                    </p>
                @endif
            </div>

        </div>

        {{-- Description (depuis DB — DEMO) --}}
        <p class="text-sm text-gray-500 leading-relaxed flex-1 line-clamp-3">
            {{ $description }}
        </p>

        {{-- CTA --}}
        <a href="{{ $href }}"
           class="mt-5 inline-flex items-center gap-1.5 text-sm font-semibold
                  hover:gap-2.5 transition-all duration-200"
           style="color: {{ $couleur }};"
           aria-label="{{ __('home.entites_cta') }} — {{ $entreprise->nom }}">
            {{ __('home.entites_cta') }}
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>

    </div>
</article>
