<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mission extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'employee_id',
        'project_id',
        'reference',
        'destination',
        'purpose',
        'start_date',
        'end_date',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public const STATUSES = [
        'brouillon',
        'soumise',
        'approuvee',
        'en_cours',
        'terminee',
        'annulee',
        'cloturee',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function advances()
    {
        return $this->hasMany(MissionAdvance::class);
    }

    public function expenses()
    {
        return $this->hasMany(MissionExpense::class);
    }

    public function settlements()
    {
        return $this->hasMany(MissionSettlement::class);
    }

    /**
     * Durée de la mission en jours.
     */
    public function getDurationInDaysAttribute(): int
    {
        return $this->start_date->diffInDays($this->end_date) + 1;
    }

    /**
     * Total des avances reçues.
     */
    public function getTotalAdvancesAttribute(): float
    {
        return (float) $this->advances()
            ->where('status', 'approuvee')
            ->sum('amount');
    }

    /**
     * Total des dépenses engagées.
     */
    public function getTotalExpensesAttribute(): float
    {
        return (float) $this->expenses()->sum('amount');
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status', ['approuvee', 'en_cours']);
    }
}