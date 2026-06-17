@php
    $locale = app()->getLocale();
@endphp

{{--
    Bandeau cookies — PLACEHOLDER étape 11.
    Implémentation minimale RGPD : refuse par défaut, accepte sur clic, mémorise en localStorage.
    À l'étape 11 : remplacer par une vraie CMP (consentement granulaire + cookies réels).
    Alpine.js (livré avec Livewire 3) gère la logique côté client.
--}}
<div x-data="cookieBanner()"
     x-init="init()"
     x-show="show"
     x-cloak
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 translate-y-4"
     x-transition:enter-end="opacity-100 translate-y-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 translate-y-0"
     x-transition:leave-end="opacity-0 translate-y-4"
     role="dialog"
     aria-live="polite"
     aria-label="{{ $locale === 'fr' ? 'Bandeau de consentement cookies' : 'Cookie consent banner' }}"
     class="fixed bottom-0 left-0 right-0 z-50 p-4 sm:p-6
            bg-white border-t border-gray-200 shadow-xl">

    <div class="max-w-screen-xl mx-auto flex flex-col sm:flex-row items-start sm:items-center
                gap-4 justify-between">

        <p class="text-sm text-gray-700 flex-1">
            {{ __('app.cookie_text') }}
            <a href="{{ url("/{$locale}/politique-de-confidentialite") }}"
               class="text-primary underline hover:text-primary-800 ml-1">
                {{ __('app.cookie_more') }}
            </a>
        </p>

        <div class="flex items-center gap-3 flex-shrink-0">
            <button @click="refuse()"
                    class="px-4 py-2 text-sm font-medium text-gray-600 border border-gray-300
                           rounded-lg hover:bg-gray-50 transition-colors">
                {{ __('app.cookie_refuse') }}
            </button>
            <button @click="accept()"
                    class="px-4 py-2 text-sm font-semibold bg-primary text-white
                           rounded-lg hover:bg-primary-800 transition-colors">
                {{ __('app.cookie_accept') }}
            </button>
        </div>

    </div>
</div>

<script>
function cookieBanner() {
    return {
        show: false,

        init() {
            // Afficher le bandeau uniquement si aucun choix n'a encore été fait
            this.show = !localStorage.getItem('nima_cookie_consent');
        },

        accept() {
            localStorage.setItem('nima_cookie_consent', 'granted');
            this.show = false;
            // Mettre à jour le consentement GA4 (Consent Mode v2)
            if (typeof gtag === 'function') {
                gtag('consent', 'update', {
                    'analytics_storage':    'granted',
                    'functionality_storage':'granted',
                });
                // Déclencher la vue de page maintenant que le consentement est accordé
                gtag('event', 'page_view');
            }
        },

        refuse() {
            localStorage.setItem('nima_cookie_consent', 'denied');
            this.show = false;
            // GA4 reste en mode refus — aucun événement envoyé
        },
    };
}
</script>
