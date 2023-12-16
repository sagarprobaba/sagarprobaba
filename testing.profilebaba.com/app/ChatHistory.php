<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatHistory extends Model
{
    protected $primaryKey = 'id';
	protected $table = 'chat_history';

    protected $fillable=[
        'sender_id',
        'chat_id',
        'message',
        'sender'
    ];

    public function guest() {
        return $this->hasOne('App\GuestUser', 'id', 'sender_id');
    }

    public function user() {
        return $this->hasOne('App\User', 'id', 'sender_id');
    }

    public function admin() {
        return $this->hasOne('App\Admin', 'id', 'sender_id');
    }

    public function chat() {
        return $this->hasOne('App\Chat', 'id', 'chat_id');
    }
}