<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingCategories extends Model
{
    use HasFactory;
    protected $fillable = array('training_category_id');
    public function trainingCategory()
{
    return $this->belongsTo(TrainingCategories::class, 'training_category_id');
}
}
