<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainings extends Model
{
    use HasFactory;
    protected $table = "trainings";
    protected $fillable = array('training_category_id',  'created_by', 'updated_by');

    public function trainingCategory()
    {
        return $this->belongsTo(TrainingCategories::class, 'training_category_id');
    }

    public function created_by_user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
