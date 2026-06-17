<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Temoignage extends Model
{
    use HasFactory;

    protected $fillable = [
        'auteur',
        'fonction',
        'contenu_fr',
        'contenu_en',
        'projet_id',
        'photo',
        'autorisation',
        'visible',
        'ordre',
    ];

    protected function casts(): array
    {
        return [
            'autorisation' => 'boolean',
            'visible'      => 'boolean',
        ];
    }

    // Contenu dans la locale active
    public function getContenuAttribute(): string
    {
        $locale = app()->getLocale();

        return $this->{"contenu_{$locale}"} ?? $this->contenu_fr;
    }

    public function projet(): BelongsTo
    {
        return $this->belongsTo(Projet::class);
    }
}
