<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'project_id',
        'requested_by',
        'reference',
        'request_date',
        'description',
        'status',
    ];

    protected $casts = [
        'request_date' => 'date',
    ];

    public const STATUSES = [
        'brouillon',
        'soumise',
        'approuvee',
        'rejetee',
        'convertie',
        'annulee',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function requester()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function lines()
    {
        return $this->hasMany(PurchaseRequestLine::class);
    }

    public function quotations()
    {
        return $this->hasMany(PurchaseQuotation::class);
    }

    public function getTotalAmountAttribute(): float
    {
        return (float) $this->lines()->sum('total_amount');
    }
}