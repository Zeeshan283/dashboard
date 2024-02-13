<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductContact extends Model
{
    use HasFactory;
    protected $fillable = array(
        'customer_id','customer_name','customer_email','customer_contact_no','customer_company_name','customer_address','customer_profile_link',
        'query_title',
        'pro_id', 'pro_name','pro_model_no','pro_brand_name', 'pro_moq','fob','ref_url',
        'message',  
        'supplier_id','supplier_name','supplier_profile_link', 
    );

    public function vendor()
    {
        return $this->belongsTo(User::class,'vendor_id');
    }
}
