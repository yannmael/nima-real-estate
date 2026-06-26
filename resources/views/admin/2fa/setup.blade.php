@extends('admin.layout')
@section('title', 'Configuration 2FA')

@section('content')
<div class="w-full max-w-md">

    <div class="text-center mb-8">
        <h1 class="text-xl font-bold text-primary">Authentification à deux facteurs</h1>
        <p class="text-sm text-gray-500 mt-2">
            Scannez ce QR code avec <strong>Google Authenticator</strong>,
            <strong>Authy</strong> ou toute application TOTP.
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">

        {{-- QR code SVG centré --}}
        <div class="flex justify-center mb-6">
            <div class="p-3 bg-white border-2 border-gray-100 rounded-xl inline-block">
                {!! $qrCodeSvg !!}
            </div>
        </div>

        {{-- Clé manuelle --}}
        <div class="bg-gray-50 rounded-lg p-3 text-center mb-6">
            <p class="text-[10px] text-gray-400 uppercase tracking-widest mb-1">Clé manuelle</p>
            <code class="text-xs font-mono text-gray-700 break-all">{{ $secret }}</code>
        </div>

        {{-- Formulaire de validation --}}
        <form method="POST" action="{{ route('admin.2fa.confirm') }}" class="space-y-4">
            @csrf

            <div>
                <label for="code" class="block text-xs font-semibold text-gray-700 mb-1.5">
                    Code à 6 chiffres (confirme la configuration)
                </label>
                <input type="text" id="code" name="code"
                       inputmode="numeric" maxlength="6" autocomplete="one-time-code"
                       placeholder="000000"
                       class="w-full rounded-lg border border-gray-200 px-3.5 py-2.5 text-sm
                              text-center tracking-widest font-mono
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
                Activer le 2FA
            </button>
        </form>

    </div>
</div>
@endsection
