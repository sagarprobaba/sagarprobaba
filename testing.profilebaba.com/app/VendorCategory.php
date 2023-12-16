<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorCategory extends Model
{
    protected $primaryKey = 'id';
	protected $table = 'vendor_categories';
    protected $fillable = array(
        "vendor_id", 
        "category_id",
    );

    public function vendor() {
        return $this->hasOne('App\Vendor', 'id', 'vendor_id');
    }

    public function category(){
		return $this->hasOne('App\Category', 'id', 'category_id');
	}
}