<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarVariant extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['model', 'batteries'];

    public function model()
    {
        return $this->belongsTo(CarModel::class);
    }

    public function batteries()
    {
        return $this->belongsToMany(
            Battery::class,
            'battery_compabilities',
            'variant_id',
            'battery_id'
        )->withTimestamps();
    }
}
