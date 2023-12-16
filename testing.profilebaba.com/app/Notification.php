<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $primaryKey = 'id';
	protected $table = 'notification';
	protected $fillable = array(
		'user_id',
		'message',
		'status',
	);

    function user(){
		return $this->hasOne('App\User','id', 'user_id');
	}
}
