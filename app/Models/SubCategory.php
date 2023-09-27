<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table="sub_categories";
    protected $fillable = array('category_id','name','img','slug', 'commission');

    public function categories(){
    	return $this->belongsTo(Category::class, 'category_id');
    }
}
