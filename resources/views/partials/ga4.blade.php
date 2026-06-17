{{--
    Google Analytics 4 — Consent Mode v2
    Chargé uniquement si GA4_MEASUREMENT_ID est défini dans .env.
    Consentement par défaut : TOUT REFUSÉ (RGPD + ePrivacy).
    Le bandeau cookies (étape 11) appellera gtag('consent','update',...) après choix utilisateur.
--}}
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){ dataLayer.push(arguments); }

// Consentements par défaut — refus total avant interaction utilisateur
gtag('consent', 'default', {
    'ad_storage':           'denied',
    'ad_user_data':         'denied',
    'ad_personalization':   'denied',
    'analytics_storage':    'denied',
    'functionality_storage':'denied',
    'personalization_storage':'denied',
    'security_storage':     'granted', // nécessaire pour CSRF, sessions
    'wait_for_update':      500
});

gtag('js', new Date());
</script>

{{-- Chargement asynchrone — ne bloque pas le rendu --}}
<script async src="https://www.googletagmanager.com/gtag/js?id={{ config('nima.ga4.measurement_id') }}"></script>

<script>
gtag('config', '{{ config('nima.ga4.measurement_id') }}', {
    'send_page_view': false // envoyé après mise à jour du consentement
});
</script>
