<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinancialStatementLine extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'financial_statement_id',
        'account_id',
        'label',
        'amount',
        'position',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'position' => 'integer',
    ];

    public function financialStatement()
    {
        return $this->belongsTo(FinancialStatement::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('position');
    }
}