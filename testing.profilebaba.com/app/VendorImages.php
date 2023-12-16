<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorImages extends Model
{
    protected $primaryKey = 'id';
	protected $table = 'vendor_images';
    protected $fillable = array(
        "vendor_id", 
        "file",
        "size",
        "type"
    );
}