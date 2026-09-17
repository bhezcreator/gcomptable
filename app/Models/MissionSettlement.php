<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MissionSettlement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'mission_id',
        'advance_amount',
        'total_expenses',
        'amount_to_return',
        'additional_amount',
        'settlement_date',
        'status',
    ];

    protected $casts = [
        'advance_amount' => 'decimal:2',
        'total_expenses' => 'decimal:2',
        'amount_to_return' => 'decimal:2',
        'additional_amount' => 'decimal:2',
        'settlement_date' => 'date',
    ];

    public const STATUSES = [
        'brouillon',
        'soumis',
        'valide',
        'rejete',
        'cloture',
    ];

    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }

    /**
     * Auto-calcul des montants avant sauvegarde.
     */
    protected static function booted(): void
    {
        static::saving(function (MissionSettlement $settlement) {
            $balance = (float) $settlement->advance_amount - (float) $settlement->total_expenses;

            if ($balance > 0) {
                // L'employé doit rembourser le trop-perçu
                $settlement->amount_to_return = round($balance, 2);
                $settlement->additional_amount = 0;
            } elseif ($balance < 0) {
                // L'organisation doit rembourser l'employé
                $settlement->amount_to_return = 0;
                $settlement->additional_amount = round(abs($balance), 2);
            } else {
                // Équilibre parfait
                $settlement->amount_to_return = 0;
                $settlement->additional_amount = 0;
            }
        });
    }
}