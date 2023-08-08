<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;
    protected $fillable = array('product_id', 'customer_name', 'customer_email', 'rating', 'review', 'status');

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
