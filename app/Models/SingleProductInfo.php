<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SingleProductInfo extends Model
{
    use HasFactory;
    protected $fillable = array('shipping', 'delivery', 'returns', 'payment_method', 'disclaimer');
}
