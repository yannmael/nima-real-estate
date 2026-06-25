<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqInvestisseur extends Model
{
    protected $table = 'faqs_investisseur';

    protected $fillable = [
        'question_fr',
        'question_en',
        'reponse_fr',
        'reponse_en',
        'ordre',
        'publiee',
    ];

    protected $casts = [
        'publiee' => 'boolean',
    ];

    public function getQuestionAttribute(): string
    {
        $locale = app()->getLocale();
        return $locale === 'en' ? $this->question_en : $this->question_fr;
    }

    public function getReponseAttribute(): string
    {
        $locale = app()->getLocale();
        return $locale === 'en' ? $this->reponse_en : $this->reponse_fr;
    }

    public static function publiees(): \Illuminate\Database\Eloquent\Collection
    {
        return static::where('publiee', true)->orderBy('ordre')->get();
    }
}
