<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingEntryLine extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'accounting_entry_id',
        'account_id',
        'third_party_id',
        'debit',
        'credit',
        'currency_id',
        'exchange_rate',
        'amount_foreign',
        'description',
    ];

    protected $casts = [
        'debit' => 'decimal:2',
        'credit' => 'decimal:2',
        'exchange_rate' => 'decimal:6',
        'amount_foreign' => 'decimal:2',
    ];

    public function accountingEntry()
    {
        return $this->belongsTo(AccountingEntry::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function thirdParty()
    {
        return $this->belongsTo(ThirdParty::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function allocations()
    {
        return $this->hasMany(AccountingAllocation::class, 'entry_line_id');
    }
}