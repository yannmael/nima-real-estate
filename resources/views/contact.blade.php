@extends('layouts.app')

@php $locale = app()->getLocale(); @endphp

@section('meta_titre',       __('contact.meta_titre'))
@section('meta_description', __('contact.meta_description'))
@section('canonical',        url()->current())

@push('head')
{{-- Leaflet CSS --}}
<link rel="stylesheet"
      href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
      integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
      crossorigin="anonymous">

<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        {
            "@type": "ListItem",
            "position": 1,
            "name": "{{ __('app.nav_home') }}",
            "item": "{{ url('/'.$locale) }}"
        },
        {
            "@type": "ListItem",
            "position": 2,
            "name": "{{ __('contact.breadcrumb') }}",
            "item": "{{ url()->current() }}"
        }
    ]
}
</script>
@endpush

@section('content')


{{-- ============================================================
     HERO
     ============================================================ --}}
<section class="hero-pattern py-16 lg:py-24" aria-labelledby="contact-page-heading">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

        <nav aria-label="{{ app()->getLocale() === 'fr' ? 'Fil d\'Ariane' : 'Breadcrumb' }}" class="mb-8">
            <ol class="flex items-center gap-2 text-xs text-white/60">
                <li>
                    <a href="{{ route('locale.home', ['locale' => $locale]) }}"
                       class="hover:text-white transition-colors">
                        {{ __('app.nav_home') }}
                    </a>
                </li>
                <li aria-hidden="true" class="text-white/30">/</li>
                <li class="text-white/80" aria-current="page">
                    {{ __('contact.breadcrumb') }}
                </li>
            </ol>
        </nav>

        <x-ui.section-heading
            id="contact-page-heading"
            tag="h1"
            :badge="__('contact.badge')"
            :sub="__('contact.sous_titre')"
            light>
            {{ __('contact.titre') }}
        </x-ui.section-heading>

    </div>
</section>
{{-- /hero --}}


{{-- ============================================================
     SECTION PRINCIPALE : FORMULAIRE + COORDONNÉES
     ============================================================ --}}
<section class="py-16 lg:py-24 bg-white" aria-labelledby="formulaire-heading">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Flash : newsletter confirmée depuis le lien e-mail --}}
        @if(session('newsletter_confirme'))
        <div class="mb-8 flex items-start gap-3 p-4 rounded-2xl bg-green-50 border border-green-200"
             role="alert" aria-live="polite">
            <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-sm font-medium text-green-800">{{ __('contact.newsletter_confirme') }}</p>
        </div>
        @endif

        @if(session('newsletter_erreur'))
        <div class="mb-8 flex items-start gap-3 p-4 rounded-2xl bg-red-50 border border-red-200"
             role="alert" aria-live="polite">
            <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            <p class="text-sm font-medium text-red-800">{{ __('contact.newsletter_erreur_token') }}</p>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 lg:gap-16">

            {{-- ---- Formulaire (2/3) ---- --}}
            <div class="lg:col-span-2">

                <div class="mb-8">
                    <x-ui.section-heading
                        id="formulaire-heading"
                        :badge="__('contact.form_badge')"
                        tag="h2">
                        {{ __('contact.form_titre') }}
                    </x-ui.section-heading>
                </div>

                <div class="bg-white border border-gray-100 rounded-3xl p-6 sm:p-8 shadow-sm">
                    @livewire('contact.formulaire-contact')
                </div>

            </div>

            {{-- ---- Coordonnées (1/3) ---- --}}
            <aside aria-labelledby="coords-heading">

                <div class="mb-6">
                    <p class="inline-flex items-center gap-2 text-xs font-semibold uppercase
                               tracking-widest border rounded-full px-3 py-1 mb-4
                               bg-primary-100 text-primary border-primary/10">
                        <span class="w-1.5 h-1.5 rounded-full bg-gold flex-shrink-0"
                              aria-hidden="true"></span>
                        {{ __('contact.coords_badge') }}
                    </p>
                    <h2 id="coords-heading" class="text-2xl font-bold text-primary">
                        {{ __('contact.coords_titre') }}
                    </h2>
                </div>

                <address class="not-italic space-y-5">

                    {{-- Adresse --}}
                    <div class="flex items-start gap-3">
                        <div class="w-9 h-9 rounded-xl bg-primary-100 flex items-center
                                    justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-medium uppercase tracking-wide mb-0.5">
                                {{ __('contact.coords_adresse_label') }}
                            </p>
                            <p class="text-sm text-gray-700 font-semibold">
                                {{ config('nima.contact.address') }}
                            </p>
                        </div>
                    </div>

                    {{-- E-mail --}}
                    <div class="flex items-start gap-3">
                        <div class="w-9 h-9 rounded-xl bg-primary-100 flex items-center
                                    justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-medium uppercase tracking-wide mb-0.5">
                                {{ __('contact.coords_email_label') }}
                            </p>
                            <a href="mailto:{{ config('nima.contact.email') }}"
                               class="text-sm text-primary font-semibold hover:text-gold
                                      transition-colors duration-150">
                                {{ config('nima.contact.email') }}
                            </a>
                        </div>
                    </div>

                    {{-- Téléphone --}}
                    <div class="flex items-start gap-3">
                        <div class="w-9 h-9 rounded-xl bg-primary-100 flex items-center
                                    justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-medium uppercase tracking-wide mb-0.5">
                                {{ __('contact.coords_tel_label') }}
                            </p>
                            <a href="tel:{{ config('nima.contact.phone') }}"
                               class="text-sm text-primary font-semibold hover:text-gold
                                      transition-colors duration-150">
                                {{ config('nima.contact.phone') }}
                            </a>
                        </div>
                    </div>

                    {{-- WhatsApp --}}
                    <div class="flex items-start gap-3">
                        <div class="w-9 h-9 rounded-xl bg-green-50 flex items-center
                                    justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-green-500" viewBox="0 0 24 24"
                                 fill="currentColor" aria-hidden="true">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-medium uppercase tracking-wide mb-0.5">
                                {{ __('contact.coords_whatsapp_label') }}
                            </p>
                            <a href="https://wa.me/{{ preg_replace('/\D/', '', config('nima.whatsapp.number')) }}?text={{ urlencode(config('nima.whatsapp.message')) }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="text-sm text-green-600 font-semibold hover:text-green-700
                                      transition-colors duration-150 flex items-center gap-1.5">
                                {{ __('contact.coords_whatsapp_cta') }}
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    {{-- Horaires --}}
                    <div class="flex items-start gap-3">
                        <div class="w-9 h-9 rounded-xl bg-primary-100 flex items-center
                                    justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-medium uppercase tracking-wide mb-0.5">
                                {{ __('contact.coords_horaires_label') }}
                            </p>
                            <p class="text-sm text-gray-700 font-semibold">
                                {{ __('contact.coords_horaires_valeur') }}
                            </p>
                        </div>
                    </div>

                </address>

            </aside>

        </div>

    </div>
