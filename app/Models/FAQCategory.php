<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQCategory extends Model
{
    use HasFactory;
    protected $table = "faq_categories";
    protected $fillable = array('id', 'name', 'created_at', 'updated_at');

    public function faqs()
    {
        return $this->hasMany(FAQ::class, 'faq_category_id');
    }
}
