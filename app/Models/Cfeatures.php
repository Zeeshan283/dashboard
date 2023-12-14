<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cfeatures extends Model
{
    use HasFactory;

    protected $fillable = [
        'instructor',
        'rating',
        'lectures',
        'duration',
        'skilllevel',
        'language',
        'coursetype',
        'address',        
        'title',
        'blog_category_id',
        'blog_sub_category_id',
        'feature_image',
        'description',
    ];
}
