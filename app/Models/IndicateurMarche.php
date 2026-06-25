<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndicateurMarche extends Model
{
    protected $table = 'indicateurs_marche';

    protected $fillable = [
        'cle',
        'libelle_fr',
        'libelle_en',
        'valeur',
        'unite_fr',
        'unite_en',
        'source_attendue',
        'categorie',
        'ordre',
    ];

    // Libellé localisé selon la locale active
    public function getLibelleAttribute(): string
    {
        $locale = app()->getLocale();
        return $locale === 'en' ? $this->libelle_en : $this->libelle_fr;
    }

    // Unité localisée
    public function getUniteAttribute(): ?string
    {
        $locale = app()->getLocale();
        $unite  = $locale === 'en' ? $this->unite_en : $this->unite_fr;
        return $unite ?: null;
    }

    // Indique si la valeur est encore un placeholder non saisi
    public function getEstPlaceholderAttribute(): bool
    {
        return str_starts_with($this->valeur, '[À SOURCER]') || $this->valeur === '';
    }

    // Retourne une collection indexée par clé pour accès rapide en vue
    public static function parCle(): \Illuminate\Support\Collection
    {
        return static::all()->keyBy('cle');
    }

    // Retourne les indicateurs d'une catégorie, triés par ordre
    public static function deCategorie(string $categorie): \Illuminate\Database\Eloquent\Collection
    {
        return static::where('categorie', $categorie)->orderBy('ordre')->get();
    }
}
