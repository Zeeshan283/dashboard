<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    protected $fillable = array('user_id', 'pro_id');

    public function product()
    {
        return $this->belongsTo(Product::class,'pro_id')->select('id','name','new_sale_price','slug');
    }
}
