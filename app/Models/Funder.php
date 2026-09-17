<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Funder extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'type',
        'contact',
        'status',
    ];

    public const TYPES = [
        'bilateral',
        'multilateral',
        'ong',
        'prive',
        'public',
        'autre',
    ];

    public const STATUSES = ['actif', 'inactif'];

    public function fundingConventions()
    {
        return $this->hasMany(FundingConvention::class);
    }

    public function allocations()
    {
        return $this->hasMany(AccountingAllocation::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'actif');
    }
}