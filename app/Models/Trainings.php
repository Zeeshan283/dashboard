<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainings extends Model
{
    use HasFactory;
    protected $table="trainings";
    protected $fillable = array('title', 'image', 'description','specification','intructor_id','language','students','lectures','quizzes','duration','skill_level','certificate','assessments','training_category_id', 'slug', 'created_by', 'updated_by');

    public function training_category()
    {
        return $this->belongsTo(TrainingCategories::class, 'training_category_id');
    }
    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'intructor_id');
    }

    public function created_by_user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
