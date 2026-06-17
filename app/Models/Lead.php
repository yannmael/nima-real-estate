<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'prenom',
        'nom_contact',
        'email',
        'telephone',
        'type_projet',
        'surface',
        'budget',
        'lieu',
        'message',
        'source',
        'score',
        'locale',
    ];

    protected function casts(): array
    {
        return [
            'surface' => 'integer',
            'score'   => 'integer',
        ];
    }

    // Nom complet affiché
    public function getNomCompletAttribute(): string
    {
        return trim("{$this->prenom} {$this->nom_contact}");
    }

    // Qualifié si score ≥ 60
    public function getEstQualifieAttribute(): bool
    {
        return $this->score >= 60;
    }
}
