<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FundingConvention extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'funder_id',
        'project_id',
        'reference',
        'name',
        'start_date',
        'end_date',
        'initial_amount',
        'currency_id',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'initial_amount' => 'decimal:2',
    ];

    public const STATUSES = [
        'brouillon',
        'active',
        'suspendue',
        'cloturee',
        'annulee',
    ];

    public function funder()
    {
        return $this->belongsTo(Funder::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function fundingCategories()
    {
        return $this->hasMany(FundingCategory::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}