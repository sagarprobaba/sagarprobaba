<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CallHistory extends Model
{
    protected $primaryKey = 'id';
	protected $table = 'call_history';

    protected $fillable=[
        'user_id',
        'category_id',
        'location',
        'vendor_id'
    ];

    public function vendor() {
        return $this->hasOne('App\Vendor', 'id', 'vendor_id');
    }

    public function user() {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function category() {
        return $this->hasOne('App\Category', 'id', 'category_id');
    }

}