<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductContact extends Model
{
    use HasFactory;
    protected $fillable = array(
        'make', 'pro_id', 'pro_name', 'message', 'model_no', 'brand_name', 'moq',
        'delivery_location', 'vendor_id', 'ptcl', 'phoneno', 'company', 'address'
    );

    public function vendor()
    {
        return $this->belongsTo(User::class,'vendor_id');
    }
}
