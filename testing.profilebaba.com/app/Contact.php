<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	protected $primaryKey = 'id';
	protected $table = 'contact';
	
	protected $fillable = array(
		"f_name", 
		"l_name", 
		"email", 
		"phone", 
		"message",
	);
}