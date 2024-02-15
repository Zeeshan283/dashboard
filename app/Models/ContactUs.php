<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;
    protected $fillable = array(
        'title','user_type' , 'company',
        'contact', 'email','name', 'city', 'state', 'country', 'message', 'profile_link'
    );
}
