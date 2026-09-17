<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MissionAdvance extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'mission_id',
        'amount',
        'currency_id',
        'request_date',
        'approved_by',
        'approved_at',
        'status',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'request_date' => 'date',
        'approved_at' => 'datetime',
    ];

    public const STATUSES = [
        'brouillon',
        'soumise',
        'approuvee',
        'rejetee',
        'payee',
        'annulee',
    ];

    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approuvee');
    }
}