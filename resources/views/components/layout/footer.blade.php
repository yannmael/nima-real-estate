@php
    $locale = app()->getLocale();

    $entities = [
        ['label' => __('app.entity_nima'),    'url' => url("/{$locale}/entites/nima-real-estate")],
        ['label' => __('app.entity_isbd'),    'url' => url("/{$locale}/entites/infinite-sky-blue-design")],
        ['label' => __('app.entity_tkd'),     'url' => url("/{$locale}/entites/tkd-construction")],
        ['label' => __('app.entity_vintage'), 'url' => url("/{$locale}/entites/vintage-clean")],
    ];

    $navLinks = [
        ['label' => __('app.nav_home'),      'url' => url("/{$locale}")],
        ['label' => __('app.nav_portfolio'),  'url' => url("/{$locale}/portfolio")],
        ['label' => __('app.nav_services'),   'url' => url("/{$locale}/services")],
        ['label' => __('app.nav_invest'),     'url' => url("/{$locale}/investir")],
        ['label' => __('app.nav_blog'),       'url' => url("/{$locale}/blog")],
        ['label' => __('app.nav_contact'),    'url' => url("/{$locale}/contact")],
    ];
@endphp

<footer class="bg-primary text-primary-100" role="contentinfo">

    {{-- Grille principale --}}
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-14 lg:py-16">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">

            {{-- Colonne 1 : Logo + tagline + contact --}}
            <div class="sm:col-span-2 lg:col-span-1">
                <a href="{{ url("/{$locale}") }}"
                   class="inline-flex items-center gap-3 mb-4 group"
                   aria-label="{{ __('app.site_name') }}">
                    <div class="w-9 h-9 rounded-lg bg-gold flex items-center justify-center flex-shrink-0
                                group-hover:bg-gold-600 transition-colors">
                        <span class="text-primary font-black text-sm">N</span>
                    </div>
                    <span class="text-white font-bold text-base leading-tight">
                        NIMA<br>
                        <span class="text-gold text-xs font-semibold tracking-widest uppercase">Real Estate</span>
                    </span>
                </a>
                <p class="text-sm leading-relaxed mb-6">{{ __('app.site_tagline') }}</p>

                {{-- Coordonnées --}}
                <address class="not-italic text-sm space-y-2">
                    <p class="flex items-start gap-2">
                        <svg class="w-4 h-4 mt-0.5 text-gold flex-shrink-0" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        {{ config('nima.contact.address') }}
                    </p>
                    <p class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gold flex-shrink-0" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <a href="mailto:{{ config('nima.contact.email') }}"
                           class="hover:text-white transition-colors">{{ config('nima.contact.email') }}</a>
                    </p>
                    <p class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gold flex-shrink-0" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <a href="tel:{{ config('nima.contact.phone') }}"
                           class="hover:text-white transition-colors">{{ config('nima.contact.phone') }}</a>
                    </p>
                </address>
            </div>

            {{-- Colonne 2 : Nos entités --}}
            <div>
                <h2 class="text-white text-sm font-semibold uppercase tracking-widest mb-5">
                    {{ __('app.footer_entities') }}
                </h2>
                <ul class="space-y-3">
                    @foreach($entities as $entity)
                        <li>
                            <a href="{{ $entity['url'] }}"
                               class="text-sm hover:text-white transition-colors duration-150
                                      flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-gold flex-shrink-0" aria-hidden="true"></span>
                                {{ $entity['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Colonne 3 : Navigation --}}
            <div>
                <h2 class="text-white text-sm font-semibold uppercase tracking-widest mb-5">
                    {{ __('app.footer_nav') }}
                </h2>
                <ul class="space-y-3">
                    @foreach($navLinks as $link)
                        <li>
                            <a href="{{ $link['url'] }}"
                               class="text-sm hover:text-white transition-colors duration-150">
                                {{ $link['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Colonne 4 : Groupe & réseaux (placeholder) --}}
            <div>
                <h2 class="text-white text-sm font-semibold uppercase tracking-widest mb-5">
                    {{ __('app.footer_about') }}
                </h2>
                <ul class="space-y-3 text-sm">
                    <li>
                        <a href="{{ url("/{$locale}/mentions-legales") }}"
                           class="hover:text-white transition-colors">{{ __('app.footer_legal') }}</a>
                    </li>
                    <li>
                        <a href="{{ url("/{$locale}/politique-de-confidentialite") }}"
                           class="hover:text-white transition-colors">{{ __('app.footer_privacy') }}</a>
                    </li>
                </ul>

                {{-- Icône WhatsApp dans le footer --}}
                <div class="mt-8">
                    <a href="https://wa.me/{{ preg_replace('/\D/', '', config('nima.whatsapp.number')) }}?text={{ urlencode(config('nima.whatsapp.message')) }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       aria-label="{{ __('app.whatsapp_aria') }}"
                       class="inline-flex items-center gap-2 text-sm text-primary-100
                              hover:text-white transition-colors">
                        <svg class="w-5 h-5 text-green-400" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        WhatsApp
                    </a>
                </div>
            </div>

        </div>
    </div>

    {{-- Barre de copyright --}}
    <div class="border-t border-primary-700">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-4
                    flex flex-col sm:flex-row items-center justify-between gap-2">
            <p class="text-xs text-primary-100">
                &copy; {{ date('Y') }} {{ __('app.site_name') }}. {{ __('app.footer_rights') }}
            </p>
            <div class="flex items-center gap-4 text-xs">
                <a href="{{ url("/{$locale}/mentions-legales") }}"
                   class="text-primary-100 hover:text-white transition-colors">
                    {{ __('app.footer_legal') }}
                </a>
                <a href="{{ url("/{$locale}/politique-de-confidentialite") }}"
                   class="text-primary-100 hover:text-white transition-colors">
                    {{ __('app.footer_privacy') }}
                </a>
            </div>
        </div>
    </div>

</footer>
