<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class QueryForVendor extends Model
{
    use SpatialTrait;
    protected $primaryKey = 'id';
	protected $table = 'query_for_vendor';

    protected $fillable=[
        'user_id',
        'category_id',
        'assigned_to',
        'location',
        'lat_lng',
        'status',
        'response_count'
    ];

    protected $spatialFields = [
        'lat_lng',
    ];

    public function user() {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function category() {
        return $this->hasOne('App\Category', 'id', 'category_id');
    }

    public function assigned() {
        return $this->hasOne('App\Admin', 'id', 'assigned_to');
    }

}