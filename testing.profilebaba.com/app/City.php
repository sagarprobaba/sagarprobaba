<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
	protected $primaryKey = 'id';
	protected $table = 'city';
	
    protected $fillable = array('state_id','name','status');

	function state(){
		return $this->hasOne('App\State', 'id', 'state_id');
	}
}