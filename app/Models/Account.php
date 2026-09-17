<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'accounting_plan_id',
        'parent_id',
        'code',
        'name',
        'type',
        'level',
        'is_postable',
        'status',
    ];

    protected $casts = [
        'level' => 'integer',
        'is_postable' => 'boolean',
    ];

    public function accountingPlan()
    {
        return $this->belongsTo(AccountingPlan::class);
    }

    public function parent()
    {
        return $this->belongsTo(Account::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Account::class, 'parent_id');
    }

    public function entryLines()
    {
        return $this->hasMany(AccountingEntryLine::class);
    }
}