<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;


class Vendor extends Model
{
	use Notifiable;

	protected $primaryKey = 'id';
	protected $table = 'vendor';
	protected $fillable = array(
		'id',
		'user_id',
		'business_name',
		'slug',
		'logo',
		'about_me',
		'email_verification',
		'status'
	);

	function contact_information(){
		return $this->hasOne('App\VendorContactInformation', 'vendor_id', 'id');
	}

	function other_information(){
		return $this->hasOne('App\VendorOtherInformation', 'vendor_id', 'id');
	}

	function vendor_images(){
		return $this->hasMany('App\VendorImages', 'vendor_id', 'id');
	}

	function vendor_service_location(){
		return $this->hasMany('App\VendorServiceLocation', 'vendor_id', 'id');
	}

	function vendor_rating(){
		return $this->hasMany('App\VendorRating', 'vendor_id', 'id');
	}

	function category(){
		return $this->belongsToMany('App\Category','vendor_categories');
	}

	function user(){
		return $this->hasOne('App\User', 'id', 'user_id');
	}

	public function getRouteKeyName(){
		return 'slug';
	}

	public function sluggable()
	{
		return [
			'slug' => [
				'source' => 'name'
			]
		];
	}
}
