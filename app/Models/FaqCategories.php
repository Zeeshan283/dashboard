<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqCategories extends Model
{
    use HasFactory;
    protected $fillable = array('title');

    public function faq1()
    {
        return $this->hasMany(FAQ1::class,'faq_category_id');
    }
}
