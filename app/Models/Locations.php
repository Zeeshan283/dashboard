<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    use HasFactory;
    protected $fillable = array('name', 'phoneno', 'email', 'address', 'company', 'google_link', 'for_about');

    public function product_shippment()
    {
        return $this->hasOne(ProductShippment::class,'location_id');
    }
}
