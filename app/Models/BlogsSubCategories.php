<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogsSubCategories extends Model
{
    use HasFactory;
    protected $fillable = ['blog_category_id', 'blog_sub_category_id'];
    // Blogs model
    // public function subcategory()
    // {
    //     return $this->belongsTo(BlogsSubCategories::class, 'blog_sub_category_id');
    // }

    public function blogs()
    {
        return $this->hasMany(Blogs::class, 'blog_sub_category_id');
    }

    public function blogCategory()
    {
        return $this->belongsTo(BlogsCategories::class, 'blog_category_id');
    }
    public function subCategories()
    {
        return $this->belongsTo(BlogsCategories::class, 'blog_category_id');
    }
}
