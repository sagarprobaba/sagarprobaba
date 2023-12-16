<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    
	protected $primaryKey = 'id';
	protected $table = 'country';
	
    protected $fillable = array(
    	"title",
    	"status", 
    );
	
		
}

