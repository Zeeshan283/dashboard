<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;
     protected $fillable = ['from', 'to', 'days', 'employee_id', 'reason'];

      public function appoint(){
        return $this->BelongsTo('App\Models\Appointment', 'employee_id');
    }
}
