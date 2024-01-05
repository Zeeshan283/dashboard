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
        'training_category_id',
        'image',
        'description',
    ];

   
    public function trainingCategory()
{
    return $this->belongsTo(TrainingCategories::class, 'training_category_id');
}


}
