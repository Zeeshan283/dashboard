<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductLocations extends Model
{
    use HasFactory;
    protected $fillable = array('pro_id', 'location_id');

    public function location()
    {
        return $this->belongsTo(Locations::class, 'location_id')->select(['id', 'name','address','email']);
    }

    public function location2()
    {
        return $this->belongsTo(Locations::class, 'location_id');
    }

    public function product_shippment()
    {
        return $this->hasMany(ProductShippment::class, 'location_id');
    }
}
