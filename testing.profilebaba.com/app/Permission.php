<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $primaryKey = 'id';
	protected $table = 'permission';

    protected $fillable = array('role_id', 'menu_id' ,'given_by');

    function admin(){
		return $this->hasOne('App\Admin','id', 'given_by');
	}

    function role(){
		return $this->hasOne('App\Role','id', 'role_id');
	}

    function menu(){
		return $this->hasOne('App\AdminMenu','id', 'menu_id');
	}
}
