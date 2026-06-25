<?php

namespace App\Livewire\Contact;

use App\Services\NewsletterService;
use Livewire\Component;

class FormNewsletter extends Component
{
    public string $email   = '';
    public string $prenom  = '';
    public string $statut  = ''; // '' | 'confirmation_envoyee' | 'deja_inscrit'

    public function inscrire(NewsletterService $service): void
    {
        $this->validate([
            'email'  => ['required', 'email:rfc', 'max:255'],
            'prenom' => ['nullable', 'string', 'max:100'],
        ], [
            'email.required' => app()->getLocale() === 'fr'
                ? 'L\'adresse e-mail est obligatoire.'
                : 'Email address is required.',
            'email.email' => app()->getLocale() === 'fr'
                ? 'L\'adresse e-mail n\'est pas valide.'
                : 'Please enter a valid email address.',
        ]);

        $this->statut = $service->inscrire(
            email:  $this->email,
            prenom: $this->prenom ?: null,
            locale: app()->getLocale(),
        );
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.contact.form-newsletter');
    }
}
