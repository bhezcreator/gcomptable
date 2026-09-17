<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'project_id',
        'funder_id',
        'supplier_id',
        'contract_number',
        'title',
        'contract_type',
        'start_date',
        'end_date',
        'initial_amount',
        'revised_amount',
        'currency_id',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'initial_amount' => 'decimal:2',
        'revised_amount' => 'decimal:2',
    ];

    public const TYPES = [
        'prestation_services',
        'fourniture_bien',
        'travaux',
        'consultance',
        'subvention',
        'bail',
        'autre',
    ];

    public const STATUSES = [
        'brouillon',
        'actif',
        'suspendu',
        'termine',
        'resilie',
        'annule',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function funder()
    {
        return $this->belongsTo(Funder::class);
    }

    public function supplier()
    {
        return $this->belongsTo(ThirdParty::class, 'supplier_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function amendments()
    {
        return $this->hasMany(ContractAmendment::class);
    }

    public function commitments()
    {
        return $this->hasMany(Commitment::class);
    }

    /**
     * Montant total engagé sur ce contrat.
     */
    public function getTotalCommittedAttribute(): float
    {
        return (float) $this->commitments()
            ->where('status', '!=', 'annule')
            ->sum('amount');
    }

    /**
     * Solde disponible sur le contrat.
     */
    public function getAvailableBalanceAttribute(): float
    {
        return (float) $this->revised_amount - $this->total_committed;
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'actif');
    }
}