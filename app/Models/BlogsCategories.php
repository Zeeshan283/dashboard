<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogsCategories extends Model
{
    use HasFactory;
    protected $fillable = array('title');
    public function subcategories()
    {
        return $this->hasMany(BlogSubCategory::class, 'blog_category_id');
    }
}
