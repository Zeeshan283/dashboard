<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'bill_number',
        'user_id',
        'product_sku',
        'selected_product_model',
        'quantity',
        'selected_product_price',
        'total_value',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Product model
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

        
}
