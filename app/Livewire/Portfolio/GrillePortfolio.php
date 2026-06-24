<?php

namespace App\Livewire\Portfolio;

use App\Models\Entreprise;
use App\Models\Projet;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class GrillePortfolio extends Component
{
    use WithPagination;

    // Chaque propriété est synchronisée avec l'URL (?entite=, ?typo=, etc.)
    // except: '' — le paramètre n'apparaît pas dans l'URL quand le filtre est vide
    #[Url(as: 'entite', except: '')]
    public string $entrepriseSlug = '';

    #[Url(as: 'typo', except: '')]
    public string $typologieFr = '';

    #[Url(as: 'lieu', except: '')]
    public string $lieu = '';

    #[Url(as: 'surface', except: '')]
    public string $superficie = '';

    #[Url(as: 'annee', except: '')]
    public string $annee = '';

    // Réinitialise la pagination à chaque changement de filtre
    public function updatedEntrepriseSlug(): void { $this->resetPage(); }
    public function updatedTypologieFr(): void    { $this->resetPage(); }
    public function updatedLieu(): void           { $this->resetPage(); }
    public function updatedSuperficie(): void     { $this->resetPage(); }
    public function updatedAnnee(): void          { $this->resetPage(); }

    public function reinitialiser(): void
    {
        $this->reset(['entrepriseSlug', 'typologieFr', 'lieu', 'superficie', 'annee']);
        $this->resetPage();
    }

    #[Computed]
    public function aucunFiltre(): bool
    {
        return $this->entrepriseSlug === ''
            && $this->typologieFr === ''
            && $this->lieu === ''
            && $this->superficie === ''
            && $this->annee === '';
    }

    public function render(): \Illuminate\View\View
    {
        $locale = app()->getLocale();

        $query = Projet::query()
            ->where('visible', true)
            ->with('entreprise')
            ->orderBy('ordre')
            ->orderByDesc('annee');

        if ($this->entrepriseSlug !== '') {
            $query->whereHas(
                'entreprise',
                fn ($q) => $q->where('slug', $this->entrepriseSlug)
            );
        }

        if ($this->typologieFr !== '') {
            $query->where('typologie_fr', $this->typologieFr);
        }

        if ($this->lieu !== '') {
            $query->where('lieu', $this->lieu);
        }

        if ($this->superficie !== '') {
            [$min, $max] = $this->plagesSurface()[$this->superficie] ?? [null, null];
            if ($min !== null) {
                $query->where('surface', '>=', $min);
            }
            if ($max !== null) {
                $query->where('surface', '<', $max);
            }
        }

        if ($this->annee !== '') {
            $query->where('annee', (int) $this->annee);
        }

        return view('livewire.portfolio.grille-portfolio', [
            'projets'     => $query->paginate(9),
            'typologies'  => $this->typologiesDisponibles($locale),
            'lieux'       => $this->lieuxDisponibles(),
            'annees'      => $this->anneesDisponibles(),
            'entreprises' => Entreprise::where('actif', true)->orderBy('ordre')->get(['id', 'nom', 'slug']),
            'locale'      => $locale,
        ]);
    }

    // Retourne les paires (typologie_fr, typologie_locale) distinctes pour le select
    private function typologiesDisponibles(string $locale): \Illuminate\Support\Collection
    {
        return Projet::where('visible', true)
            ->whereNotNull('typologie_fr')
            ->select('typologie_fr', 'typologie_en')
            ->distinct()
            ->get()
            ->sortBy("typologie_{$locale}")
            ->values();
    }

    private function lieuxDisponibles(): array
    {
        return Projet::where('visible', true)
            ->whereNotNull('lieu')
            ->distinct()
            ->orderBy('lieu')
            ->pluck('lieu')
            ->toArray();
    }

    private function anneesDisponibles(): array
    {
        return Projet::where('visible', true)
            ->whereNotNull('annee')
            ->distinct()
            ->orderByDesc('annee')
            ->pluck('annee')
            ->toArray();
    }

    // Plages de surface : clé → [min, max] en m² (null = pas de borne)
    private function plagesSurface(): array
    {
        return [
            'xs' => [null, 100],
            'sm' => [100,  500],
            'md' => [500,  1500],
            'lg' => [1500, null],
        ];
    }
}
