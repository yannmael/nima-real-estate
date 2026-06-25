<div>

    {{-- ================================================================
         BARRE DE FILTRES — sticky, toggleable sur mobile
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
        role="search"
        aria-label="{{ __('blog.filtres_categories_label') }}"
    >
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Bouton toggle mobile --}}
            <button
                @click="open = !open"
                type="button"
                :aria-expanded="open.toString()"
                aria-controls="blog-filtres-panel"
                class="flex w-full items-center justify-between py-4 text-sm font-semibold text-primary lg:hidden"
            >
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/>
                    </svg>
                    {{ __('blog.filtres_categories_label') }}
                    @unless($this->aucunFiltre)
                        <span class="ml-1 inline-flex items-center justify-center w-5 h-5 rounded-full
                                     bg-gold text-white text-[10px] font-bold"
                              aria-hidden="true">
                            {{ ($categorie !== '' ? 1 : 0) + ($tag !== '' ? 1 : 0) }}
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
                id="blog-filtres-panel"
                x-show="open"
                x-cloak
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 -translate-y-1"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-1"
            >
                <div class="py-4 space-y-3">

                    {{-- Catégories --}}
                    @if(count($categories))
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-2">
                            {{ __('blog.filtres_categories_label') }}
                        </p>
                        <div class="flex flex-wrap gap-2" role="group"
                             aria-label="{{ __('blog.filtres_categories_label') }}">
                            @foreach($categories as $cat)
                            <button
                                wire:click="filtrerCategorie('{{ $cat }}')"
                                type="button"
                                class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold
                                       border transition-all duration-150 focus-visible:ring-2
                                       focus-visible:ring-gold focus-visible:ring-offset-1
                                       {{ $categorie === $cat
                                            ? 'bg-primary text-white border-primary shadow-sm'
                                            : 'bg-white text-gray-600 border-gray-200 hover:border-primary hover:text-primary' }}"
                                :aria-pressed="{{ $categorie === $cat ? 'true' : 'false' }}"
                            >
                                {{ $cat }}
                                @if($categorie === $cat)
                                    <svg class="ml-1.5 w-3 h-3" fill="none" viewBox="0 0 24 24"
                                         stroke="currentColor" stroke-width="3" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                @endif
                            </button>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Tags --}}
                    @if(count($tags))
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-2">
                            {{ __('blog.filtres_tags_label') }}
                        </p>
                        <div class="flex flex-wrap gap-2" role="group"
                             aria-label="{{ __('blog.filtres_tags_label') }}">
                            @foreach($tags as $t)
                            <button
                                wire:click="filtrerTag('{{ $t }}')"
                                type="button"
                                class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium
                                       border transition-all duration-150 focus-visible:ring-2
                                       focus-visible:ring-gold focus-visible:ring-offset-1
                                       {{ $tag === $t
                                            ? 'bg-gold text-primary border-gold shadow-sm'
                                            : 'bg-white text-gray-500 border-gray-200 hover:border-gray-400 hover:text-gray-700' }}"
                                :aria-pressed="{{ $tag === $t ? 'true' : 'false' }}"
                            >
                                #{{ $t }}
                                @if($tag === $t)
                                    <svg class="ml-1.5 w-3 h-3" fill="none" viewBox="0 0 24 24"
                                         stroke="currentColor" stroke-width="3" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                @endif
                            </button>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Réinitialiser --}}
                    @unless($this->aucunFiltre)
                    <div>
                        <button
                            wire:click="reinitialiser"
                            type="button"
                            class="inline-flex items-center gap-1.5 text-xs font-medium text-gray-500
                                   hover:text-primary transition-colors duration-150"
                        >
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            {{ __('blog.filtres_reinitialiser') }}
                        </button>
                    </div>
                    @endunless

                </div>
            </div>

        </div>
    </div>
    {{-- /barre de filtres --}}


    {{-- ================================================================
         GRILLE D'ARTICLES
         ================================================================ --}}
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-16">

        {{-- Compteur live --}}
        <div class="flex items-center justify-between mb-8 min-h-[28px]">
            <p role="status" aria-live="polite" aria-atomic="true" class="text-sm text-gray-500">
                <span wire:loading.remove>
                    {{ trans_choice('blog.filtres_n_articles', $articles->total(), ['count' => $articles->total()]) }}
                    @unless($this->aucunFiltre)
                        <span class="text-primary font-medium">
                            —
                            @if($categorie !== '') {{ $categorie }} @endif
                            @if($tag !== '') #{{ $tag }} @endif
                        </span>
                    @endunless
                </span>
                <span wire:loading class="inline-flex items-center gap-1.5 text-gray-400">
                    <svg class="animate-spin w-4 h-4 text-gold" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                    </svg>
                    <span class="sr-only">{{ __('blog.filtres_chargement') }}</span>
                </span>
            </p>
        </div>

        @if($articles->isEmpty())
            {{-- État vide --}}
            <div class="flex flex-col items-center justify-center py-24 text-center">
                <div class="w-16 h-16 rounded-2xl bg-gray-100 flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                    </svg>
                </div>
                <h2 class="text-lg font-bold text-primary mb-2">{{ __('blog.filtres_vide_titre') }}</h2>
                <p class="text-sm text-gray-400 max-w-xs mb-6">{{ __('blog.filtres_vide_texte') }}</p>
                <button
                    wire:click="reinitialiser"
                    type="button"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl
                           border-2 border-primary text-primary text-sm font-semibold
                           hover:bg-primary hover:text-white transition-all duration-200"
                >
                    {{ __('blog.filtres_reinitialiser') }}
                </button>
            </div>

        @else

            <div
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6
                       transition-opacity duration-200"
                wire:loading.class="opacity-50 pointer-events-none"
            >
                @foreach($articles as $article)
                    <x-blog.card-article :article="$article" :locale="$locale" />
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($articles->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $articles->links() }}
                </div>
            @endif

        @endif

    </div>
    {{-- /grille --}}

</div>
