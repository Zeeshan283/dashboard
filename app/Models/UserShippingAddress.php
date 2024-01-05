<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserShippingAddress extends Model
{
    use HasFactory;
    protected $table = "user_shipping_address";

    protected $fillable = array('id', 'customer_id', 'first_name', 'last_name', 'address', 'country', 'city', 'zip_code', 'company_name', 'phone', 'email', 'state');
}
