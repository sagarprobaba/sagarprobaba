<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;


class VendorContactInformation extends Model
{
	use Notifiable;
    use SpatialTrait;

	protected $primaryKey = 'id';
	protected $table = 'vendor_contact_info';
	protected $fillable = array(
        'vendor_id',
		'landline_number',
		'mobile_number',
		'alternate_number',
		'whatsapp_number',
		'email',
		'website',
        'fb_url',
        'insta_url',
        'youtube_url',
        'twitter_url',
        'address',
        'country',
        'state',
        'city',
        'landmark',
        'area',
        'pincode',
        'google_location',
        'lat_lng',
	);

    protected $spatialFields = [
        'lat_lng',
    ];

	function country_name(){
        return $this->hasOne('App\Country','id','country');
    }

    function state_name(){
        return $this->hasOne('App\State','id','state');

    }
    function city_name(){
        return $this->hasOne('App\City', 'id', 'city');
    }
}
