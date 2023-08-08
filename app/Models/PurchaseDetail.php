<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    use HasFactory;
     protected $fillable = ['purchase_id', 'produc_id', 'carat_id','unit_id', 'quantity', 'quantity_out', 'cost', 'total'];

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
