<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispute extends Model
{
    use HasFactory;
    protected $table = "dispute";

    protected $fillable = array(
        'title','user_id' ,'user_type' ,'good_type', 'company',
        'contact', 'email','name', 'city', 'state', 'country', 'message', 'profile_link'
    );
}
