<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'id';
	protected $table = 'users';
	protected $fillable = array(
		'name',
		'email',
		'password',
		'designation',
		'profile_pic',
		'contact_number',
		'address',
		'is_vendor',
        'token',
        'status',
        'device_key',
        'is_logged_in',
        'lastname',
        'company_category',
        'plan',
        'company_name',
        'company_email',
        'company_phone',
        'company_address',
        'about_company',
        'latitude',
        'longitude'
        
	);

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function vendor(){
		return $this->hasMany('App\Vendor', 'user_id', 'id');
	}
}
