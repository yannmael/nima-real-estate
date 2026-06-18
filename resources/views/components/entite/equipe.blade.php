@props(['entreprise'])

@php
    $couleur = $entreprise->couleur_accent;
    $equipe  = $entreprise->equipe_localisee;
@endphp

@if(count($equipe))
<section class="py-20 lg:py-24 bg-white" aria-labelledby="equipe-heading">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-14">
            <x-ui.section-heading
                id="equipe-heading"
                :badge="__('entite.equipe_badge')"
                :sub="__('entite.equipe_sous_titre')">
                {{ __('entite.equipe_titre') }}
            </x-ui.section-heading>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($equipe as $membre)
                @php
                    $initiales = collect(explode(' ', $membre['nom']))
                        ->map(fn($w) => mb_strtoupper(mb_substr(preg_replace('/^\[.*?\]\s*/', '', $w), 0, 1)))
                        ->filter()
                        ->take(2)
                        ->implode('');
                @endphp

                <article class="text-center group">

                    {{-- Avatar placeholder avec initiales --}}
                    <div class="relative mx-auto mb-4 w-24 h-24 sm:w-28 sm:h-28 rounded-full overflow-hidden
                                ring-2 ring-offset-2 transition-all duration-200"
                         style="ring-color: {{ $couleur }};"
                         role="img"
                         :aria-label="'{{ __('entite.equipe_photo_alt') }} ' + '{{ $membre['nom'] }}'">

                        {{-- Placeholder avatar coloré --}}
                        <div class="w-full h-full flex items-center justify-center text-white
                                    font-bold text-xl"
                             style="background-color: {{ $couleur }}20; border: 2px solid {{ $couleur }}40;">
                            <span style="color: {{ $couleur }};">{{ $initiales ?: '?' }}</span>
                        </div>

                        {{-- Overlay placeholder --}}
                        <div class="absolute inset-0 flex items-center justify-center bg-gray-100/80
                                    opacity-0 group-hover:opacity-0">
                        </div>
                    </div>

                    {{-- Note PLACEHOLDER visible --}}
                    <p class="text-xs font-mono text-gray-300 mb-2">[PHOTO]</p>

                    <p class="font-semibold text-primary text-sm leading-snug">
                        {{ $membre['nom'] }}
                    </p>
                    <p class="text-xs text-gray-500 mt-0.5">
                        {{ $membre['fonction'] }}
                    </p>

                </article>
            @endforeach
        </div>

    </div>
</section>
@endif
