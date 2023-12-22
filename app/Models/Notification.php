<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\DatabaseChanged;
use App\Model\User;

class Notification extends Model
{
    protected $fillable = [
        'type',
        'notifiable_type',
        'notifiable_id',
        'data',
        'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

}
