<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorAlbum extends Model
{
    use HasFactory;
    protected $fillable=array('image','vendor_id');
}
