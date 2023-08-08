<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnExchangePolicy extends Model
{
    use HasFactory;
    protected $fillable = array('title', 'description');
}
