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
        'minimum_purchase',
        'start_date',
        'end_date',
        'discount_type',
        'amount',
        'percentage',
        'limit_same_user',
        'product_id',
    ];
}
