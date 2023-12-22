<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    use HasFactory;
    protected $table = "faqs";
    protected $fillable = array('id', 'question', 'answer', 'faq_category_id', 'created_at', 'updated_at');


    public function faq_category()
    {
        return $this->belongsTo(FAQCategory::class, 'faq_category_id');
    }
    public function faq_category1()
    {
        return $this->hasMany(FAQCategory::class, 'faq_category_id');
    }
}
