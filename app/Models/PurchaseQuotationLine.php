<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseQuotationLine extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'purchase_quotation_id',
        'description',
        'quantity',
        'unit_price',
        'total_amount',
    ];

    protected $casts = [
        'quantity' => 'decimal:4',
        'unit_price' => 'decimal:4',
        'total_amount' => 'decimal:2',
    ];

    protected static function booted(): void
    {
        static::saving(function (PurchaseQuotationLine $line) {
            if ($line->quantity !== null && $line->unit_price !== null) {
                $line->total_amount = round($line->quantity * $line->unit_price, 2);
            }
        });
    }

    public function purchaseQuotation()
    {
        return $this->belongsTo(PurchaseQuotation::class);
    }
}