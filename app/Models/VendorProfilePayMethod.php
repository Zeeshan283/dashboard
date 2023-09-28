<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorProfilePayMethod extends Model
{
    use HasFactory;
    protected $table = "vendor_profile_pay_method";
    protected $fillable = array('id','vendor_id','profile_id', 'payment_method_id','pay_id','name', 'created_at', 'updated_at');


    public function paymethods()
    {
        return $this->belongsTo(PaymentMethod::class, 'pay_id')->select(['id', 'name',]);
    }

    // public function color()
    // {
    //     return $this->belongsTo(Color::class, 'color_id')->select(['id', 'name', 'color_code']);
    // }
    
}
