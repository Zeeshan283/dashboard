<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebUsers extends Model
{
    use HasFactory;
    protected $fillable = array(
        'first_name', 'last_name', 'company', 'country', 'address1',
        'address2', 'city', 'province', 'zipcode', 'phone1', 'phone2', 'email',
        'password'
    );
}
