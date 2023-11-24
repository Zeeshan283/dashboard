<?php

namespace App\Models;

use App\Notifications\CustomVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'country',
        'city',
        'addres', // Fix the spelling of 'address'
        'password',
        'gender',
        'role',
        'name', 'first_name', 'last_name', 'company', 'address1', 'address2', 'phone1', 'phone2', 'zipcode', 'email',
        'category_id', 'phone', 'country', 'city', 'addres', 'gender',
        'profession', 'type', 'image', 'password', 'shop_id', 'biller_id', 'role',
        'tax_reg_title', 'tax_reg_number', 'status', 'banner_image1', 'banner_image2', 'banner_image3', 'nation', 'total_employees',
        'established_in', 'deals_in', 'main_market', 'member_since', 'certifications', 'basic_information', 'website_link', 'accepted_payment_type',
        'major_clients', 'annual_export', 'annual_import', 'annual_revenue', 'verified_status', 'trusted_status', 'email_verified_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'role_user', 'role_id');
    }

    // public function sendEmailVerificationNotification()
    // {
    //     $this->notify(new CustomVerifyEmail);
    // }
}
