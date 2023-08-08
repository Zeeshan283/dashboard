<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductShippment extends Model
{
    use HasFactory;
    protected $fillable = array(
        'pro_id','location_id' ,'shipping_days', 'shipping_charges', 'import_charges', 'tax_charges',
        'other_charges','new_price','new_sale_price','new_warranty_days','refurnished_price',
        'refurnished_sale_price','refurnished_warranty_days'
    );

    public function location()
    {
        return $this->belongsTo(Locations::class, 'location_id')->select(['id', 'name','address','email']);
    }
}
