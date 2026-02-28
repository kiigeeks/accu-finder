<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Battery extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // protected $with = ['variants'];

    public function variants()
    {
        return $this->belongsToMany(
            CarVariant::class,
            'battery_compabilities',
            'battery_id',
            'variant_id'
        )->withTimestamps();
    }
}
