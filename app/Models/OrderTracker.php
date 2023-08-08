<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTracker extends Model
{
    use HasFactory;
    protected $fillable = array('order_id', 'datetime', 'status', 'direction', 'country','icon');
}
