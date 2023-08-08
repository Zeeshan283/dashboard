<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSettings extends Model
{
    use HasFactory;
    protected $fillable = array(
        'category1', 'category1_image', 'category2', 'category2_image',
        'category3', 'category3_image', 'category4', 'category4_image', 'center_image1', 'center_image2'
    );
}
