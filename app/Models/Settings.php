<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    protected $fillable = [
        'system_name', 'title', 'address', 'phone', 'email',
        'currency', 'city', 'state', 'country', 'ntn', 'strn', 'website', 'logo', 'ceo',
        'designation', 'cell', 'facebook', 'twitter', 'linkedin', 'google_pluse', 'pinterest',
        'whatsapp', 'insta', 'youtube', 'description', 'map','disclaimer'
    ];
}
