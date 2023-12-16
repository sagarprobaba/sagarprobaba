<?php

namespace App\Http\Controllers\Admin;

use App\Chat;
use App\ChatHistory;
use App\User;
use App\GuestUser;

use Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Firebase;

class WebChatController extends Controller
{
    use Firebase;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        $id = session('id') == 1 ? 0 : session('id');

        $chat = Chat::where('assigned_to',$id)->orderBy('id','DESC')->get();
        $first = Chat::where('assigned_to',$id)->orderBy('id','DESC')->first();
        $view = view('admin.webchat.chat_message',compact('first'))->render();
        return view('admin.webchat.index',array('chat'=>$chat,'view'=>$view));
    }

    public function openChat(Request $request)
    { 
        $first = Chat::find($request->chat_id);
        $view = view('admin.webchat.chat_message',compact('first'))->render();
        return $view;
    }

    public function createChat(Request $request)
    {
        $chat = [];
        $chat['sender_id'] = session('id') == 1 ? 0 : session('id');
        $chat['sender'] = 'admin';
        $chat['chat_id'] = $request->chat_id;
        $chat['message'] = $request->message;
        $history = ChatHistory::create($chat);

        $user = Chat::find($chat['chat_id']);
        if($user->sender_type == 'guest'){
            $to = GuestUser::find($user->sender_id)->device_key;
        }
        else {
            $to = User::find($user->sender_id)->device_key;
        }
        $user['status'] = '2';
        $user->save();

        $data = [
            "to" => $to,
            "notification" => [
                "title" => "New Message From Profile Baba",
                "body" => [
                    "message" => $chat['message'],
                    "chat" => $history->id,
                    "type" => "history"
                ]
            ]
        ];
        $this->firebaseNotification($data);
    }

}