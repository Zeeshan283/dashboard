<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use  HasFactory, Notifiable;

    
    protected $fillable = [
        'name', 'first_name', 'last_name', 'company', 'address1', 'address2', 'phone1', 'phone2', 'zipcode', 'email',
        'category_id', 'phone', 'country', 'city', 'addres', 'gender',
        'profession', 'type', 'image', 'password', 'shop_id', 'biller_id', 'role',
        'ntn', 'strn', 'status','banner_image1','banner_image2','banner_image3','nation','total_employees',
        'established_in','deals_in','main_market','member_since','certifications','basic_information','website_link','accepted_payment_type',
        'major_clients','annual_export','annual_import','annual_revenue'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'user_roles', 'user_id', 'role_id');
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($role)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }
}
