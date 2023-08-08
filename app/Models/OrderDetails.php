<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
   use HasFactory;
   protected $fillable = array(
      'order_id', 'customer_id', 'product_id', 'product_name', 'slug',
      'quantity', 'price', 'total', 'image', 'color', 'amount_old', 'amount_new',
      'conditionType', 'ship_charges', 'locatedin', 'imp_charges', 't_charges', 'oth_charges',
      'ship_days', 'brand_id', 'brand_logo','vendor_id'
   );

   public function order()
   {
      return $this->belongsTo(Order::class, 'order_id');
   }

   public function products()
   {
      return $this->belongsTo(Product::class, 'product_id');
   }

   public function product_image()
   {
      return $this->hasOne(ProductImages::class, 'pro_id');
   }

   public function vendor()
   {
      return $this->belongsTo(User::class, 'vendor_id');
   }
}
