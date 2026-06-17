@php
    $locale    = app()->getLocale();
    $altLocale = $locale === 'fr' ? 'en' : 'fr';
    $altUrl    = url(preg_replace('#^/(fr|en)#', '/' . $altLocale, request()->getRequestUri()));

    // Liens de navigation — URL construite même si la page n'existe pas encore (lien mort)
    $navLinks = [
        ['key' => 'home',      'label' => __('app.nav_home'),      'url' => url("/{$locale}")],
        ['key' => 'portfolio', 'label' => __('app.nav_portfolio'),  'url' => url("/{$locale}/portfolio")],
        ['key' => 'services',  'label' => __('app.nav_services'),   'url' => url("/{$locale}/services")],
        ['key' => 'invest',    'label' => __('app.nav_invest'),     'url' => url("/{$locale}/investir")],
        ['key' => 'blog',      'label' => __('app.nav_blog'),       'url' => url("/{$locale}/blog")],
        ['key' => 'contact',   'label' => __('app.nav_contact'),    'url' => url("/{$locale}/contact")],
    ];

    $entities = [
        ['label' => __('app.entity_nima'),    'url' => url("/{$locale}/entites/nima-real-estate"),        'slug' => 'nima-real-estate'],
        ['label' => __('app.entity_isbd'),    'url' => url("/{$locale}/entites/infinite-sky-blue-design"), 'slug' => 'infinite-sky-blue-design'],
        ['label' => __('app.entity_tkd'),     'url' => url("/{$locale}/entites/tkd-construction"),         'slug' => 'tkd-construction'],
        ['label' => __('app.entity_vintage'), 'url' => url("/{$locale}/entites/vintage-clean"),            'slug' => 'vintage-clean'],
    ];

    // Détection de la page active par correspondance de l'URL courante
    $currentPath = request()->getRequestUri();
@endphp

