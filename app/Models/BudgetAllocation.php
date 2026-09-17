<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BudgetAllocation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'budget_line_id',
        'period_id',
        'amount',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function budgetLine()
    {
        return $this->belongsTo(BudgetLine::class);
    }

    public function period()
    {
        return $this->belongsTo(FiscalPeriod::class, 'period_id');
    }
}