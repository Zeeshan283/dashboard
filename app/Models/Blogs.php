<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Blogs extends Model
{
    use HasFactory,  Notifiable;
    protected $fillable = array('title', 'blog_category_id', 'blog_sub_category_id',  'feature_image',  'description',   'slug', 'created_by', 'updated_by');

    public function blog_category()
    {
        return $this->belongsTo(BlogsCategories::class, 'blog_category_id');
    }
    public function blog_sub_category()
    {
        return $this->belongsTo(BlogSubCategory::class, 'blog_sub_category_id');
    }

    public function created_by_user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function blogSubCategory()
    {
        return $this->belongsTo(BlogsSubCategories::class, 'blog_sub_category_id');
    }
}
