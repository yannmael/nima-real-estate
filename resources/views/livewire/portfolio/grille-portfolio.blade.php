<div>

    {{-- ================================================================
         BARRE DE FILTRES
         Toujours visible sur lg+, toggleable sur mobile via Alpine.js
         ================================================================ --}}
    <div
        x-data="{
            open: window.matchMedia('(min-width: 1024px)').matches,
            init() {
                window.matchMedia('(min-width: 1024px)')
                    .addEventListener('change', e => { if (e.matches) this.open = true; });
            }
        }"
        class="bg-white border-b border-gray-100 shadow-sm sticky top-0 z-20"
        aria-label="{{ __('portfolio.filtres_titre') }}"
    >
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Bouton toggle mobile --}}
            <button
                @click="open = !open"
                type="button"
                :aria-expanded="open.toString()"
                aria-controls="filtres-panel"
                class="flex w-full items-center justify-between py-4 text-sm font-semibold text-primary lg:hidden"
            >
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/>
                    </svg>
                    {{ __('portfolio.filtres_titre') }}
                    @unless($this->aucunFiltre)
                        <span class="ml-1 inline-flex items-center justify-center w-5 h-5 rounded-full
                                     bg-gold text-white text-[10px] font-bold leading-none"
                              aria-hidden="true">
                            {{ collect([$entrepriseSlug, $typologieFr, $lieu, $superficie, $annee])
                                ->filter(fn($v) => $v !== '')->count() }}
                        </span>
                    @endunless
                </span>
                <svg class="w-4 h-4 transition-transform duration-200 text-gray-400"
                     :class="{ 'rotate-180': open }"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            {{-- Panel filtres --}}
            <div
                id="filtres-panel"
                x-show="open"
                x-cloak
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 -translate-y-1"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-1"
            >
                <div class="flex flex-col lg:flex-row gap-3 pb-4 lg:py-4 lg:items-end flex-wrap">

                    {{-- Filtre : Entité --}}
                    <div class="flex-1 min-w-[150px]">
                        <label for="filtre-entite"
                               class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5">
                            {{ __('portfolio.filtre_entite_label') }}
                        </label>
                        <select
                            id="filtre-entite"
                            wire:model.live="entrepriseSlug"
                            class="w-full rounded-lg border border-gray-200 bg-white px-3 py-2
                                   text-sm text-primary focus:border-primary focus:outline-none
                                   focus:ring-2 focus:ring-primary/20"
                        >
                            <option value="">{{ __('portfolio.filtre_entite_tous') }}</option>
                            @foreach($entreprises as $ent)
                                <option value="{{ $ent->slug }}">{{ $ent->nom }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Filtre : Typologie --}}
                    <div class="flex-1 min-w-[150px]">
                        <label for="filtre-typo"
                               class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5">
                            {{ __('portfolio.filtre_typologie_label') }}
                        </label>
                        <select
                            id="filtre-typo"
                            wire:model.live="typologieFr"
                            class="w-full rounded-lg border border-gray-200 bg-white px-3 py-2
                                   text-sm text-primary focus:border-primary focus:outline-none
                                   focus:ring-2 focus:ring-primary/20"
                        >
                            <option value="">{{ __('portfolio.filtre_typologie_tous') }}</option>
                            @foreach($typologies as $typo)
                                <option value="{{ $typo->typologie_fr }}">
                                    {{ $typo->{"typologie_{$locale}"} ?? $typo->typologie_fr }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Filtre : Lieu --}}
                    <div class="flex-1 min-w-[150px]">
                        <label for="filtre-lieu"
                               class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5">
                            {{ __('portfolio.filtre_lieu_label') }}
                        </label>
                        <select
                            id="filtre-lieu"
                            wire:model.live="lieu"
                            class="w-full rounded-lg border border-gray-200 bg-white px-3 py-2
                                   text-sm text-primary focus:border-primary focus:outline-none
                                   focus:ring-2 focus:ring-primary/20"
                        >
                            <option value="">{{ __('portfolio.filtre_lieu_tous') }}</option>
                            @foreach($lieux as $l)
                                <option value="{{ $l }}">{{ $l }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Filtre : Surface --}}
                    <div class="flex-1 min-w-[140px]">
                        <label for="filtre-surface"
                               class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5">
                            {{ __('portfolio.filtre_surface_label') }}
                        </label>
                        <select
                            id="filtre-surface"
                            wire:model.live="superficie"
                            class="w-full rounded-lg border border-gray-200 bg-white px-3 py-2
                                   text-sm text-primary focus:border-primary focus:outline-none
                                   focus:ring-2 focus:ring-primary/20"
                        >
                            <option value="">{{ __('portfolio.filtre_surface_tous') }}</option>
                            <option value="xs">{{ __('portfolio.filtre_surface_xs') }}</option>
                            <option value="sm">{{ __('portfolio.filtre_surface_sm') }}</option>
                            <option value="md">{{ __('portfolio.filtre_surface_md') }}</option>
                            <option value="lg">{{ __('portfolio.filtre_surface_lg') }}</option>
                        </select>
                    </div>

                    {{-- Filtre : Année --}}
                    <div class="flex-1 min-w-[110px]">
                        <label for="filtre-annee"
                               class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5">
                            {{ __('portfolio.filtre_annee_label') }}
                        </label>
                        <select
                            id="filtre-annee"
                            wire:model.live="annee"
                            class="w-full rounded-lg border border-gray-200 bg-white px-3 py-2
                                   text-sm text-primary focus:border-primary focus:outline-none
                                   focus:ring-2 focus:ring-primary/20"
                        >
                            <option value="">{{ __('portfolio.filtre_annee_tous') }}</option>
                            @foreach($annees as $a)
                                <option value="{{ $a }}">{{ $a }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Bouton Réinitialiser (visible seulement si au moins un filtre actif) --}}
                    @unless($this->aucunFiltre)
                        <button
                            wire:click="reinitialiser"
                            type="button"
                            class="flex items-center gap-1.5 px-4 py-2 rounded-lg border border-gray-200
                                   text-sm font-medium text-gray-600 bg-white
                                   hover:border-primary hover:text-primary hover:bg-primary-100
                                   transition-colors duration-200 self-end whitespace-nowrap"
                        >
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            {{ __('portfolio.filtres_reinitialiser') }}
                        </button>
                    @endunless

                </div>
            </div>

        </div>
    </div>
    {{-- /barre de filtres --}}


    {{-- ================================================================
         GRILLE DE RÉSULTATS
         ================================================================ --}}
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14">

        {{-- Compteur de résultats (live region pour les lecteurs d'écran) --}}
        <div class="flex items-center justify-between mb-8">
            <p role="status" aria-live="polite" aria-atomic="true"
               class="text-sm text-gray-500">
                <span wire:loading.remove>
                    {{ trans_choice('portfolio.filtres_n_resultats', $projets->total()) }}
                </span>
                <span wire:loading class="inline-flex items-center gap-1.5">
                    <svg class="animate-spin w-4 h-4 text-gold" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                        <path class="opacity-75" fill="currentColor"
                              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                    </svg>
                    <span class="sr-only">Chargement…</span>
                </span>
            </p>
        </div>

        @php
            $statutColors = [
                'realise'  => 'bg-green-100 text-green-700',
                'en_cours' => 'bg-amber-100 text-amber-700',
                'a_vendre' => 'bg-blue-100 text-blue-700',
            ];
        @endphp

        @if($projets->isEmpty())
            {{-- État vide --}}
            <div class="flex flex-col items-center justify-center py-24 text-center">
                <div class="w-16 h-16 rounded-2xl bg-primary-100 flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-primary/40" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 15.803 7.5 7.5 0 0016.803 15.803z"/>
                    </svg>
                </div>
                <p class="text-gray-500 text-base max-w-sm">
                    {{ __('portfolio.aucun_resultat') }}
                </p>
                <button
                    wire:click="reinitialiser"
                    type="button"
                    class="mt-6 inline-flex items-center gap-2 px-5 py-2.5 rounded-xl
                           border-2 border-primary text-primary text-sm font-semibold
                           hover:bg-primary hover:text-white transition-all duration-200"
                >
                    {{ __('portfolio.filtres_reinitialiser') }}
                </button>
            </div>

        @else
            {{-- Grille projets --}}
            <div
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 transition-opacity duration-200"
                wire:loading.class="opacity-50 pointer-events-none"
            >
                @foreach($projets as $projet)
                    @php
                        $couleur = $projet->entreprise->couleur_accent ?? '#1A3C5E';
                    @endphp
                    <article
                        class="group relative bg-white rounded-2xl border border-gray-100
                               shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1"
                    >

                        {{-- Visuel --}}
                        <div class="relative overflow-hidden rounded-t-2xl">
                            <x-ui.placeholder-img
                                :label="$projet->titre"
                                dimensions="800×500 px"
                                ratio="16/9"
                                rounded=""
                                class="w-full"
                            />

                            {{-- Badge statut --}}
                            <span class="absolute top-3 left-3 inline-flex items-center
                                         px-2.5 py-1 rounded-full text-xs font-semibold
                                         {{ $statutColors[$projet->statut] ?? 'bg-gray-100 text-gray-600' }}">
                                {{ __('portfolio.statut_'.$projet->statut) }}
                            </span>

                            {{-- Badge entité --}}
                            <span class="absolute top-3 right-3 inline-flex items-center
                                         px-2.5 py-1 rounded-full text-xs font-medium
                                         bg-white/90 text-primary shadow-sm">
                                {{ $projet->entreprise->nom }}
                            </span>
                        </div>

                        {{-- Contenu --}}
                        <div class="p-5">

                            {{-- Trait couleur entité --}}
                            <div class="w-8 h-0.5 rounded-full mb-3"
                                 style="background-color: {{ $couleur }};"></div>

                            {{-- Titre --}}
                            <h3 class="font-bold text-primary text-sm leading-snug mb-2 line-clamp-2">
                                {{ $projet->titre }}
                            </h3>

                            {{-- Métadonnées --}}
                            <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-gray-400 mb-1">
                                @if($projet->lieu)
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3 h-3 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                                             stroke="currentColor" stroke-width="2" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        {{ $projet->lieu }}
                                    </span>
                                @endif
                                @if($projet->annee)
                                    <span>{{ $projet->annee }}</span>
                                @endif
                            </div>

                            @if($projet->surface)
                                <p class="text-xs text-gray-400 mb-2">
                                    {{ number_format((float) $projet->surface, 0, ',', ' ') }}&nbsp;{{ __('portfolio.surface_unite') }}
                                </p>
                            @endif

                            @if($projet->typologie)
                                <p class="text-xs font-medium mb-4" style="color: {{ $couleur }};">
                                    {{ $projet->typologie }}
                                </p>
                            @else
                                <div class="mb-4"></div>
                            @endif

                            {{-- Lien principal (stretched sur toute la carte) --}}
                            <a
                                href="{{ route('locale.projet', ['locale' => $locale, 'slug' => $projet->slug]) }}"
                                class="absolute inset-0 rounded-2xl focus:outline-none focus-visible:ring-2
                                       focus-visible:ring-gold focus-visible:ring-offset-2"
                                aria-label="{{ __('portfolio.projet_voir') }} — {{ $projet->titre }}"
                            ></a>

                            {{-- Indicateur textuel (décoratif, non-interactif) --}}
                            <span
                                class="relative z-10 pointer-events-none inline-flex items-center gap-1.5
                                       text-xs font-semibold transition-colors duration-200"
                                style="color: {{ $couleur }};"
                                aria-hidden="true"
                            >
                                {{ __('portfolio.projet_voir') }}
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </span>

                        </div>
                    </article>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($projets->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $projets->links() }}
                </div>
            @endif

        @endif

    </div>
    {{-- /grille --}}

</div>
