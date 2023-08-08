<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;
    protected $fillable = array('title', 'image', 'description', 'event_category_id', 'slug', 'created_by', 'updated_by');

    public function event_category()
    {
        return $this->belongsTo(EventCategories::class, 'event_category_id');
    }

    public function created_by_user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
