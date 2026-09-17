<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'description',
        'status',
    ];

    public const STATUSES = ['actif', 'inactif'];

    public function fixedAssets()
    {
        return $this->hasMany(FixedAsset::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'actif');
    }
}