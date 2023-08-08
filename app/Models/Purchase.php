<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = ['date', 'bill_no', 'supplier_id', 'biller_id', 'status'];
    public function producs(){
        return $this->BelongsTo('App\Models\Product', 'produc_id');
    }
     public function accounts(){
        return $this->BelongsTo('App\Models\Account', 'supplier_id');
    }
  
    public function users(){
        return $this->BelongsTo('App\Models\User', 'biller_id');
    }
    public function purchase_details(){
        return $this->hasMany('App\Models\PurchaseDetail', 'purchase_id');
    }

        
}
