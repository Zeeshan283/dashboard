<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = [
        'coupon_type',
        'coupon_title',
        'coupon_code',
        'coupon_used',
        'minimum_purchase',
        'start_date',
        'end_date',
        'discount_type',
        'apply',
        'amount',
        'percentage',
        'limit_same_user',
        'store',
        'product_id',
        'stauts',
    ];
}
