<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'project_id',
        'third_party_id',
        'reference',
        'request_date',
        'amount',
        'currency_id',
        'description',
        'status',
        'requested_by',
        'approved_by',
    ];

    protected $casts = [
        'request_date' => 'date',
        'amount' => 'decimal:2',
    ];

    public const STATUSES = [
        'brouillon',
        'soumise',
        'approuvee',
        'rejetee',
        'payee',
        'annulee',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function thirdParty()
    {
        return $this->belongsTo(ThirdParty::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function requester()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'soumise');
    }
}