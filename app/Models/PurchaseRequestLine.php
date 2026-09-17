<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseRequestLine extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'purchase_request_id',
        'description',
        'quantity',
        'unit_cost',
        'total_amount',
    ];

    protected $casts = [
        'quantity' => 'decimal:4',
        'unit_cost' => 'decimal:4',
        'total_amount' => 'decimal:2',
    ];

    protected static function booted(): void
    {
        static::saving(function (PurchaseRequestLine $line) {
            if ($line->quantity !== null && $line->unit_cost !== null) {
                $line->total_amount = round($line->quantity * $line->unit_cost, 2);
            }
        });
    }

    public function purchaseRequest()
    {
        return $this->belongsTo(PurchaseRequest::class);
    }
}