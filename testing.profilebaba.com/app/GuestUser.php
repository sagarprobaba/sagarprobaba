<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuestUser extends Model
{
    protected $primaryKey = 'id';
	protected $table = 'guest_user';
	protected $fillable = array(
		'ip',
		'device_key'
	);
}