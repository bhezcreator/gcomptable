<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankReconciliation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'bank_account_id',
        'period_id',
        'statement_balance',
        'book_balance',
        'difference',
        'status',
    ];

    protected $casts = [
        'statement_balance' => 'decimal:2',
        'book_balance' => 'decimal:2',
        'difference' => 'decimal:2',
    ];

    public const STATUSES = [
        'brouillon',
        'en_cours',
        'rapproche',
        'ecart',
        'valide',
    ];

    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class);
    }

    public function period()
    {
        return $this->belongsTo(FiscalPeriod::class, 'period_id');
    }

    /**
     * Auto-calcul de la différence avant sauvegarde.
     */
    protected static function booted(): void
    {
        static::saving(function (BankReconciliation $reconciliation) {
            $reconciliation->difference = round(
                (float) $reconciliation->statement_balance - (float) $reconciliation->book_balance,
                2
            );

            // Ajuster automatiquement le statut selon la différence
            if ($reconciliation->status !== 'brouillon' && $reconciliation->difference == 0) {
                $reconciliation->status = 'rapproche';
            }
        });
    }
}