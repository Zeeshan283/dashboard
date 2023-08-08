<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQ1 extends Model
{
    use HasFactory;
    protected $table="faq1s";
    protected $fillable=array('question','answer','faq_category_id');

    public function faq_category()
    {
        return $this->belongsTo(FaqCategories::class,'faq_category_id');
    }
}
