<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserChatRoom extends Model
{
    protected $primaryKey = 'id';
	protected $table = 'user_chatroom';

    protected $fillable=[
        'user1',
        'user2'
    ];

    public function chat(){
        return $this->hasMany('App\UserChat', 'chatroom_id', 'id');
    }
}