</section>
{{-- /formulaire + coordonnées --}}


{{-- ============================================================
     CARTE INTERACTIVE (Leaflet + OpenStreetMap)
     ============================================================ --}}
<section class="bg-gray-50 py-16 lg:py-20" aria-labelledby="carte-heading">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-8">
            <x-ui.section-heading
                id="carte-heading"
                :badge="__('contact.carte_badge')"
                tag="h2">
                {{ __('contact.carte_titre') }}
            </x-ui.section-heading>
        </div>

        {{-- Carte --}}
        <div id="carte-nima"
             class="w-full rounded-3xl overflow-hidden shadow-sm border border-gray-200"
             style="height: 400px;"
             role="img"
             aria-label="{{ __('contact.carte_aria') }}"></div>

        {{-- Alternative texte pour l'accessibilité --}}
        <p class="mt-3 text-sm text-gray-400 text-center">
            {{ config('nima.contact.address') }} &mdash;
            <a href="https://www.openstreetmap.org/?mlat={{ $mapLat }}&mlon={{ $mapLng }}&zoom={{ $mapZoom }}"
               target="_blank"
               rel="noopener noreferrer"
               class="text-primary hover:text-gold transition-colors underline">
                {{ app()->getLocale() === 'fr' ? 'Ouvrir dans OpenStreetMap' : 'Open in OpenStreetMap' }}
            </a>
        </p>

    </div>
</section>
{{-- /carte --}}


{{-- ============================================================
     NEWSLETTER
     ============================================================ --}}
<section class="bg-primary py-16 lg:py-24" aria-labelledby="newsletter-heading">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-center">

            {{-- Texte --}}
            <div>
                <x-ui.section-heading
                    id="newsletter-heading"
                    :badge="__('contact.newsletter_badge')"
                    :sub="__('contact.newsletter_sous_titre')"
                    light>
                    {{ __('contact.newsletter_titre') }}
                </x-ui.section-heading>
            </div>

            {{-- Formulaire newsletter Livewire --}}
            <div>
                @livewire('contact.form-newsletter')
            </div>

        </div>

    </div>
</section>
{{-- /newsletter --}}


@endsection


@push('scripts')
{{-- Leaflet JS --}}
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV/XN/WLkA="
        crossorigin="anonymous"></script>
<script>
(function () {
    var lat  = {{ (float) $mapLat }};
    var lng  = {{ (float) $mapLng }};
    var zoom = {{ (int) $mapZoom }};

    var map = L.map('carte-nima', { scrollWheelZoom: false }).setView([lat, lng], zoom);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright" target="_blank" rel="noopener">OpenStreetMap</a>',
        maxZoom: 19,
    }).addTo(map);

    var marqueur = L.marker([lat, lng]).addTo(map);
    marqueur.bindPopup(
        '<strong style="color:#1A3C5E;">NIMA Real Estate</strong><br>' +
        '<span style="font-size:13px;color:#6b7280;">{{ addslashes(config('nima.contact.address')) }}</span>'
    ).openPopup();
})();
</script>
@endpush
