<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class GoogleVendor extends Model
{
    use SpatialTrait;
    protected $primaryKey = 'id';
	protected $table = 'google_vendor';

    protected $fillable=[
        'name',
        'category',
        'phone',
        'location',
        'lat_lng',
        'status',
        'search_category_id',
        'search_location',
        'category_id',
        'added_by'
    ];

    protected $spatialFields = [
        'lat_lng',
    ];

    public function assigned() {
        return $this->hasOne('App\Admin', 'id', 'added_by');
    }

    public function category_s() {
        return $this->hasOne('App\Category', 'id', 'search_category_id');
    }

}