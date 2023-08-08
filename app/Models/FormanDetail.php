<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormanDetail extends Model
{
    use HasFactory;
     protected $table = "forman_details";
     protected $fillable = ['purchase_id', 'produc_id', 'unit_id', 'carat_id', 'quantity', 'cost', 'total'];

     public function prodcts(){
        return $this->BelongsTo('App\Models\Product', 'produc_id');
    }
    public function uoms(){
        return $this->BelongsTo('App\Models\UOM', 'unit_id');
    }

    public function carats(){
        return $this->BelongsTo('App\Models\Carat', 'carat_id');
    }
    }
