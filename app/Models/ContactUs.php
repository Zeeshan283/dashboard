<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;
    protected $fillable = array(
        'first_name', 'last_name', 'job_title', 'job_function', 'company',
        'industry', 'email', 'phoneno', 'city', 'state', 'subject', 'message'
    );
}
