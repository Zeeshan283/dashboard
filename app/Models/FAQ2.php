<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQ2 extends Model
{
    use HasFactory;
    protected $table="faq2s";
    protected $fillable=array('question','answer');
}
