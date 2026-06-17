<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Entreprise extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'slug',
        'description_fr',
        'description_en',
        'logo',
        'couleur_accent',
        'services',
        'actif',
        'ordre',
    ];

    protected function casts(): array
    {
        return [
            'services' => 'array',
            'actif'    => 'boolean',
        ];
    }

    // Retourne la description dans la locale active
    public function getDescriptionAttribute(): string
    {
        $locale = app()->getLocale();

        return $this->{"description_{$locale}"} ?? $this->description_fr;
    }

    // Retourne les services traduits : [["fr" => "...", "en" => "..."], ...]
    public function getServicesLocalisesAttribute(): array
    {
        $locale   = app()->getLocale();
        $services = $this->services ?? [];

        return array_map(fn ($s) => $s[$locale] ?? $s['fr'] ?? '', $services);
    }

    public function projets(): HasMany
    {
        return $this->hasMany(Projet::class);
    }
}
