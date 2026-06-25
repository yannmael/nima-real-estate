<?php

namespace App\Services;

use App\Mail\NouveauLeadMail;
use App\Models\Lead;
use Illuminate\Support\Facades\Mail;

class LeadService
{
    public function enregistrer(array $donnees): Lead
    {
        $donnees = $this->sanitiser($donnees);
        $donnees['score'] = $this->calculerScore($donnees);

        $lead = Lead::create($donnees);

        Mail::to(config('nima.contact.email'))
            ->send(new NouveauLeadMail($lead));

        return $lead;
    }

    /**
     * Score sur 100 — critères de qualification du prospect.
     * Seuil "qualifié" : ≥ 60 (voir Lead::getEstQualifieAttribute).
     */
    private function calculerScore(array $d): int
    {
        $score = 0;

        if (!empty($d['email']))       $score += 25; // canal de réponse garanti
        if (!empty($d['telephone']))   $score += 10;
        if (!empty($d['type_projet'])) $score += 15; // intention explicite
        if (!empty($d['budget']))      $score += 20; // capacité financière
        if (!empty($d['surface']))     $score += 10; // projet dimensionné
        if (!empty($d['lieu']))        $score += 10; // localisation précisée
        if (!empty($d['message']) && mb_strlen($d['message']) >= 50) $score += 10;

        return min($score, 100);
    }

    private function sanitiser(array $donnees): array
    {
        $vide = static fn ($v) => $v === '' || $v === null;

        $donnees['surface']   = !$vide($donnees['surface'] ?? null)   ? (int) $donnees['surface'] : null;
        $donnees['budget']    = !$vide($donnees['budget'] ?? null)    ? trim($donnees['budget'])  : null;
        $donnees['lieu']      = !$vide($donnees['lieu'] ?? null)      ? trim($donnees['lieu'])    : null;
        $donnees['telephone'] = !$vide($donnees['telephone'] ?? null) ? trim($donnees['telephone']) : null;

        return $donnees;
    }
}
