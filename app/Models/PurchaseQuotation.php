<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseQuotation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'purchase_request_id',
        'third_party_id',
        'reference',
        'quotation_date',
        'valid_until',
        'total_amount',
        'currency_id',
        'status',
    ];

    protected $casts = [
        'quotation_date' => 'date',
        'valid_until' => 'date',
        'total_amount' => 'decimal:2',
    ];

    public const STATUSES = [
        'recue',
        'en_evaluation',
        'retenue',
        'rejetee',
        'expiree',
    ];

    public function purchaseRequest()
    {
        return $this->belongsTo(PurchaseRequest::class);
    }

    public function thirdParty()
    {
        return $this->belongsTo(ThirdParty::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function lines()
    {
        return $this->hasMany(PurchaseQuotationLine::class);
    }
}