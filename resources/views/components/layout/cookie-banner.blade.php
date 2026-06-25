@php $locale = app()->getLocale(); @endphp

{{--
    Bandeau de consentement aux cookies — étape 11
    Conforme RGPD + loi camerounaise n°2010/012 + recommandations ANTIC.
    Deux niveaux : choix simple (accepter/refuser/paramétrer) et panneau granulaire.
    Consent Mode v2 : gtag('consent','update') émis à chaque choix.
    Événement personnalisé 'nima:consent' diffusé pour les scripts tiers (Leaflet).
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
     aria-modal="true"
     aria-labelledby="cookie-titre"
     class="fixed bottom-0 left-0 right-0 z-[60]
            bg-white border-t-2 border-gold shadow-2xl
            max-h-[85vh] overflow-y-auto">

    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-5">

        {{-- ============================================================
             NIVEAU 1 — Choix simple
             ============================================================ --}}
        <div x-show="!detail">
            <div class="flex flex-col lg:flex-row lg:items-center gap-5 lg:gap-10">

                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 mb-1.5">
                        <span class="w-2 h-2 rounded-full bg-gold flex-shrink-0" aria-hidden="true"></span>
                        <p id="cookie-titre" class="text-sm font-bold text-primary">
                            {{ __('app.cookie_titre') }}
                        </p>
                    </div>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        {{ __('app.cookie_texte') }}
                        <a href="{{ route('locale.confidentialite', ['locale' => $locale]) }}"
                           class="text-primary font-medium underline hover:text-gold transition-colors ml-1
                                  focus-visible:ring-2 focus-visible:ring-gold focus-visible:ring-offset-1 rounded">
                            {{ __('app.cookie_plus') }}
                        </a>
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-2 flex-shrink-0">
                    <button @click="detail = true"
                            type="button"
                            class="px-4 py-2 text-xs font-medium text-gray-600 bg-gray-100
                                   rounded-lg hover:bg-gray-200 transition-colors
                                   focus-visible:ring-2 focus-visible:ring-gold focus-visible:ring-offset-2">
                        {{ __('app.cookie_paramétrer') }}
                    </button>
                    <button @click="refuseAll()"
                            type="button"
                            class="px-4 py-2 text-xs font-semibold text-gray-700 border border-gray-300
                                   rounded-lg hover:bg-gray-50 transition-colors
                                   focus-visible:ring-2 focus-visible:ring-gold focus-visible:ring-offset-2">
                        {{ __('app.cookie_refuser') }}
                    </button>
                    <button @click="acceptAll()"
                            type="button"
                            class="px-5 py-2 text-xs font-bold bg-primary text-white
                                   rounded-lg hover:bg-primary-800 transition-colors
                                   focus-visible:ring-2 focus-visible:ring-gold focus-visible:ring-offset-2">
                        {{ __('app.cookie_accepter') }}
                    </button>
                </div>

            </div>
        </div>
        {{-- /niveau 1 --}}


        {{-- ============================================================
             NIVEAU 2 — Panneau de personnalisation granulaire
             ============================================================ --}}
        <div x-show="detail" x-cloak>

            <div class="mb-4">
                <p id="cookie-titre" class="text-sm font-bold text-primary mb-1">
                    {{ __('app.cookie_prefs_titre') }}
                </p>
                <p class="text-xs text-gray-500 leading-relaxed">
                    {{ __('app.cookie_prefs_intro') }}
                </p>
            </div>

            <div class="space-y-2 mb-5">

                {{-- Nécessaires — toujours actifs, non configurables --}}
                <div class="flex items-start gap-4 p-3.5 bg-gray-50 rounded-xl">
                    <div class="flex-1">
                        <p class="text-xs font-bold text-primary">
                            {{ __('app.cookie_cat_necessaires') }}
                        </p>
                        <p class="text-xs text-gray-500 mt-0.5 leading-relaxed">
                            {{ __('app.cookie_cat_necessaires_desc') }}
                        </p>
                    </div>
                    <span class="flex-shrink-0 mt-0.5 inline-flex items-center px-2 py-0.5 rounded-full
                                 text-[10px] font-bold bg-green-100 text-green-700 whitespace-nowrap">
                        {{ __('app.cookie_toujours_actif') }}
                    </span>
                </div>

                {{-- Analytiques — Google Analytics 4 --}}
                <label class="flex items-start gap-4 p-3.5 rounded-xl border cursor-pointer
                              transition-colors duration-150
                              hover:border-primary/40"
                       :class="consent.analytics
                           ? 'bg-primary/5 border-primary/30'
                           : 'bg-white border-gray-200'">
                    <input type="checkbox"
                           x-model="consent.analytics"
                           class="mt-0.5 w-4 h-4 rounded border-gray-300 text-primary
                                  focus:ring-2 focus:ring-gold cursor-pointer flex-shrink-0"
                           aria-describedby="desc-analytics">
                    <div class="flex-1" id="desc-analytics">
                        <p class="text-xs font-bold text-primary">
                            {{ __('app.cookie_cat_analytics') }}
                        </p>
                        <p class="text-xs text-gray-500 mt-0.5 leading-relaxed">
                            {{ __('app.cookie_cat_analytics_desc') }}
                        </p>
                    </div>
                </label>

                {{-- Fonctionnels — carte OpenStreetMap --}}
                <label class="flex items-start gap-4 p-3.5 rounded-xl border cursor-pointer
                              transition-colors duration-150
                              hover:border-primary/40"
                       :class="consent.functional
                           ? 'bg-primary/5 border-primary/30'
                           : 'bg-white border-gray-200'">
                    <input type="checkbox"
                           x-model="consent.functional"
                           class="mt-0.5 w-4 h-4 rounded border-gray-300 text-primary
                                  focus:ring-2 focus:ring-gold cursor-pointer flex-shrink-0"
                           aria-describedby="desc-functional">
                    <div class="flex-1" id="desc-functional">
                        <p class="text-xs font-bold text-primary">
                            {{ __('app.cookie_cat_fonctionnels') }}
                        </p>
                        <p class="text-xs text-gray-500 mt-0.5 leading-relaxed">
                            {{ __('app.cookie_cat_fonctionnels_desc') }}
                        </p>
                    </div>
                </label>

            </div>

            <div class="flex flex-wrap items-center gap-3">
                <button @click="detail = false"
                        type="button"
                        class="text-xs text-gray-400 hover:text-primary transition-colors
                               focus-visible:ring-2 focus-visible:ring-gold focus-visible:ring-offset-1 rounded">
                    ← {{ __('app.cookie_retour') }}
                </button>
                <div class="flex flex-wrap gap-2 ml-auto">
                    <button @click="refuseAll()"
                            type="button"
                            class="px-4 py-2 text-xs font-semibold text-gray-700 border border-gray-300
                                   rounded-lg hover:bg-gray-50 transition-colors
                                   focus-visible:ring-2 focus-visible:ring-gold focus-visible:ring-offset-2">
                        {{ __('app.cookie_refuser') }}
                    </button>
                    <button @click="acceptAll()"
                            type="button"
                            class="px-4 py-2 text-xs font-semibold text-white bg-primary/80
                                   rounded-lg hover:bg-primary transition-colors
                                   focus-visible:ring-2 focus-visible:ring-gold focus-visible:ring-offset-2">
                        {{ __('app.cookie_accepter') }}
                    </button>
                    <button @click="savePreferences()"
                            type="button"
                            class="px-5 py-2 text-xs font-bold bg-primary text-white
                                   rounded-lg hover:bg-primary-800 transition-colors
                                   focus-visible:ring-2 focus-visible:ring-gold focus-visible:ring-offset-2">
                        {{ __('app.cookie_enregistrer') }}
                    </button>
                </div>
            </div>

        </div>
        {{-- /niveau 2 --}}

    </div>
</div>

<script>
/**
 * Composant Alpine.js du bandeau de consentement.
 * Défini ici (avant @livewireScripts) pour être disponible lors de l'initialisation d'Alpine.
 *
 * État persisté : localStorage 'nima_consent' = { analytics, functional, ts }
 * État global   : window.__nimaConsent = { analytics, functional }
 * Événement     : CustomEvent 'nima:consent' sur window (detail = { analytics, functional })
 */
function cookieBanner() {
    return {
        show:    false,
        detail:  false,
        consent: { analytics: false, functional: false },

        init() {
            const stored = this._load();
            if (stored) {
                this.consent = { analytics: !!stored.analytics, functional: !!stored.functional };
            } else {
                this.show = true;
            }
            // Exposer l'état global immédiatement (avant même d'ouvrir le bandeau)
            window.__nimaConsent = { ...this.consent };
            this._applyGA4();
            this._dispatch();

            // Permettre l'ouverture du panneau depuis la page Politique de confidentialité
            window.addEventListener('nima:openPreferences', () => {
                this.show   = true;
                this.detail = true;
            });
        },

        /* Charger le consentement stocké (null si absent ou expiré après 180 jours) */
        _load() {
            try {
                const raw = localStorage.getItem('nima_consent');
                if (!raw) return null;
                const d = JSON.parse(raw);
                if (!d.ts || Date.now() - d.ts > 180 * 86400 * 1000) {
                    localStorage.removeItem('nima_consent');
                    return null;
                }
                return d;
            } catch (e) { return null; }
        },

        /* Persister le consentement avec un timestamp */
        _save() {
            localStorage.setItem('nima_consent', JSON.stringify({
                analytics:  this.consent.analytics,
                functional: this.consent.functional,
                ts:         Date.now(),
            }));
        },

        /* Mettre à jour GA4 Consent Mode v2 */
        _applyGA4() {
            if (typeof gtag !== 'function') return;
            gtag('consent', 'update', {
                analytics_storage:     this.consent.analytics  ? 'granted' : 'denied',
                functionality_storage: this.consent.functional ? 'granted' : 'denied',
            });
            if (this.consent.analytics) {
                gtag('event', 'page_view');
            } else {
                this._deleteGACookies();
            }
        },

        /* Supprimer les cookies GA quand analytics est refusé/retiré */
        _deleteGACookies() {
            const host    = location.hostname;
            const expires = 'expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/;';
            document.cookie.split(';').forEach(function (c) {
                const name = c.trim().split('=')[0];
                if (name.startsWith('_ga')) {
                    document.cookie = name + '=;' + expires + 'domain=' + host;
                    document.cookie = name + '=;' + expires + 'domain=.' + host;
                }
            });
        },

        /* Diffuser l'état sur window pour Leaflet et tout autre script tiers */
        _dispatch() {
            window.__nimaConsent = { ...this.consent };
            window.dispatchEvent(new CustomEvent('nima:consent', { detail: { ...this.consent } }));
        },

        acceptAll() {
            this.consent = { analytics: true, functional: true };
            this._save();
            this._applyGA4();
            this._dispatch();
            this.show   = false;
            this.detail = false;
        },

        refuseAll() {
            this.consent = { analytics: false, functional: false };
            this._save();
            this._applyGA4();
            this._dispatch();
            this.show   = false;
            this.detail = false;
        },

        /* Enregistrer les choix granulaires tels quels */
        savePreferences() {
            this._save();
            this._applyGA4();
            this._dispatch();
            this.show   = false;
            this.detail = false;
        },
    };
}
</script>
