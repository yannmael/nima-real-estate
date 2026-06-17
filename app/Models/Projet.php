<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Projet extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre_fr',
        'titre_en',
        'slug',
        'entreprise_id',
        'typologie_fr',
        'typologie_en',
        'lieu',
        'surface',
        'annee',
        'budget_montant',
        'budget_devise',
        'image_principale',
        'galerie',
        'plans',
        'parti_pris_fr',
        'parti_pris_en',
        'statut',
        'visible',
        'ordre',
    ];

    protected function casts(): array
    {
        return [
            'galerie'        => 'array',
            'plans'          => 'array',
            'surface'        => 'decimal:2',
            'budget_montant' => 'decimal:2',
            'visible'        => 'boolean',
        ];
    }

    // Titre dans la locale active
    public function getTitreAttribute(): string
    {
        $locale = app()->getLocale();

        return $this->{"titre_{$locale}"} ?? $this->titre_fr;
    }

    // Typologie dans la locale active
    public function getTypologieAttribute(): ?string
    {
        $locale = app()->getLocale();

        return $this->{"typologie_{$locale}"} ?? $this->typologie_fr;
    }

    // Parti-pris dans la locale active
    public function getPartiPrisAttribute(): ?string
    {
        $locale = app()->getLocale();

        return $this->{"parti_pris_{$locale}"} ?? $this->parti_pris_fr;
    }

    public function entreprise(): BelongsTo
    {
        return $this->belongsTo(Entreprise::class);
    }

    public function temoignage(): HasOne
    {
        return $this->hasOne(Temoignage::class);
    }
}
