<?php

namespace App\Http\Controllers\Admin;

use App\Chat;
use Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Traits\Firebase;

class AssignChatController extends Controller
{
    use Firebase;
    
    public function index(Request $request){
        $chat = Chat::get();
        return view('admin.assignchat.index',array('chat'=>$chat));
    }

    public function assign($id)
    { 
        $chat = Chat::find($id);
        return view('admin.assignchat.assign',array('chat'=>$chat));
    }

    public function assign_query(Request $request) {
        $chat = Chat::find($request->chat_id);
        $chat['assigned_to'] = $request->assigned_to;
        $chat['status'] = '1';
        $chat->save();

        $data = [
            "to" => $chat->assigned->device_key,
            "notification" => [
                "title" => "Assigned a New Query",
                "body" => [
                    "message" => "New Query from ".$chat->sender_type,
                    "chat" => $chat->id
                ]
            ]
        ];
        $this->firebaseNotification($data);
        $chat = Chat::get();
        return view('admin.assignchat.index',array('chat'=>$chat));
    }

    public function viewQuery($id)
    { 
        $chat = Chat::find($id);
        return view('admin.assignchat.view',array('chat'=>$chat));
    }
}