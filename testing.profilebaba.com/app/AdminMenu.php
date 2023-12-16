<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminMenu extends Model
{
    protected $primaryKey = 'id';
	protected $table = 'admin_menu';

    protected $fillable = array('name', 'parent_id', 'url', 'status', 'created_by');

    function parent(){
		return $this->hasOne('App\AdminMenu', 'id', 'parent_id');
	}

	public function child(){
		return $this->hasMany('App\AdminMenu', 'parent_id', 'id');
	}

    function admin(){
		return $this->hasOne('App\Admin', 'id', 'created_by');
	}
}
