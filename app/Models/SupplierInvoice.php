<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierInvoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'third_party_id',
        'purchase_order_id',
        'reference',
        'invoice_date',
        'due_date',
        'amount',
        'currency_id',
        'status',
    ];

    protected $casts = [
        'invoice_date' => 'date',
        'due_date' => 'date',
        'amount' => 'decimal:2',
    ];

    public const STATUSES = [
        'recue',
        'verifiee',
        'approuvee',
        'payee',
        'partiellement_payee',
        'litige',
        'annulee',
    ];

    public function thirdParty()
    {
        return $this->belongsTo(ThirdParty::class);
    }

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * Scope : factures en retard.
     */
    public function scopeOverdue($query)
    {
        return $query->where('due_date', '<', now())
                     ->whereNotIn('status', ['payee', 'annulee']);
    }
}