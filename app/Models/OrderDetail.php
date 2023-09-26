<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'orders_details';

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'p_price',
        'p_vendor_id',
    ];

    // Define relationships if applicable
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    // public function order()
    // {
    //     return $this->belongsTo(Order::class);
    // }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(ProductVendor::class, 'p_vendor_id');
    }
    
}
