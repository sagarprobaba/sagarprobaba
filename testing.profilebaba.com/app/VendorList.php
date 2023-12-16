<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorList extends Model
{
    protected $primaryKey = 'id';
	protected $table = 'vendor_list';

    protected $fillable=[
        'search_id',
        'json_data',
    ];

    public function vendor_query() {
        return $this->hasOne('App\QueryForVendor', 'id', 'search_id');
    }

}