<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
     protected $fillable = ['appoint_no', 'date', 'designation', 'employee_name', 'salary', 'status', 'phone', 'address', 'image', 'image_f', 'image_b','created_by', 'updated_by'];
}
