<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
     protected $table='categories';
    protected $fillable = [ 'menu_id', 'name', 'commission', 'img','imageforapp', 'menu', ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
    public function categories()
{
    return $this->hasMany(Category::class, 'menu_id');
}
    public function subcategories()
    {
        return $this->hasMany(Category::class, 'category_id');
    }
}
