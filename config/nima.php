<?php

return [

    'ga4' => [
        'measurement_id' => env('GA4_MEASUREMENT_ID', ''),
    ],

    'whatsapp' => [
        'number'  => env('WHATSAPP_NUMBER', '+237600000000'),
        // Message pré-rempli encodé en URL dans le composant
        'message' => env('WHATSAPP_MESSAGE', 'Bonjour, je souhaite obtenir des informations sur vos biens immobiliers.'),
    ],

    'seo' => [
        // Image Open Graph par défaut (à créer dans public/images/)
        'og_image' => env('APP_URL', 'https://nimarealestate.com') . '/images/og-default.webp',
    ],

    'contact' => [
        'email'   => env('CONTACT_EMAIL', 'contact@nimarealestate.com'),
        'phone'   => env('CONTACT_PHONE', '+237 6XX XXX XXX'),
        'address' => env('CONTACT_ADDRESS', 'Yaoundé, Cameroun'),
    ],

    'map' => [
        'lat'  => env('MAP_LAT',  3.8480),
        'lng'  => env('MAP_LNG',  11.5021),
        'zoom' => env('MAP_ZOOM', 14),
    ],

    'legal' => [
        'raison_sociale'    => env('LEGAL_RAISON_SOCIALE',    '[À COMPLÉTER — Raison sociale]'),
        'forme_juridique'   => env('LEGAL_FORME_JURIDIQUE',   '[À COMPLÉTER — Forme juridique]'),
        'capital'           => env('LEGAL_CAPITAL',           '[À COMPLÉTER — Capital en FCFA]'),
        'rccm'              => env('LEGAL_RCCM',              '[À COMPLÉTER — Numéro RCCM]'),
        'siege'             => env('LEGAL_SIEGE',             '[À COMPLÉTER — Adresse du siège]'),
        'dirigeant'         => env('LEGAL_DIRIGEANT',         '[À COMPLÉTER — Nom du dirigeant]'),
        'qualite_dirigeant' => env('LEGAL_QUALITE_DIRIGEANT', '[À COMPLÉTER — Qualité du dirigeant]'),
        'email_rgpd'        => env('LEGAL_EMAIL_RGPD',        '[À COMPLÉTER — E-mail RGPD]'),
        'date_maj'          => '25 juin 2026',
    ],

];
