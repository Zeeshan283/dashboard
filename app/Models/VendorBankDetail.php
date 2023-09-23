<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorBankDetail extends Model
{
    use HasFactory;
    protected $table = "vendor_bank_details";
    protected $fillable = array('vendor_profile_id','vendor_id', 'account_title', 'account_no', 'iban_no', 'bank_name', 'bank_address', 'branch_code');


    public function vendor_profile()
    {
        return $this->belongsTo(vendorProfile::class, 'vendor_profile_id');
    }
}
