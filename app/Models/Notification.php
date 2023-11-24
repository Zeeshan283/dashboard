<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\DatabaseChangeEvent;

class Notification extends Model
{
    protected $fillable = ['your_column'];

    protected static function boot()
    {
        parent::boot();

        // Listen for the updated event
        static::updated(function ($notification) {
            // Check if the specific column has been updated
            if ($notification->isDirty('your_column')) {
                event(new DatabaseChangeEvent($notification));
            }
        });
    }
}
