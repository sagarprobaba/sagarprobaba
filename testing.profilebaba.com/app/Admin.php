<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $primaryKey = 'id';
	protected $table = 'admin';

    protected $fillable = array('name', 'email', 'profile_pic', 'username', 'password', 'role_id','device_key');

    function role(){
		return $this->hasOne('App\Role','id', 'role_id');
	}
}
