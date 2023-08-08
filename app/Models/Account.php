<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
     protected $fillable = ['account_name', 'group_id', 'city', 'address'];
     
     public function accountgroup(){
        return $this->BelongsTo('App\Models\Accountgroup', 'group_id');

}
}
