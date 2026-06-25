<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsletterSubscriber extends Model
{
    protected $fillable = [
        'email',
        'prenom',
        'token',
        'confirme_at',
        'locale',
        'desabonne_at',
    ];

    protected function casts(): array
    {
        return [
            'confirme_at'   => 'datetime',
            'desabonne_at'  => 'datetime',
        ];
    }

    public function getEstConfirmeAttribute(): bool
    {
        return $this->confirme_at !== null;
    }

    public function getEstActifAttribute(): bool
    {
        return $this->confirme_at !== null && $this->desabonne_at === null;
    }
}
