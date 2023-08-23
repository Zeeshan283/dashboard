<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColors extends Model
{
    use HasFactory;
    protected $fillable = ['pro_id', 'color_id'];

    public function colors()
    {
        return $this->belongsTo(Color::class, 'color_id')->select(['id','name']);
    }
}
