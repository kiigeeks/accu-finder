<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['brand'];

    public function brand()
    {
        return $this->belongsTo(CarBrand::class);
    }
    
    public function variants()
    {
        return $this->hasMany(CarVariant::class, 'model_id');
    }

}
