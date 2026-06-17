<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre_fr',
        'titre_en',
        'slug_fr',
        'slug_en',
        'contenu_fr',
        'contenu_en',
        'image_couverture',
        'categories',
        'tags',
        'meta_titre_fr',
        'meta_titre_en',
        'meta_description_fr',
        'meta_description_en',
        'statut',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'categories'   => 'array',
            'tags'         => 'array',
            'published_at' => 'datetime',
        ];
    }

    // Titre dans la locale active
    public function getTitreAttribute(): string
    {
        $locale = app()->getLocale();

        return $this->{"titre_{$locale}"} ?? $this->titre_fr;
    }

    // Slug dans la locale active (pour construire les URLs)
    public function getSlugAttribute(): string
    {
        $locale = app()->getLocale();

        return $this->{"slug_{$locale}"} ?? $this->slug_fr;
    }

    // Contenu dans la locale active
    public function getContenuAttribute(): ?string
    {
        $locale = app()->getLocale();

        return $this->{"contenu_{$locale}"} ?? $this->contenu_fr;
    }

    // Meta-titre dans la locale active
    public function getMetaTitreAttribute(): ?string
    {
        $locale = app()->getLocale();

        return $this->{"meta_titre_{$locale}"} ?? $this->meta_titre_fr;
    }

    // Meta-description dans la locale active
    public function getMetaDescriptionAttribute(): ?string
    {
        $locale = app()->getLocale();

        return $this->{"meta_description_{$locale}"} ?? $this->meta_description_fr;
    }

    public function scopePublie($query)
    {
        return $query->where('statut', 'publie')->whereNotNull('published_at');
    }
}
