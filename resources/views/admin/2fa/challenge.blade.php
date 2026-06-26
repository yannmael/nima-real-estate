@extends('admin.layout')
@section('title', 'Vérification 2FA')

@section('content')
<div class="w-full max-w-sm">

    <div class="text-center mb-8">
        <div class="w-12 h-12 rounded-xl bg-primary flex items-center justify-center mx-auto mb-4">
            <svg class="w-6 h-6 text-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
        </div>
        <h1 class="text-xl font-bold text-primary">Vérification 2FA</h1>
        <p class="text-xs text-gray-500 mt-1">Entrez le code affiché dans votre application TOTP</p>
    </div>

    <form method="POST" action="{{ route('admin.2fa.challenge') }}"
          class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 space-y-5">
        @csrf

        <div>
            <label for="code" class="block text-xs font-semibold text-gray-700 mb-1.5">
                Code à 6 chiffres
            </label>
            <input type="text" id="code" name="code"
                   inputmode="numeric" maxlength="6" autocomplete="one-time-code"
                   placeholder="000000" autofocus
                   class="w-full rounded-lg border border-gray-200 px-3.5 py-2.5 text-sm
                          text-center tracking-widest font-mono text-lg
                          focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent
                          @error('code') border-red-400 @enderror">
            @error('code')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="w-full bg-primary text-white rounded-lg py-2.5 text-sm font-semibold
                       hover:bg-primary-800 transition-colors focus:outline-none
                       focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2">
            Vérifier
        </button>

        <div class="text-center">
            <a href="{{ route('admin.logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="text-xs text-gray-400 hover:text-gray-600 transition-colors">
                Se déconnecter
            </a>
        </div>
    </form>

    <form id="logout-form" method="POST" action="{{ route('admin.logout') }}" class="hidden">
        @csrf
    </form>

</div>
@endsection
