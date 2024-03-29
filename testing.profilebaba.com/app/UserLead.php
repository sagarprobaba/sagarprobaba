<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLead extends Model
{
    protected $primaryKey = 'id';
	protected $table = 'user_lead';

    protected $fillable=[
        'search_id',
        'chat_id',
        'call_id',
        'user_id',
        'status',
        'reciever_id',
        'source',
        'main_cat',
		'location'
    ];

    /*public function vendor_query() {
        return $this->hasOne('App\QueryForVendor', 'id', 'search_id');
    }

    public function adminChat() {
        return $this->hasOne('App\ChatHistory', 'id', 'chat_id');
    }

    public function chat() {
        return $this->hasOne('App\UserChat', 'id', 'chat_id');
    }

    public function call() {
        return $this->hasOne('App\CallHistory', 'id', 'call_id');
    }

    public function vendor() {
        return $this->hasOne('App\Vendor', 'id', 'vendor_id');
    }

    public function google() {
        return $this->hasOne('App\GoogleVendor', 'id', 'vendor_id');
    }*/

}