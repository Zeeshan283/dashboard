<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'code', 'name', 'new_price', 'new_sale_price', 'new_warranty_days', 'new_return_days', 'sku', 'description', 'details',
        'brand_id', 'menu_id', 'category_id', 'subcategory_id', 'model_no', 'make', 'type', 'slug',
        'parent_id', 'refurnished_price', 'refurnished_sale_price', 'refurnished_warranty_days', 'refurnished_return_days',
        'attachment', 'width', 'height', 'depth', 'weight', 'min_order', 'status', 'created_by', 'updated_by'
    ];
}
