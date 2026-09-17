<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Budget extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'project_id',
        'fiscal_year_id',
        'name',
        'version',
        'status',
    ];

    protected $casts = [
        'version' => 'integer',
    ];

    public const STATUSES = [
        'brouillon',
        'soumis',
        'approuve',
        'rejete',
        'cloture',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function fiscalYear()
    {
        return $this->belongsTo(FiscalYear::class);
    }

    public function lines()
    {
        return $this->hasMany(BudgetLine::class);
    }

    /**
     * Total du budget (somme des lignes).
     */
    public function getTotalAttribute(): float
    {
        return (float) $this->lines()->sum('total_amount');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approuve');
    }
}