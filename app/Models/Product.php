<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'code', 'name', 'new_price', 'new_sale_price', 'new_warranty_days', 'new_return_days', 'sku', 'description', 'details',
        'brand_id', 'brand_name', 'menu_id', 'category_id', 'subcategory_id', 'model_no', 'make', 'type', 'slug',
        'parent_id', 'refurnished_price', 'refurnished_sale_price', 'refurnished_warranty_days', 'refurnished_return_days',
        'attachment', 'width', 'height', 'depth', 'weight', 'min_order', 'status', 'created_by', 'updated_by', 'GST_tax', 'VAT_tax', 'FED_tax', 'Other_tax', 'url', 'feature_image', 'weight_unit', 'weight', 'm_unit', 'width', 'height',
        'depth', 'min_ref_order', 'tax_title', 'tax_type', 'tax_charges'
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcategories()
    {
        return $this->belongsTo('App\Models\SubCategory', 'subcategory_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'name');
    }

    public function wishlist()
    {
        return $this->hasOne(Wishlist::class, 'pro_id');
    }

    public function sizes()
    {
        return $this->hasMany(ProductSizes::class, 'pro_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function product_image()
    {
        return $this->hasOne(ProductImages::class, 'pro_id');
    }

    public function product_images()
    {
        return $this->hasMany(ProductImages::class, 'pro_id');
    }

    public function locations()
    {
        return $this->hasMany(ProductLocations::class, 'pro_id')->with('location');
    }

    public function conditions()
    {
        return $this->hasMany(ProductConditions::class, 'pro_id')->with('condition');
    }

    public function shipping_details()
    {
        return $this->hasMany(ProductShippment::class, 'pro_id');
    }

    public function biller()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function stock()
    {
        return $this->hasMany(Stock::class, 'pro_id');
    }

    public function product_locations()
    {
        return $this->hasMany(ProductLocations::class, 'pro_id')->with('location2');
    }
    public function refunds()
    {
        return $this->hasMany(Refund::class);
    }
    public function colors()
    {
        return $this->hasMany(ProductColors::class, 'pro_id')->with('color');
    }
    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'product_id');
    }
}
