<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commitment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'contract_id',
        'project_id',
        'budget_line_id',
        'amount',
        'commitment_date',
        'status',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'commitment_date' => 'date',
    ];

    public const STATUSES = [
        'brouillon',
        'engage',
        'partiellement_liquide',
        'liquide',
        'annule',
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function budgetLine()
    {
        return $this->belongsTo(BudgetLine::class);
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status', ['engage', 'partiellement_liquide']);
    }
}