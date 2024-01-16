<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cfeatures extends Model
{
    use HasFactory;

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
        'image',
        'description',
    ];


    public function trainingCategory()
    {
        return $this->belongsTo(Trainings::class, 'training_category_id');
    }
    public function InstructorName()
    {
        return $this->belongsTo(Instructor::class, 'name');
    }
}