<header
    x-data="{ mobileOpen: false, entityOpen: false }"
    @keydown.escape="mobileOpen = false; entityOpen = false"
    class="bg-primary sticky top-0 z-50 shadow-md"
    role="banner">

    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 lg:h-18">

            {{-- Logo --}}
            <a href="{{ url("/{$locale}") }}"
               class="flex items-center gap-3 flex-shrink-0 group"
               aria-label="{{ __('app.site_name') }} — Accueil">
                {{-- Placeholder logo SVG — remplacer par <img src="..." alt="NIMA Real Estate"> --}}
                <div class="w-9 h-9 rounded-lg bg-gold flex items-center justify-center flex-shrink-0
                            group-hover:bg-gold-600 transition-colors duration-200">
                    <span class="text-primary font-black text-sm leading-none">N</span>
                </div>
                <span class="text-white font-bold text-lg leading-tight tracking-tight">
                    NIMA<br>
                    <span class="text-gold text-xs font-semibold tracking-widest uppercase">Real Estate</span>
                </span>
            </a>

            {{-- Navigation desktop (≥1024px) --}}
            <nav class="hidden lg:flex items-center gap-1" aria-label="{{ __('app.nav_home') }}">

                {{-- Accueil --}}
                <a href="{{ url("/{$locale}") }}"
                   class="px-3 py-2 text-sm font-medium rounded-md transition-colors duration-150
                          text-primary-100 hover:text-white hover:bg-primary-700
                          {{ str_starts_with($currentPath, "/{$locale}") && $currentPath === "/{$locale}" ? 'text-white bg-primary-700' : '' }}"
                   @if(str_starts_with($currentPath, "/{$locale}") && $currentPath === "/{$locale}") aria-current="page" @endif>
                    {{ __('app.nav_home') }}
                </a>

                {{-- Dropdown Nos entités --}}
                <div class="relative" x-data="{ entityOpen: false }" @click.outside="entityOpen = false">
                    <button
                        @click="entityOpen = !entityOpen"
                        :aria-expanded="entityOpen"
                        aria-haspopup="true"
                        aria-label="{{ __('app.nav_entities_open') }}"
                        class="flex items-center gap-1 px-3 py-2 text-sm font-medium rounded-md transition-colors duration-150
                               text-primary-100 hover:text-white hover:bg-primary-700">
                        {{ __('app.nav_entities') }}
                        <svg class="w-4 h-4 transition-transform duration-200"
                             :class="{ 'rotate-180': entityOpen }"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="entityOpen"
                         x-cloak
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 -translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 -translate-y-1"
                         class="absolute top-full left-0 mt-2 w-64 bg-white rounded-xl shadow-xl
                                border border-gray-100 py-1 z-50">
                        @foreach($entities as $entity)
                            <a href="{{ $entity['url'] }}"
                               class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700
                                      hover:bg-primary-100 hover:text-primary transition-colors duration-100">
                                <span class="w-2 h-2 rounded-full bg-gold flex-shrink-0"></span>
                                {{ $entity['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Autres liens --}}
                @foreach(array_slice($navLinks, 1) as $link)
                    <a href="{{ $link['url'] }}"
                       class="px-3 py-2 text-sm font-medium rounded-md transition-colors duration-150
                              text-primary-100 hover:text-white hover:bg-primary-700">
                        {{ $link['label'] }}
                    </a>
                @endforeach

            </nav>

            {{-- Côté droit : langue + CTA (desktop) --}}
            <div class="hidden lg:flex items-center gap-3">

                {{-- Bascule de langue --}}
                <div class="flex items-center rounded-lg border border-primary-700 overflow-hidden"
                     role="group" aria-label="{{ __('app.lang_switch_label') }}">
                    <a href="{{ url("/{$locale}" . substr($currentPath, 3)) }}"
                       class="px-3 py-1.5 text-xs font-bold transition-colors duration-150
                              {{ $locale === 'fr' ? 'bg-gold text-primary' : 'text-primary-100 hover:text-white hover:bg-primary-700' }}"
                       hreflang="fr"
                       aria-label="{{ __('app.lang_fr') }}"
                       @if($locale === 'fr') aria-current="true" @endif>
                        FR
                    </a>
                    <a href="{{ $altLocale === 'en' ? $altUrl : url("/fr" . substr($currentPath, 3)) }}"
                       class="px-3 py-1.5 text-xs font-bold transition-colors duration-150
                              {{ $locale === 'en' ? 'bg-gold text-primary' : 'text-primary-100 hover:text-white hover:bg-primary-700' }}"
                       hreflang="en"
                       aria-label="{{ __('app.lang_en') }}"
                       @if($locale === 'en') aria-current="true" @endif>
                        EN
                    </a>
                </div>

                {{-- CTA Contact --}}
                <a href="{{ url("/{$locale}/contact") }}"
                   class="px-4 py-2 bg-gold text-primary text-sm font-semibold rounded-lg
                          hover:bg-gold-600 transition-colors duration-200 whitespace-nowrap">
                    {{ __('app.cta_contact') }}
                </a>

            </div>

            {{-- Bouton hamburger (mobile < 1024px) --}}
            <button
                @click="mobileOpen = !mobileOpen"
                :aria-expanded="mobileOpen"
                :aria-label="mobileOpen ? '{{ __('app.nav_close') }}' : '{{ __('app.nav_open') }}'"
                class="lg:hidden p-2 rounded-md text-primary-100 hover:text-white
                       hover:bg-primary-700 transition-colors duration-150">
                {{-- Icône hamburger / croix --}}
                <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="mobileOpen" x-cloak class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

        </div>
    </div>

    {{-- Menu mobile (< 1024px) --}}
    <div x-show="mobileOpen"
         x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="lg:hidden bg-primary-800 border-t border-primary-700">

        <nav class="max-w-screen-xl mx-auto px-4 py-4 flex flex-col gap-1"
             aria-label="Navigation mobile">

            <a href="{{ url("/{$locale}") }}"
               @click="mobileOpen = false"
               class="px-4 py-3 text-sm font-medium text-primary-100 hover:text-white
                      hover:bg-primary-700 rounded-lg transition-colors">
                {{ __('app.nav_home') }}
            </a>

            {{-- Sous-menu entités mobile --}}
            <div x-data="{ open: false }">
                <button @click="open = !open"
                        :aria-expanded="open"
                        class="w-full flex items-center justify-between px-4 py-3 text-sm font-medium
                               text-primary-100 hover:text-white hover:bg-primary-700 rounded-lg
                               transition-colors text-left">
                    {{ __('app.nav_entities') }}
                    <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" x-cloak class="mt-1 ml-4 flex flex-col gap-1">
                    @foreach($entities as $entity)
                        <a href="{{ $entity['url'] }}"
                           @click="mobileOpen = false"
                           class="px-4 py-2.5 text-sm text-primary-100 hover:text-white
                                  hover:bg-primary-700 rounded-lg transition-colors flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-gold flex-shrink-0"></span>
                            {{ $entity['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>

            @foreach(array_slice($navLinks, 1) as $link)
                <a href="{{ $link['url'] }}"
                   @click="mobileOpen = false"
                   class="px-4 py-3 text-sm font-medium text-primary-100 hover:text-white
                          hover:bg-primary-700 rounded-lg transition-colors">
                    {{ $link['label'] }}
                </a>
            @endforeach

            {{-- Langue + CTA mobile --}}
            <div class="mt-3 pt-3 border-t border-primary-700 flex items-center justify-between">
                <div class="flex items-center rounded-lg border border-primary-700 overflow-hidden">
                    <a href="{{ url("/fr" . substr($currentPath, 3)) }}"
                       class="px-4 py-2 text-xs font-bold transition-colors
                              {{ $locale === 'fr' ? 'bg-gold text-primary' : 'text-primary-100 hover:text-white hover:bg-primary-700' }}"
                       hreflang="fr" aria-label="{{ __('app.lang_fr') }}">FR</a>
                    <a href="{{ url("/en" . substr($currentPath, 3)) }}"
                       class="px-4 py-2 text-xs font-bold transition-colors
                              {{ $locale === 'en' ? 'bg-gold text-primary' : 'text-primary-100 hover:text-white hover:bg-primary-700' }}"
                       hreflang="en" aria-label="{{ __('app.lang_en') }}">EN</a>
                </div>
                <a href="{{ url("/{$locale}/contact") }}"
                   @click="mobileOpen = false"
                   class="px-4 py-2 bg-gold text-primary text-sm font-semibold rounded-lg
                          hover:bg-gold-600 transition-colors">
                    {{ __('app.cta_contact') }}
                </a>
            </div>

        </nav>
    </div>

</header>
