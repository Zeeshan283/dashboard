<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductConditions extends Model
{
    use HasFactory;
    protected $fillable = array('pro_id', 'condition_id');

    public function condition()
    {
        return $this->belongsTo(Conditions::class, 'condition_id')->select(['id','name']);
    }
}
