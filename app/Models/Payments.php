<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;
    protected $fillable = array('payment_id', 'payer_id', 'payer_email', 'amount', 'currency', 'payment_status');
}
