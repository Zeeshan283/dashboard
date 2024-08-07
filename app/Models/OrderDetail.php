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
        'status',
        'customer_cancel_status',
        'customer_cancel_reason',
        'customer_cancel_time',
        'refund_status',
        'review_status',
    ];

    // Define relationships if applicable
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function vendor()
    {
        return $this->belongsTo(User::class, 'p_vendor_id');
    }


    public function vendorProfile()
    {
        return $this->belongsTo(vendorProfile::class, 'p_vendor_id' ,'vendor_id');
    }
    // public function order()
    // {
    //     return $this->belongsTo(Order::class);
    // }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id')->with('subcategories');
    }
    public function product_details()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }public function sub()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    // public function user()
    // {
    //     return $this->belongsTo(ProductVendor::class, 'p_vendor_id');
    // }

    public function products()
    {
        return $this->belongsTo(Product::class)->select('name', 'model_no', 'url');
    }

    public function order_tracker()
    {
        return $this->hasMany(OrderTracker::class, 'order_id','id');
    }
}
