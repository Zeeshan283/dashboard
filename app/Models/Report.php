<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $table = "report";

    protected $fillable = array(
        'title','user_id' ,'user_type' , 'company',
        'contact', 'email','name', 'city', 'state', 'country', 'message', 'profile_link'
    );
}
