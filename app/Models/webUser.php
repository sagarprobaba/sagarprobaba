<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class webUser extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstName', 
        'lastName', 
        'email', 
        'email_verified_at', 
        'password', 
        'phone', 
        'gender', 
        'image', 
        'company_category', 
        'companyName', 
        'companyEmail', 
        'companyPhone', 
        'companyWebsite', 
        'companyAddress', 
        'latitude', 
        'longitude', 
        'companyLogo', 
        'location', 
        'cac_certificate', 
        'cac_certificate_number', 
        'provider_id', 
        'avatar', 
        'plan', 
        'plan_date', 
        'plan_exp_date', 
        'account_type', 
        'about_company', 
        'yoe', 
        'start_time', 
        'end_time', 
        'status', 
        'source', 
        'remember_token', 
        'created_at', 
        'updated_at', 
        'coordinates',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeWithinRadius($query, $latitude, $longitude, $radius = 30)
    {
        $haversine = "(6371 * acos(cos(radians($latitude)) * cos(radians(latitude)) * cos(radians(longitude) - radians($longitude)) + sin(radians($latitude)) * sin(radians(latitude))))";

        return $query->selectRaw("{$haversine} AS distance")
            ->whereRaw("{$haversine} <= ?", [$radius]);
    }

}
