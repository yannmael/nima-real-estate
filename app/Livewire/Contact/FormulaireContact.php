<?php

namespace App\Livewire\Contact;

use App\Services\LeadService;
use Livewire\Attributes\Computed;
use Livewire\Component;

class FormulaireContact extends Component
{
    public string $prenom       = '';
    public string $nom_contact  = '';
    public string $email        = '';
    public string $telephone    = '';
    public string $type_projet  = '';
    public string $surface      = '';
    public string $budget       = '';
    public string $lieu         = '';
    public string $message      = '';
    public bool   $envoye       = false;

    /** Remet à zéro les champs conditionnels quand le type change. */
    public function updatedTypeProjet(): void
    {
        if (!$this->afficherSurface) {
            $this->surface = '';
        }
        if (!$this->afficherBudget) {
            $this->budget = '';
        }
    }

    #[Computed]
    public function afficherSurface(): bool
    {
        return in_array($this->type_projet, ['achat', 'location', 'investissement', 'construction'], true);
    }

    #[Computed]
    public function afficherBudget(): bool
    {
        return in_array($this->type_projet, ['achat', 'investissement'], true);
    }

    public function soumettre(LeadService $leadService): void
    {
        $donnees = $this->validate($this->regles(), $this->messages());

        $leadService->enregistrer(array_merge($donnees, [
            'source' => 'formulaire_contact',
            'locale' => app()->getLocale(),
        ]));

        $this->envoye = true;
    }

    public function recommencer(): void
    {
        $this->reset();
        $this->envoye = false;
    }

    private function regles(): array
    {
        return [
            'prenom'      => ['required', 'string', 'max:100'],
            'nom_contact' => ['required', 'string', 'max:100'],
            'email'       => ['required', 'email:rfc,dns', 'max:255'],
            'telephone'   => ['nullable', 'string', 'max:25'],
            'type_projet' => ['required', 'in:achat,location,investissement,construction,conseil,autre'],
            'surface'     => $this->afficherSurface
                ? ['required', 'integer', 'min:10', 'max:100000']
                : ['nullable'],
            'budget'      => $this->afficherBudget
                ? ['required', 'string', 'max:200']
                : ['nullable'],
            'lieu'        => ['nullable', 'string', 'max:100'],
            'message'     => ['required', 'string', 'min:10', 'max:2000'],
        ];
    }

    private function messages(): array
    {
        $locale = app()->getLocale();
        if ($locale === 'fr') {
            return [
                'prenom.required'      => 'Le prénom est obligatoire.',
                'nom_contact.required' => 'Le nom est obligatoire.',
                'email.required'       => 'L\'adresse e-mail est obligatoire.',
                'email.email'          => 'L\'adresse e-mail n\'est pas valide.',
                'type_projet.required' => 'Veuillez sélectionner un type de projet.',
                'surface.required'     => 'La surface est obligatoire pour ce type de projet.',
                'surface.integer'      => 'La surface doit être un nombre entier en m².',
                'surface.min'          => 'La surface minimale est de 10 m².',
                'budget.required'      => 'Le budget est obligatoire pour ce type de projet.',
                'message.required'     => 'Le message est obligatoire.',
                'message.min'          => 'Le message doit comporter au moins 10 caractères.',
            ];
        }

        return [
            'prenom.required'      => 'First name is required.',
            'nom_contact.required' => 'Last name is required.',
            'email.required'       => 'Email address is required.',
            'email.email'          => 'Please enter a valid email address.',
            'type_projet.required' => 'Please select a project type.',
            'surface.required'     => 'Area is required for this project type.',
            'surface.integer'      => 'Area must be a whole number in m².',
            'surface.min'          => 'Minimum area is 10 m².',
            'budget.required'      => 'Budget is required for this project type.',
            'message.required'     => 'Message is required.',
            'message.min'          => 'Message must be at least 10 characters.',
        ];
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.contact.formulaire-contact');
    }
}
