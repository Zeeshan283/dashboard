<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainings extends Model
{
    use HasFactory;
    protected $table = "trainings";
    protected $fillable = [
        'name',
        'rating',
        'lectures',
        'duration',
        'skilllevel',
        'language',
        'coursetype',
        'address',
        'title',
        'training_category_id',
        'intructor_id',
        'image',
        'description',
    ];
    public function training_category()
    {
        return $this->belongsTo(TrainingCategories::class, 'training_category_id');
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'intructor_id');
    }
}
