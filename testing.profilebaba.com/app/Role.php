<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $primaryKey = 'id';
	protected $table = 'role';

    protected $fillable = array('name', 'created_by');

    function admin(){
		return $this->hasOne('App\Admin','id', 'created_by');
	}
}
