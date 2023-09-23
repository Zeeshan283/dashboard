<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorDocument extends Model
{
    use HasFactory;
    protected $table = "vendor_documents";
    protected $fillable = array('vendor_profile_id', 'vendor_id', 'document_name', 'document_file');

    public function vendor_profile()
    {
        return $this->belongsTo(vendorProfile::class, 'vendor_profile_id');
    }
}
