<?php

namespace App\Mail;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NouveauLeadMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public readonly Lead $lead) {}

    public function envelope(): Envelope
    {
        $qualif = $this->lead->score >= 60 ? '🔥 QUALIFIÉ' : 'Nouveau';

        return new Envelope(
            subject: "[NIMA] {$qualif} lead — {$this->lead->type_projet} · score {$this->lead->score}/100",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.nouveau-lead',
        );
    }
}
