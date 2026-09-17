<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FixedAsset extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'project_id',
        'site_id',
        'asset_category_id',
        'code',
        'name',
        'acquisition_date',
        'acquisition_cost',
        'currency_id',
        'useful_life',
        'residual_value',
        'status',
    ];

    protected $casts = [
        'acquisition_date' => 'date',
        'acquisition_cost' => 'decimal:2',
        'useful_life' => 'integer',
        'residual_value' => 'decimal:2',
    ];

    public const STATUSES = [
        'brouillon',
        'en_service',
        'amorti',
        'cede',
        'reforme',
        'annule',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function category()
    {
        return $this->belongsTo(AssetCategory::class, 'asset_category_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function depreciations()
    {
        return $this->hasMany(AssetDepreciation::class);
    }

    /**
     * Base amortissable = coût d'acquisition - valeur résiduelle.
     */
    public function getDepreciableBaseAttribute(): float
    {
        return (float) $this->acquisition_cost - (float) $this->residual_value;
    }

    /**
     * Amortissement annuel (linéaire).
     */
    public function getAnnualDepreciationAttribute(): float
    {
        if ($this->useful_life <= 0) {
            return 0;
        }

        // useful_life en mois → annuel = base / (mois / 12)
        return round($this->depreciable_base / ($this->useful_life / 12), 2);
    }

    /**
     * Amortissement mensuel (linéaire).
     */
    public function getMonthlyDepreciationAttribute(): float
    {
        if ($this->useful_life <= 0) {
            return 0;
        }

        return round($this->depreciable_base / $this->useful_life, 2);
    }

    /**
     * Cumul des amortissements déjà comptabilisés.
     */
    public function getAccumulatedDepreciationAttribute(): float
    {
        return (float) $this->depreciations()->sum('depreciation_amount');
    }

    /**
     * Valeur nette comptable actuelle.
     */
    public function getNetBookValueAttribute(): float
    {
        return round((float) $this->acquisition_cost - $this->accumulated_depreciation, 2);
    }

    public function scopeInService($query)
    {
        return $query->where('status', 'en_service');
    }
}