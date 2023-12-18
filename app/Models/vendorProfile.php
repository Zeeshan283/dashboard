<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class vendorProfile extends Model
{
    use HasFactory;
    protected $table = "vendor_profile";
    protected $fillable = array('vendor_id','logo','country','slider_title', 'slider_title2', 'slider_images','about','portfolio','disclaimer','company_name', 'p_category1','p_c1_images', 'p_category2', 'p_c2_images', 'p_category3', 'p_c3_images', 'p_category4', 'p_c4_images','p_category5', 'p_c5_images', 'id_front','id_back', 'trade_license', 'created_by', 'updated_by');

    public function user()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function paymethod()
    {
        return $this->hasMany(VendorProfilePayMethod::class, 'profile_id')->with('paymethods');
    }

    public function bank_details()
{
    return $this->hasMany(VendorBankDetail::class, 'vendor_profile_id');
}
}
