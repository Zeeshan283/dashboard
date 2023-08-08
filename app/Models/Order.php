<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'date', 'first_name', 'last_name', 'company', 'country', 'address_01',
        'address_02', 'city', 'state', 'postal_code', 'phone1', 'phone2', 'email', 'comments',
        'payment_method', 'status', 'shipping', 'updatedby', 'customer_id'
    ];

    public function order_details()
    {
        return $this->hasMany(OrderDetails::class, 'order_id')->with('vendor:id,name');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function customer_orders()
    {
        return $this->hasMany(OrderDetails::class, 'order_id');
    }
}