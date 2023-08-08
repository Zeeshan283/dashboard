<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $fillable = array('bill_no', 'date', 'pro_id', 'unit_id', 'cost', 'total', 'type', 'qty_in', 'qty_out', 'biller_id');

    public function product()
    {
        return $this->belongsTo(Product::class, 'pro_id');
    }
    public function uoms()
    {
        return $this->belongsTo(UOM::class, 'unit_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'biller_id');
    }
}
