<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;
    protected $table = "advertisements";
    protected $fillable = array('id', 'name', 'image', 'imageDimention', 'old_price', 'sale_price', 'days', 'quantity', 'details', 'created_at', 'updated_at');
}
