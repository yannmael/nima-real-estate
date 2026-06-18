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
        'histoire_fr',
        'histoire_en',
        'logo',
        'couleur_accent',
        'services',
        'valeurs',
        'equipe',
        'actif',
        'ordre',
    ];

    protected function casts(): array
    {
        return [
            'services' => 'array',
            'valeurs'  => 'array',
            'equipe'   => 'array',
            'actif'    => 'boolean',
        ];
    }

    // Retourne la description dans la locale active
    public function getDescriptionAttribute(): string
    {
        $locale = app()->getLocale();

        return $this->{"description_{$locale}"} ?? $this->description_fr;
    }

    // Retourne l'histoire dans la locale active
    public function getHistoireAttribute(): ?string
    {
        $locale = app()->getLocale();

        return $this->{"histoire_{$locale}"} ?? $this->histoire_fr;
    }

    // Retourne les services traduits : [["fr" => "...", "en" => "..."], ...]
    public function getServicesLocalisesAttribute(): array
    {
        $locale   = app()->getLocale();
        $services = $this->services ?? [];

        return array_map(fn ($s) => $s[$locale] ?? $s['fr'] ?? '', $services);
    }

    // Retourne les valeurs traduites : [["titre" => "...", "desc" => "..."], ...]
    public function getValeursLocalisesAttribute(): array
    {
        $locale  = app()->getLocale();
        $valeurs = $this->valeurs ?? [];

        return array_map(fn ($v) => [
            'titre' => $v["titre_{$locale}"] ?? $v['titre_fr'] ?? '',
            'desc'  => $v["desc_{$locale}"]  ?? $v['desc_fr']  ?? '',
        ], $valeurs);
    }

    // Retourne les membres d'équipe avec fonction traduite
    public function getEquipeLocaliseeAttribute(): array
    {
        $locale = app()->getLocale();
        $equipe = $this->equipe ?? [];

        return array_map(fn ($m) => [
            'nom'      => $m['nom'] ?? '',
            'fonction' => $m["fonction_{$locale}"] ?? $m['fonction_fr'] ?? '',
        ], $equipe);
    }

    public function projets(): HasMany
    {
        return $this->hasMany(Projet::class);
    }
}
