<?php

namespace App\Services;

use App\Mail\ConfirmationNewsletterMail;
use App\Models\NewsletterSubscriber;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class NewsletterService
{
    public const STATUT_DEJA_INSCRIT          = 'deja_inscrit';
    public const STATUT_CONFIRMATION_ENVOYEE  = 'confirmation_envoyee';

    public function inscrire(string $email, ?string $prenom, string $locale): string
    {
        $subscriber = NewsletterSubscriber::where('email', $email)->first();

        if ($subscriber && $subscriber->confirme_at !== null) {
            return self::STATUT_DEJA_INSCRIT;
        }

        $token = Str::random(64);

        if ($subscriber) {
            $subscriber->update([
                'prenom' => $prenom ?: $subscriber->prenom,
                'token'  => $token,
                'locale' => $locale,
            ]);
        } else {
            $subscriber = NewsletterSubscriber::create([
                'email'  => $email,
                'prenom' => $prenom ?: null,
                'token'  => $token,
                'locale' => $locale,
            ]);
        }

        Mail::to($subscriber->email)
            ->send(new ConfirmationNewsletterMail($subscriber));

        return self::STATUT_CONFIRMATION_ENVOYEE;
    }

    public function confirmer(string $token): ?NewsletterSubscriber
    {
        $subscriber = NewsletterSubscriber::where('token', $token)
            ->whereNull('confirme_at')
            ->first();

        if ($subscriber === null) {
            return null;
        }

        $subscriber->update([
            'confirme_at' => now(),
            'token'       => null, // token consommé, on le vide
        ]);

        return $subscriber;
    }
}
