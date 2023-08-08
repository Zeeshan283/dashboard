<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogSubCategory extends Model
{
    use HasFactory;
    protected $table="blog_sub_categories";
    protected $fillable=['title','blog_category_id'];
    
      public function blogs(){
       return $this->hasMany(Blogs::class,'blog_sub_category_id');
    }
     public function subCategories(){
        return $this->belongsTo(BlogsCategories::class,'blog_category_id');
    }
    
}
