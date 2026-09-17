<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContractAmendment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'contract_id',
        'reference',
        'date',
        'description',
        'amount_change',
        'new_amount',
    ];

    protected $casts = [
        'date' => 'date',
        'amount_change' => 'decimal:2',
        'new_amount' => 'decimal:2',
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    /**
     * Auto-calcul du nouveau montant à partir du contrat.
     */
    protected static function booted(): void
    {
        static::saving(function (ContractAmendment $amendment) {
            if ($amendment->contract_id) {
                $contract = Contract::find($amendment->contract_id);
                if ($contract) {
                    $amendment->new_amount = round(
                        (float) $contract->revised_amount + (float) $amendment->amount_change,
                        2
                    );
                }
            }
        });

        static::saved(function (ContractAmendment $amendment) {
            // Mettre à jour le montant révisé du contrat
            $contract = $amendment->contract;
            if ($contract) {
                $contract->revised_amount = $amendment->new_amount;
                $contract->saveQuietly();
            }
        });
    }
}