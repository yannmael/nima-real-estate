<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdmin2FA
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        // Premier usage : secret pas encore créé → page de configuration du 2FA
        if (!$user->google2fa_secret) {
            return redirect()->route('admin.2fa.setup');
        }

        // Secret présent mais 2FA non validé dans cette session navigateur
        if (!session('admin_2fa_verified')) {
            return redirect()->route('admin.2fa.challenge');
        }

        return $next($request);
    }
}
