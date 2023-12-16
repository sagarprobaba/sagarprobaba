<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class VendorServiceLocation extends Model
{
    use SpatialTrait;
    protected $primaryKey = 'id';
	protected $table = 'vendor_service_location';
    protected $fillable = array(
        "vendor_id",
        'service_location',
        'lat_lng',
        'status',
    );

    protected $spatialFields = [
        'lat_lng',
    ];
}