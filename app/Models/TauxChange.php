<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TauxChange extends Model
{
    protected $table = 'taux_change';

    protected $fillable = [
        'devise',
        'taux_xaf',
        'mis_a_jour_par',
    ];

    protected function casts(): array
    {
        return [
            'taux_xaf' => 'decimal:6',
        ];
    }
}
