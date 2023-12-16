<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $primaryKey = 'id';
	protected $table = 'category';
	
	protected $fillable = array('title','category_image','parent_id','slug','meta_title','meta_keyword','meta_desc','status','mobile_icon','show_in_mobile','priority');

	
	public function getRouteKeyName(){
		return 'slug';
	}

	function parent(){
		return $this->hasOne('App\Category', 'id', 'parent_id');
	}

	public function child(){
		return $this->hasMany('App\Category', 'parent_id', 'id');
	}

	public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}