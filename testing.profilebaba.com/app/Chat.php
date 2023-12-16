<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $primaryKey = 'id';
	protected $table = 'chat';

    protected $fillable=[
        'sender_id',
        'assigned_to',
        'message',
        'sender_type',
        'status'
    ];

    public function guest() {
        return $this->hasOne('App\GuestUser', 'id', 'sender_id');
    }

    public function user() {
        return $this->hasOne('App\User', 'id', 'sender_id');
    }

    public function assigned() {
        return $this->hasOne('App\Admin', 'id', 'assigned_to');
    }

    public function chat() {
        return $this->hasMany('App\ChatHistory', 'chat_id', 'id');
    }

}