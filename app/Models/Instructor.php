<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;
    protected $table = 'instructors';
    protected $fillable = ['name'];
    public function InstructorName()
    {
        return $this->belongsTo(Instructor::class, 'name');
    }
}
