<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelpCenter extends Model
{
    use HasFactory;
    protected $table = "faq1s";
    protected $fillable = array('id', 'question', 'answer', 'faq_category_id');
}
