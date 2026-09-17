<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MissionExpense extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'mission_id',
        'expense_date',
        'expense_type',
        'description',
        'amount',
        'currency_id',
        'receipt_reference',
    ];

    protected $casts = [
        'expense_date' => 'date',
        'amount' => 'decimal:2',
    ];

    public const TYPES = [
        'transport',
        'hebergement',
        'restauration',
        'carburant',
        'communication',
        'frais_divers',
        'autre',
    ];

    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}