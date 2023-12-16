<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Setting;
use App\User;
use App\Category;
use App\Vendor;
use App\VendorLead;
use App\VendorContactInformation;
use App\Chat;
use App\Admin;
use App\ChatHistory;
use App\GuestUser;

use App\Traits\Firebase;

use Auth;
use Response;
use Mail;
use Validator;
use Redirect;
use DB;
use Image;
use Hash;
use App\Classes\GeniusMailer;
use Laravel\Socialite\Facades\Socialite;

use Softon\Indipay\Facades\Indipay;

class ChatController extends Controller {
    use Firebase;

    public function createWebChat(Request $request)
	{
		$message = $request['message'];
        $chatList = 0;
        if(Auth::user()) {
            $past = Chat::where(['sender_id'=>Auth::user()->id, 'sender_type'=>'user'])->first();
            if($past) {
                $addchat = new ChatHistory([
                    'sender_id' => Auth::user()->id,
                    'message' => $message,
                    'sender' => 'user',
                    'chat_id' => $past->id
                ]);
                $addchat->save();
                $condition = $past->assigned_to == 0 && $past->status == '0';
                $chatdata = ["chat_id"=>$condition ? $past->id : $addchat->id,"type"=>$condition ? "new" : "history"];
                $notify_title = Auth::user()->name." sent a Message";
                $to = $past->assigned_to == 0 ? Admin::find(1)->device_key : $past->assigned->device_key;
            }
            else{
                $addchat = new Chat([
                    'sender_id' => Auth::user()->id,
                    'message' => $message,
                    'sender_type' => 'user'
                ]);
                $addchat->save();
                $chatdata = ["chat_id"=>$addchat->id,"type"=>"new"];
                $chatList = 1;
                $notify_title = "New query from ".Auth::user()->name;
                $to = Admin::find(1)->device_key;
            }
        }
        else{
            $ip = $_SERVER['REMOTE_ADDR'];
            $guest = GuestUser::where('ip',$ip)->first();
            $past = Chat::where(['sender_id'=>$guest->id, 'sender_type'=>'guest'])->first();
            if($past) {
                $addchat = new ChatHistory([
                    'sender_id' => $guest->id,
                    'message' => $message,
                    'sender' => 'user',
                    'chat_id' => $past->id
                ]);
                $addchat->save();
                $condition = $past->assigned_to == 0 && $past->status == '0';
                $chatdata = ["chat_id"=>$condition ? $past->id : $addchat->id,"type"=>$condition ? "new" : "history"];
                $notify_title = "Guest User sent a Message";
                $to = $past->assigned_to == 0 ? Admin::find(1)->device_key : $past->assigned->device_key;
            }
            else{
                $addchat = new Chat([
                    'sender_id' => $guest->id,
                    'message' => $message,
                    'sender_type' => 'guest'
                ]);
                $addchat->save();
                $chatdata = ["chat_id"=>$addchat->id,"type"=>"new"];
                $chatList = 1;
                $notify_title = "New query from Guest user";
                $to = Admin::find(1)->device_key;
            }
        }

        $chat = [];
        if($chatList == 1) {
            $chat['sender'] = 'admin';
            $chat['message'] = "Please provide us your Name and Contact number, our executive will connect with you within 10 minutes!!";
        }

        $data = [
            "to" => $to,
            "notification" => [
                "title" => $notify_title,
                "body" => [
                    "message" => $message,
                    "chat" => $chatdata['chat_id'],
                    "type" => $chatdata['type']
                ]
            ]
        ];
        $this->firebaseNotification($data);

		return $chat;

	}

    public function getChat(Request $request){
        if($request->chat_id == 0){
            if(Auth::user()){
                $user = Auth::user()->id;
                $type = 'user';
                $history = Chat::where(['sender_id'=>$user,'sender_type'=>$type])->whereIn('status',['0','1','2'])->first();
                if($history){
                    $chat = ChatHistory::where('chat_id',$history->id)->get()->toArray();
                    return $chat;
                }
            }
            return [];
        }
        else{
            $chat = ChatHistory::find($request->chat_id);
            return $chat->message;
        }
    }

    public function getVendorForChat(Request $request){
        $vendor = VendorLead::where('chat_id',$request->chat_id)->get();
        $data = [];
        foreach($vendor as $v) {
            if($v->vendor_type == 'vendor'){
                $list['business_name'] = $v->vendor->business_name;
                $list['mobile_number'] = VendorContactInformation::where('vendor_id',$v->vendor_id)->first()->mobile_number;
            }
            else{
                $list['business_name'] = $v->google->name;
                $list['mobile_number'] = $v->google->phone;
            }
            array_push($data, $list);
        }
        return $data;
    }
}