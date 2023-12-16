<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Setting extends Model
{
    protected $primaryKey = 'set_id';
	protected $table = 'site_settings';
	
    protected $fillable = array('meta_key','meta_value');
	
	
	function get_setting($meta_key){
  		$setting=Setting::where('meta_key',$meta_key)->first();
		
		$value=$setting->meta_value ?? '';
		
		return $value;
	}
}
