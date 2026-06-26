@extends('admin.layout')
@section('title', 'Connexion admin')

@section('content')
<div class="w-full max-w-sm">

    <div class="text-center mb-8">
        <div class="w-12 h-12 rounded-xl bg-primary flex items-center justify-center mx-auto mb-4">
            <svg class="w-6 h-6 text-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
        </div>
        <h1 class="text-xl font-bold text-primary">Espace administration</h1>
        <p class="text-xs text-gray-500 mt-1">NIMA SARL — Accès restreint</p>
    </div>

    <form method="POST" action="{{ route('admin.login') }}"
          class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-xs font-semibold text-gray-700 mb-1.5">
                Adresse e-mail
            </label>
            <input type="email" id="email" name="email"
                   value="{{ old('email') }}"
                   required autocomplete="email"
                   class="w-full rounded-lg border border-gray-200 px-3.5 py-2.5 text-sm
                          focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent
                          @error('email') border-red-400 @enderror">
            @error('email')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-xs font-semibold text-gray-700 mb-1.5">
                Mot de passe
            </label>
            <input type="password" id="password" name="password"
                   required autocomplete="current-password"
                   class="w-full rounded-lg border border-gray-200 px-3.5 py-2.5 text-sm
                          focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent
                          @error('password') border-red-400 @enderror">
            @error('password')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="w-full bg-primary text-white rounded-lg py-2.5 text-sm font-semibold
                       hover:bg-primary-800 transition-colors focus:outline-none
                       focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2">
            Connexion
        </button>
    </form>

</div>
@endsection
