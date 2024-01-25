<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorPortfolio extends Model
{
    use HasFactory;
    protected $table = "vendor_portfolio";
    protected $fillable = array('title',  'image', 'slug','vendor_id');
}
