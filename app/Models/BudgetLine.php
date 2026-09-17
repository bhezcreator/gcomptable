<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BudgetLine extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'budget_id',
        'activity_id',
        'account_id',
        'site_id',
        'funder_id',
        'funding_category_id',
        'description',
        'quantity',
        'unit_cost',
        'total_amount',
    ];

    protected $casts = [
        'quantity' => 'decimal:4',
        'unit_cost' => 'decimal:4',
        'total_amount' => 'decimal:2',
    ];

    /**
     * Auto-calcul du total_amount avant sauvegarde.
     */
    protected static function booted(): void
    {
        static::saving(function (BudgetLine $line) {
            if ($line->quantity !== null && $line->unit_cost !== null) {
                $line->total_amount = round($line->quantity * $line->unit_cost, 2);
            }
        });
    }

    public function budget()
    {
        return $this->belongsTo(Budget::class);
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function funder()
    {
        return $this->belongsTo(Funder::class);
    }

    public function fundingCategory()
    {
        return $this->belongsTo(FundingCategory::class);
    }

    public function periodAllocations()
    {
        return $this->hasMany(BudgetAllocation::class);
    }
}