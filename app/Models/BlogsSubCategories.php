<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogsSubCategories extends Model
{
    use HasFactory;
    protected $fillable = ['blog_category_id', 'blog_sub_category_id'];
    // Blogs model
public function subcategory()
{
    return $this->belongsTo(BlogsSubCategories::class, 'blog_sub_category_id');
}

    
}


