<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HomeSettings extends Model
{
    use HasFactory;
    protected $fillable = array(
        'f_s_banner_1', 'f_s_banner_2', 'f_s_banner_3',
        'category1','category1_image', 
        'category2', 'category2_image',
        'category3', 'category3_image', 
        'category4', 'category4_image', 
        'center_image1', 'center_image2',
        'e_s_banner_1', 'e_s_banner_2', 'e_s_banner_3'
    );


    public function category1Info(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category1');
    }

    public function category2Info(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category2');
    }

    public function category3Info(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category3');
    }

    public function category4Info(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category4');
    }

}
