<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FundingCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'funding_convention_id',
        'code',
        'name',
        'budget_amount',
    ];

    protected $casts = [
        'budget_amount' => 'decimal:2',
    ];

    public function fundingConvention()
    {
        return $this->belongsTo(FundingConvention::class);
    }

    public function allocations()
    {
        return $this->hasMany(AccountingAllocation::class);
    }
}