<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvertisementOrder extends Model
{
    use HasFactory;
    protected $table = "advertisement_order";
    protected $fillable = array('id', 'customer_id', 'product_id', 'bill', 'name', 'display_status', 'display_time_start', 'display_end_start', 'phone', 'status', 'image', 'quantity', 'created_at', 'updated_at');

    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }


    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class, 'product_id');
    }
}
