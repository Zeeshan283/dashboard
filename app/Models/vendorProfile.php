<?php

namespace App\Models;

use App\Http\Controllers\CprofileController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class vendorProfile extends Model
{
    use HasFactory;
    protected $table = "vendor_profile";
    protected $fillable = array(
        'vendor_id', 'logo', 'country', 'slider_title', 'slider_title2', 'slider_images', 'about', 'portfolio', 'disclaimer', 'company_name', 'p_category1', 'p_c1_images', 'p_category2', 'p_c2_images', 'p_category3', 'p_c3_images', 'p_category4', 'p_c4_images', 'p_category5', 'p_c5_images', 'id_front', 'id_back',
        'trade_license', 'tagline', 'rating', 'created_by', 'updated_by'
    );

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

    public function vendorServices()
    {
        return $this->hasMany(Services::class, 'vendor_id','vendor_id');
    }

    public function vendorPortfolio()
    {
        return $this->hasMany(VendorPortfolio::class, 'vendor_id','vendor_id');
    }
}
