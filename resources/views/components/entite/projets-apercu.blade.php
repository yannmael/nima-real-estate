@props(['entreprise', 'projets'])

@php
    $locale  = app()->getLocale();
    $couleur = $entreprise->couleur_accent;

    $statutLabels = [
        'realise'  => __('entite.statut_realise'),
        'en_cours' => __('entite.statut_en_cours'),
        'a_vendre' => __('entite.statut_a_vendre'),
    ];
    $statutColors = [
        'realise'  => 'bg-green-100 text-green-700',
        'en_cours' => 'bg-amber-100 text-amber-700',
        'a_vendre' => 'bg-blue-100 text-blue-700',
    ];
@endphp

<section class="py-20 lg:py-28 bg-gray-50" aria-labelledby="projets-heading">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-8 mb-14">
            <x-ui.section-heading
                id="projets-heading"
                :badge="__('entite.projets_badge')">
                {{ __('entite.projets_titre') }}
            </x-ui.section-heading>

            <x-ui.btn
                :href="url('/'.$locale.'/portfolio?entite='.$entreprise->slug)"
                type="outline"
                class="flex-shrink-0 self-start lg:self-auto">
                {{ __('entite.projets_voir_tous') }}
            </x-ui.btn>
        </div>

        @if($projets->isEmpty())
            <p class="text-gray-400 font-mono text-sm text-center py-12">
                {{ __('entite.projets_aucun') }}
            </p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($projets as $projet)
                    <article class="group bg-white rounded-2xl border border-gray-100
                                    shadow-sm hover:shadow-lg transition-all duration-300
                                    overflow-hidden hover:-translate-y-1">

                        {{-- Image --}}
                        <div class="relative">
                            <x-ui.placeholder-img
                                :label="$projet->titre"
                                dimensions="800×500 px"
                                ratio="16/9"
                                rounded=""
                                class="w-full" />

                            {{-- Badge statut --}}
                            <span class="absolute top-3 left-3 inline-flex items-center px-2.5 py-1
                                         rounded-full text-xs font-semibold
                                         {{ $statutColors[$projet->statut] ?? 'bg-gray-100 text-gray-600' }}">
                                {{ $statutLabels[$projet->statut] ?? $projet->statut }}
                            </span>
                        </div>

                        {{-- Contenu --}}
                        <div class="p-5">

                            {{-- Barre d'accent en haut --}}
                            <div class="w-8 h-0.5 rounded-full mb-3"
                                 style="background-color: {{ $couleur }};"></div>

                            <h3 class="font-bold text-primary text-sm leading-snug mb-2 line-clamp-2">
                                {{ $projet->titre }}
                            </h3>

                            {{-- Méta : lieu · année --}}
                            <div class="flex items-center gap-3 text-xs text-gray-400 mb-4">
                                @if($projet->lieu)
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24"
                                             stroke="currentColor" stroke-width="2" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        </svg>
                                        {{ $projet->lieu }}
                                    </span>
                                @endif
                                @if($projet->annee)
                                    <span>{{ $projet->annee }}</span>
                                @endif
                            </div>

                            <a href="{{ url('/'.$locale.'/portfolio/'.$projet->slug) }}"
                               class="inline-flex items-center gap-1.5 text-xs font-semibold
                                      hover:gap-2.5 transition-all duration-200"
                               style="color: {{ $couleur }};"
                               aria-label="{{ __('entite.projet_voir') }} — {{ $projet->titre }}">
                                {{ __('entite.projet_voir') }}
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>

                        </div>
                    </article>
                @endforeach
            </div>
        @endif

    </div>
</section>
