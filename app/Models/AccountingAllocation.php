<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingAllocation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'entry_line_id',
        'project_id',
        'activity_id',
        'site_id',
        'funder_id',
        'funding_category_id',
        'budget_line_id',
        'amount',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function entryLine()
    {
        return $this->belongsTo(AccountingEntryLine::class, 'entry_line_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
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

    public function budgetLine()
    {
        return $this->belongsTo(BudgetLine::class);
    }
}