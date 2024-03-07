<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParcelReview extends Model
{
    use HasFactory;

    protected $table = 'parcel_reviews';
    protected $fillable =  ['product_id','order_item_id', 'customer_id','rating', 'comment','created_at','updated_at'];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}