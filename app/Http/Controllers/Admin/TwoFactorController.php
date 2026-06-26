<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use PragmaRX\Google2FA\Google2FA;

class TwoFactorController extends Controller
{
    public function showSetup()
    {
        $user = auth()->user();

        if ($user->google2fa_secret && session('admin_2fa_verified')) {
            return redirect()->route('admin.dashboard');
        }

        // Génère un secret temporaire en session lors du premier setup
        if (!$user->google2fa_secret && !session('temp_2fa_secret')) {
            session(['temp_2fa_secret' => (new Google2FA())->generateSecretKey()]);
        }

        $secret = session('temp_2fa_secret') ?? $user->google2fa_secret;

        $qrUrl = (new Google2FA())->getQRCodeUrl(config('app.name'), $user->email, $secret);

        $renderer   = new ImageRenderer(new RendererStyle(200), new SvgImageBackEnd());
        $qrCodeSvg  = (new Writer($renderer))->writeString($qrUrl);

        return view('admin.2fa.setup', compact('qrCodeSvg', 'secret'));
    }

    public function confirmSetup(Request $request)
    {
        $request->validate(['code' => ['required', 'digits:6']]);

        $user   = auth()->user();
        $secret = session('temp_2fa_secret') ?? $user->google2fa_secret;

        if (!(new Google2FA())->verifyKey($secret, $request->code)) {
            throw ValidationException::withMessages([
                'code' => 'Code invalide. Vérifiez l\'heure de votre téléphone et réessayez.',
            ]);
        }

        $user->update([
            'google2fa_secret'       => $secret,
            'two_factor_confirmed_at' => now(),
        ]);

        session()->forget('temp_2fa_secret');
        session(['admin_2fa_verified' => true]);

        return redirect()->route('admin.dashboard');
    }

    public function showChallenge()
    {
        if (session('admin_2fa_verified')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.2fa.challenge');
    }

    public function challenge(Request $request)
    {
        $request->validate(['code' => ['required', 'digits:6']]);

        $key = 'admin-2fa:' . auth()->id();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            throw ValidationException::withMessages([
                'code' => 'Trop de tentatives. Attendez 1 minute.',
            ]);
        }

        if (!(new Google2FA())->verifyKey(auth()->user()->google2fa_secret, $request->code)) {
            RateLimiter::hit($key, 60);
            throw ValidationException::withMessages([
                'code' => 'Code incorrect.',
            ]);
        }

        RateLimiter::clear($key);
        session(['admin_2fa_verified' => true]);

        return redirect()->route('admin.dashboard');
    }
}
