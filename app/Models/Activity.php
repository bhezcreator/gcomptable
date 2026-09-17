<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'component_id',
        'code',
        'name',
        'description',
        'status',
    ];

    public const STATUSES = [
        'planifie',
        'en_cours',
        'termine',
        'annule',
    ];

    public function component()
    {
        return $this->belongsTo(ProjectComponent::class, 'component_id');
    }

    public function project()
    {
        return $this->hasOneThrough(
            Project::class,
            ProjectComponent::class,
            'id',              // FK sur project_components (clé locale de la table intermédiaire)
            'id',              // FK sur projects
            'component_id',    // clé locale sur activities
            'project_id'       // clé sur project_components pointant vers projects
        );
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