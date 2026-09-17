<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'employee_number',
        'name',
        'position',
        'status',
    ];

    public const STATUSES = ['actif', 'inactif', 'suspendu', 'sorti'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function missions()
    {
        return $this->hasMany(Mission::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'actif');
    }
}