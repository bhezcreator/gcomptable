<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinancialStatement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'fiscal_period_id',
        'name',
        'type',
        'status',
    ];

    /**
     * Types d'états financiers disponibles.
     */
    public const TYPES = [
        'balance_generale',
        'grand_livre',
        'journal',
        'bilan',
        'compte_de_resultat',
        'situation_de_tresorerie',
    ];

    /**
     * Libellés lisibles des types.
     */
    public const TYPE_LABELS = [
        'balance_generale' => 'Balance générale',
        'grand_livre' => 'Grand livre',
        'journal' => 'Journal',
        'bilan' => 'Bilan',
        'compte_de_resultat' => 'Compte de résultat',
        'situation_de_tresorerie' => 'Situation de trésorerie',
    ];

    public const STATUSES = [
        'brouillon',
        'genere',
        'valide',
        'publie',
        'archive',
    ];

    public function fiscalPeriod()
    {
        return $this->belongsTo(FiscalPeriod::class);
    }

    public function lines()
    {
        return $this->hasMany(FinancialStatementLine::class)
            ->orderBy('position');
    }

    /**
     * Total général des lignes.
     */
    public function getTotalAttribute(): float
    {
        return (float) $this->lines()->sum('amount');
    }

    /**
     * Libellé du type.
     */
    public function getTypeLabelAttribute(): string
    {
        return self::TYPE_LABELS[$this->type] ?? $this->type;
    }

    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'publie');
    }
}