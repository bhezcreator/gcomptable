<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ThirdParty extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'third_parties';

    protected $fillable = [
        'type',
        'code',
        'name',
        'tax_number',
        'address',
        'phone',
        'email',
        'bank_name',
        'bank_account',
        'currency_id',
        'status',
    ];

    /**
     * Types de tiers disponibles.
     */
    public const TYPES = [
        'fournisseur',
        'consultant',
        'client',
        'employé',
        'partenaire',
        'autre',
    ];

    /**
     * Statuts disponibles.
     */
    public const STATUSES = [
        'actif',
        'inactif',
    ];

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function entryLines()
    {
        return $this->hasMany(AccountingEntryLine::class, 'third_party_id');
    }

    /**
     * Scope : tiers actifs uniquement.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'actif');
    }

    /**
     * Scope : filtrer par type.
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }
}