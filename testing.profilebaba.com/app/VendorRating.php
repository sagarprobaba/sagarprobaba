<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorRating extends Model
{
    protected $primaryKey = 'id';
	protected $table = 'vendor_rating';
    protected $fillable = array(
        "vendor_id", 
        "name",
        "email",
        "rating",
        'message',
        'status',
        'ip',
        "user_id"
    );
}