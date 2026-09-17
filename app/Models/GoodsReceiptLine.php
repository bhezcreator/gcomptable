<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodsReceiptLine extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'goods_receipt_id',
        'purchase_order_line_id',
        'quantity_received',
    ];

    protected $casts = [
        'quantity_received' => 'decimal:4',
    ];

    public function goodsReceipt()
    {
        return $this->belongsTo(GoodsReceipt::class);
    }

    public function purchaseOrderLine()
    {
        return $this->belongsTo(PurchaseOrderLine::class);
    }
}