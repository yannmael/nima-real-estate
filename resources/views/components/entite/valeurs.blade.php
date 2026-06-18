@props(['entreprise'])

@php
    $couleur = $entreprise->couleur_accent;
    $valeurs = $entreprise->valeurs_localises;
@endphp

@if(count($valeurs))
<section class="py-20 lg:py-24 bg-gray-50" aria-labelledby="valeurs-heading">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-14 text-center">
            <x-ui.section-heading
                id="valeurs-heading"
                :badge="__('entite.valeurs_badge')"
                :sub="__('entite.valeurs_sous_titre')"
                center>
                {{ __('entite.valeurs_titre') }}
            </x-ui.section-heading>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($valeurs as $i => $valeur)
                <article class="bg-white rounded-2xl border border-gray-100 p-8
                                shadow-sm hover:shadow-md transition-shadow duration-200">

                    {{-- Numéro + barre d'accent --}}
                    <div class="flex items-center gap-4 mb-5">
                        <span class="text-3xl font-black tabular-nums leading-none"
                              style="color: {{ $couleur }}; opacity: 0.25;">
                            {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}
                        </span>
                        <div class="flex-1 h-px" style="background-color: {{ $couleur }}; opacity: 0.2;"></div>
                    </div>

                    <h3 class="text-lg font-bold text-primary mb-3">
                        {{ $valeur['titre'] }}
                    </h3>

                    <p class="text-sm text-gray-500 leading-relaxed font-mono">
                        {{ $valeur['desc'] }}
                    </p>

                </article>
            @endforeach
        </div>

    </div>
</section>
@endif
