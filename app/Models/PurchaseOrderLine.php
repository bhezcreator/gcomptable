<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrderLine extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'purchase_order_id',
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
        static::saving(function (PurchaseOrderLine $line) {
            if ($line->quantity !== null && $line->unit_price !== null) {
                $line->total_amount = round($line->quantity * $line->unit_price, 2);
            }
        });
    }

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function goodsReceiptLines()
    {
        return $this->hasMany(GoodsReceiptLine::class);
    }

    /**
     * Quantité déjà reçue.
     */
    public function getQuantityReceivedAttribute(): float
    {
        return (float) $this->goodsReceiptLines()->sum('quantity_received');
    }

    /**
     * Quantité restante à recevoir.
     */
    public function getQuantityRemainingAttribute(): float
    {
        return (float) $this->quantity - $this->quantity_received;
    }
}