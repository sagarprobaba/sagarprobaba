<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorServices extends Model
{
    protected $primaryKey = 'id';
	protected $table = 'vendor_other_services';
    protected $fillable = array(
        "vendor_id", 
        "business_name",
        "status",
        "category_id",
        "latitude",
        "longitude",
        "business_logo",
        "business_price",
		"is_negotiable",
		"business_description"
    ); 
}