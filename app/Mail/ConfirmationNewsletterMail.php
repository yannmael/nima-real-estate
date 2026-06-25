<?php

namespace App\Mail;

use App\Models\NewsletterSubscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmationNewsletterMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public readonly NewsletterSubscriber $subscriber) {}

    public function envelope(): Envelope
    {
        $sujet = $this->subscriber->locale === 'fr'
            ? 'Confirmez votre inscription à la newsletter NIMA'
            : 'Confirm your NIMA newsletter subscription';

        return new Envelope(subject: $sujet);
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.confirmation-newsletter',
        );
    }
}
