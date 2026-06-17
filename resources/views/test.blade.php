<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('app.site_title') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen font-sans">

    <div class="bg-white rounded-2xl shadow-lg p-10 max-w-lg w-full text-center space-y-6">

        <h1 class="text-3xl font-bold text-gray-900">
            NIMA Real Estate
        </h1>

        <p class="text-gray-500 text-sm">{{ __('app.site_tagline') }}</p>

        <div class="inline-flex items-center gap-2 bg-emerald-50 text-emerald-700 px-4 py-2 rounded-full text-sm font-medium">
            {{ __('app.locale_active') }} :
            <span class="font-bold uppercase">{{ App::getLocale() }}</span>
        </div>

        {{-- Sélecteur de langue --}}
        <div class="flex justify-center gap-4 pt-2">
            <a href="{{ url('/fr') }}"
               class="px-5 py-2 rounded-lg text-sm font-semibold transition
                      {{ App::getLocale() === 'fr'
                            ? 'bg-gray-900 text-white'
                            : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                FR
            </a>
            <a href="{{ url('/en') }}"
               class="px-5 py-2 rounded-lg text-sm font-semibold transition
                      {{ App::getLocale() === 'en'
                            ? 'bg-gray-900 text-white'
                            : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                EN
            </a>
        </div>

        {{-- Navigation traduite --}}
        <nav class="pt-4 border-t border-gray-100">
            <ul class="flex flex-wrap justify-center gap-x-6 gap-y-2 text-sm text-gray-600">
                <li>{{ __('app.nav_home') }}</li>
                <li>{{ __('app.nav_services') }}</li>
                <li>{{ __('app.nav_portfolio') }}</li>
                <li>{{ __('app.nav_invest') }}</li>
                <li>{{ __('app.nav_contact') }}</li>
            </ul>
        </nav>

        <p class="text-xs text-gray-400">
            Laravel {{ app()->version() }} · Livewire 3 · Tailwind v4 · Vite
        </p>

    </div>

</body>
</html>
