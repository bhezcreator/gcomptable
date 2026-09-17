<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingEntry extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'journal_id',
        'fiscal_period_id',
        'entry_number',
        'entry_date',
        'reference',
        'description',
        'status',
        'created_by',
        'validated_by',
        'validated_at',
    ];

    protected $casts = [
        'entry_date' => 'date',
        'validated_at' => 'datetime',
    ];

    public function journal()
    {
        return $this->belongsTo(Journal::class);
    }

    public function fiscalPeriod()
    {
        return $this->belongsTo(FiscalPeriod::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function validator()
    {
        return $this->belongsTo(User::class, 'validated_by');
    }

    public function lines()
    {
        return $this->hasMany(AccountingEntryLine::class);
    }
}