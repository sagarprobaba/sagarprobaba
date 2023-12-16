<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReferNumber extends Model
{
    protected $primaryKey = 'id';
	protected $table = 'refer_number';

    protected $fillable = array('user_id','phone_number');

    function user(){
		return $this->hasOne('App\User','id', 'user_id');
	}
}
