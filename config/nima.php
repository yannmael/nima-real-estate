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
        'address' => env('CONTACT_ADDRESS', 'Douala, Cameroun'),
    ],

];
