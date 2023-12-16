<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cmspages extends Model
{
    protected $primaryKey = 'id';
	protected $table = 'cms_pages';
	
    protected $fillable = array('title', 'body', 'slug', 'heading', 'meta_title', 'meta_description', 'meta_keywords', 'status');
	 
	 
	public function getRouteKeyName() {
        return 'slug';
    }

	public static function crspageview($slug){
		$data = Cmspages::where('slug',$slug)->first();
		if ($data) {
		    $data = str_replace('base_url',url('/'),$data->body);

			return  $data;
		}
	}

	function content(){
		if(!$this->body){
			return ;
		} 
 		return str_replace('base_url',url('/'),$this->body);
	}

}