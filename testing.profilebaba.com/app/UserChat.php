<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserChat extends Model
{
    protected $primaryKey = 'id';
	protected $table = 'user_chat';

    protected $fillable=[
        'sender_id',
        'chatroom_id',
        'message'
    ];

}