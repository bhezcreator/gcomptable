<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodsReceipt extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'purchase_order_id',
        'reference',
        'receipt_date',
        'received_by',
        'status',
    ];

    protected $casts = [
        'receipt_date' => 'date',
    ];

    public const STATUSES = ['brouillon', 'valide', 'annule'];

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'received_by');
    }

    public function lines()
    {
        return $this->hasMany(GoodsReceiptLine::class);
    }
}