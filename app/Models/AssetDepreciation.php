<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetDepreciation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'fixed_asset_id',
        'period_id',
        'depreciation_amount',
        'accumulated_depreciation',
        'net_book_value',
    ];

    protected $casts = [
        'depreciation_amount' => 'decimal:2',
        'accumulated_depreciation' => 'decimal:2',
        'net_book_value' => 'decimal:2',
    ];

    public function fixedAsset()
    {
        return $this->belongsTo(FixedAsset::class);
    }

    public function period()
    {
        return $this->belongsTo(FiscalPeriod::class, 'period_id');
    }

    /**
     * Auto-calcul du cumul et de la VNC avant sauvegarde.
     */
    protected static function booted(): void
    {
        static::saving(function (AssetDepreciation $depreciation) {
            $asset = FixedAsset::find($depreciation->fixed_asset_id);
            if (! $asset) {
                return;
            }

            // Cumul précédent (hors la ligne courante)
            $previousAccumulated = (float) AssetDepreciation::where('fixed_asset_id', $asset->id)
                ->where('id', '!=', $depreciation->id)
                ->whereHas('period', function ($q) use ($depreciation) {
                    $q->where('end_date', '<', function ($sub) use ($depreciation) {
                        $sub->select('end_date')
                            ->from('fiscal_periods')
                            ->where('id', $depreciation->period_id);
                    });
                })
                ->sum('depreciation_amount');

            $depreciation->accumulated_depreciation = round(
                $previousAccumulated + (float) $depreciation->depreciation_amount,
                2
            );

            $depreciation->net_book_value = round(
                (float) $asset->acquisition_cost - $depreciation->accumulated_depreciation,
                2
            );
        });
    }
}