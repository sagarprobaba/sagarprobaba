<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $primaryKey = 'id';
	protected $table = 'site_menu';
	protected $fillable = array(
		'name',
		'href',
		'position',
		'need_login'
	);
}
