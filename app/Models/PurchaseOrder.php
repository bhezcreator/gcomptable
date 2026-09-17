<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'third_party_id',
        'project_id',
        'purchase_request_id',
        'reference',
        'order_date',
        'currency_id',
        'total_amount',
        'status',
    ];

    protected $casts = [
        'order_date' => 'date',
        'total_amount' => 'decimal:2',
    ];

    public const STATUSES = [
        'brouillon',
        'envoye',
        'confirme',
        'partiellement_recu',
        'recu',
        'annule',
        'cloture',
    ];

    public function thirdParty()
    {
        return $this->belongsTo(ThirdParty::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function purchaseRequest()
    {
        return $this->belongsTo(PurchaseRequest::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function lines()
    {
        return $this->hasMany(PurchaseOrderLine::class);
    }

    public function goodsReceipts()
    {
        return $this->hasMany(GoodsReceipt::class);
    }

    public function supplierInvoices()
    {
        return $this->hasMany(SupplierInvoice::class);
    }
}