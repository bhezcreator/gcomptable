<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'program_id',
        'organization_id',
        'code',
        'name',
        'description',
        'start_date',
        'end_date',
        'project_manager_id',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public const STATUSES = [
        'planifie',
        'en_cours',
        'suspendu',
        'cloture',
        'annule',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function projectManager()
    {
        return $this->belongsTo(User::class, 'project_manager_id');
    }

    public function components()
    {
        return $this->hasMany(ProjectComponent::class);
    }

    public function activities()
    {
        return $this->hasManyThrough(Activity::class, ProjectComponent::class);
    }

    public function budgetLines()
    {
        return $this->hasMany(BudgetLine::class);
    }

    public function allocations()
    {
        return $this->hasMany(AccountingAllocation::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'en_cours');
    }
}