<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminLog extends Model
{
    protected $primaryKey = 'id';
	protected $table = 'admin_logs';

    protected $fillable = array('admin_id', 'url', 'log');

    function admin(){
		return $this->hasOne('App\Admin', 'admin_id');
	}
}
