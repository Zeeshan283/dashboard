<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogsSetting extends Model
{
    use HasFactory;
    protected $table="blogs_settings";
    protected $fillable=['blog_category1','blog_category2','blog_category3','blog_category4','blog_category5'];
}
