<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;
    protected $fillable = [
    	'admission_date', 'registration_no', 'name', 'image', 'dob', 'father', 'father_cnic', 'mother', 'mother_cnic', 'cost', 'religion', 'mother_alive', 'death_date', 'guardian', 'guardian_status', 'guardian_cnic', 'guardian_address', 'guardian_postal', 'guardian_phone', 'mother_tongue', 'blood_group', 'identical_symbol', 'birth_districk', 'simbling_name1', 'simbling_name2', 'simbling_name3', 'simbling_gender1', 'simbling_gender2', 'simbling_gender3', 'simbling_age1', 'simbling_age2', 'simbling_age3', 'physical_condition', 'mental_condition', 'class', 'other_needs', 'vaccine1', 'vaccine2', 'vaccine3', 'vaccine4', 'witness_name1', 'witness_name2', 'witness_address1', 'witness_address2', 'witness_cnic1', 'witness_cnic2', 'witness_phone1', 'witness_phone2', 'biller_id', 'shop_id'
    ];
}
