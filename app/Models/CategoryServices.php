<?php

namespace App\Models;

use App\Http\Controllers\CprofileController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryServices extends Model
{
    use HasFactory;
    protected $fillable = [
        'vendor_id',
        'title',
        'category',
        'image',
        'description',
        'created_by',
        'updated_by',
    ];
    public function Category()
    {
        return $this->belongsTo(Cprofile::class, 'category', 'id', 'vendor_id');
    }
}
