<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\API\NotificationController as NotificationController;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Setting;
use App\User;
use App\Category;
use App\Vendor;
use App\UserChat;
use App\UserChatRoom;
use App\Chat;
use App\ChatHistory;
use App\Admin;
use App\VendorLead;
use App\VendorCategory;
use App\VendorContactInformation;

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
use App\Traits\Firebase;

use Softon\Indipay\Facades\Indipay;

class ChatController extends BaseController 
{
    use Firebase;

    public function create_chat(Request $request)
	{
        DB::enableQueryLog();
        $query = "SELECT * from user_chatroom where (user1=".$request->sender_id." and user2=".$request->receiver_id.") or (user1=".$request->receiver_id." and user2=".$request->sender_id.") limit 1";
        $select = DB::select($query);
        $chat = [];
        if(count($select) > 0){
            $chat = $select[0];
        }
        $type = "history";
        $plan = [];
        $planUser = $request->vendor == "receiver" ? $request->sender_id : $request->receiver_id;
        // print_r($chat);
        // dd();
        // dd(DB::getQueryLog());
        if(!$chat){
            $data['user1'] = $request->sender_id;
            $data['user2'] = $request->receiver_id;
            $chat = UserChatRoom::create($data);
            $type = "new";
            $plan['vendor_id'] = $request->vendor == "receiver" ? $request->receiver_id : $request->sender_id;
            $plan['vendor_type'] = "vendor";
            $plan['status'] = '0';
        }
		$message = $request->message;

        $addchat = new UserChat([
            'sender_id' => $request->sender_id,
            'chatroom_id' => $chat->id,
            'message' => $message
        ]);
        $addchat->save();

        if($plan){
            $plan['chat_id'] = $addchat->id;
            $lead = $this->checkVendorLead($plan['vendor_id'],$planUser,$plan['chat_id'],0);
            if($lead){
                VendorLead::create($plan);
            }
        }

        if($request->vendor == "receiver"){
            $token = Vendor::where(['id'=>$request->receiver_id])->first()->user->device_key;
        }
        else{
            
            $token = User::where(['id'=>$request->receiver_id])->first()->device_key;
        }
        if($request->vendor == "receiver"){
            $notify_title = User::find($request->sender_id)->name." sent a Message";
        }
        else{
            $notify_title = Vendor::find($request->sender_id)->business_name." sent a Message";

        }

        $data = [
            "to" => $token,
            "notification" => [
                "title" => $notify_title,
                "body" => [
                    "message" => $message,
                    "chat" => $chat->id,
                    "type" => $type,
                    "chat_with" => "web"
                ]
            ]
        ];
        $this->firebaseNotification($data);
        if($request->vendor == "receiver"){
            NotificationController::saveNotification(["message"=>$notify_title,"user_id"=>Vendor::where(['id'=>$request->receiver_id])->first()->user->id]);
        }
        else{
            NotificationController::saveNotification(["message"=>$notify_title,"user_id"=>User::where(['id'=>$request->receiver_id])->first()->id]);
        }

		return $this->sendResponse([], 'Message Sent');

	}

    public function get_chat($user_id) {
        //echo $user_id; die;
		
		$vendor = Vendor::where('user_id',$user_id)->get();
        $data = [];
        if($vendor){
            foreach($vendor as $v){
                //echo '<pre>'; print_r($v); echo '</pre>'; die;
				
				$chatHistory = UserChatRoom::where(['user1'=>$v['id']])->orWhere(['user2'=>$v['id']])->get();
				//echo '<pre>'; print_r($chatHistory); echo '</pre>'; die;
				
				/*echo $v['id'];
				$query = UserChatRoom::where(['user1'=>$v['id']])->orWhere(['user2'=>$v['id']]);
				$sql = $query->toSql();

				echo $sql;*/ //die;
				
                foreach($chatHistory as $chat){
					//echo '<pre>'; print_r($chat); echo '</pre>'; die;
					
                    //echo $key = 'user2'; die;
                    if($v['id'] == $chat->user1){
                        $key = 'user1';
                    }
                    if($key == 'user1'){
                        
						
						$chat['vendor_id'] = $chat->user1;
                        $chat['sender_id'] = $chat->user2;
                        $chat['vendor'] = $v['business_name'];
						
						//echo $v['id'];
						
						$category = VendorCategory::where(['vendor_id'=>$v['id']])->first();
						
						/*$query = VendorCategory::where(['vendor_id'=>$v['id']]);
						$sql = $query->toSql();

						echo $sql;*/
						
						//echo $v['business_name'];
						//echo '<pre>'; print_r($category); echo '</pre>'; //die;
						$catid = $category->category_id;  //die;
						
						$cat = Category::where("id",$catid)->first();
						//echo $cat->title;
						//echo '<pre>'; print_r($cat); echo '</pre>';
						
						//die;
						
                        $chat['category'] = $cat->title;
                        $user = User::where(['id'=>$chat->user2])->first();
                        $chat['sender'] = $user->name;
                        $chat['friend_profile_pic'] = $user->profile_pic !="" ? env('APP_URL')."/uploads/users/".$user->profile_pic : env('APP_URL')."/uploads/default-user-image.png";
                    }
                    else{
                        
						
						$chat['sender_id'] = $chat->user1;
                        $chat['vendor_id'] = $chat->user2;
                        $user = User::where(['id'=>$chat->user1])->first();
                        $chat['sender'] = $user->name;
                        $chat['vendor'] = $v['business_name'];
                        $category = VendorCategory::where(['vendor_id'=>$v['id']])->first();
                        $chat['category'] = $category->category->title;
                        $chat['friend_profile_pic'] = $user->profile_pic !="" ? env('APP_URL')."/uploads/users/".$user->profile_pic : env('APP_URL')."/uploads/default-user-image.png";
                    }
                    
                    $chat['chat'] = $chat->chat;
					
					//echo '<pre>'; print_r($chat); echo '</pre>'; die;
					
                    array_push($data,$chat);
                }
            }
        }
         
			//echo '<pre>'; print_r($data); echo '</pre>'; die;
		  
        // Sort the array 
        /*usort($data, function ($element1, $element2) {
            $datetime1 = strtotime($element1['chat'][count($element1['chat'])-1]['created_at']);
            $datetime2 = strtotime($element2['chat'][count($element2['chat'])-1]['created_at']);
            return $datetime2 - $datetime1;
        });*/
		
		
		
        return $this->sendResponse($data, 'Chat History of User');
    }

    public function get_chat_history($chat) {
        $chatHistory = UserChat::where(['chatroom_id'=>$chat])->get();
		
		/*$query = UserChat::where(['chatroom_id'=>$chat]);
		$sql = $query->toSql();

		echo $sql;*/
		
        $data = [];
		//print_r($chatHistory); die;
        foreach($chatHistory as $chat){
			//echo $chat->sender_id; die;
			
            $user =  User::where(['id'=>$chat->sender_id])->first();
            $chat['sender_name'] = $user->name;
            $chat['sender_profile_pic'] = $user->profile_pic !="" ? env('APP_URL')."/uploads/users/".$user->profile_pic : env('APP_URL')."/uploads/default-user-image.png";
            array_push($data,$chat);
        }
        return $this->sendResponse($data, 'Chat History');
    }

    public function createWebChat(Request $request)
	{
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'message' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Error validation', $validator->errors());
        }

		$message = $request['message'];
        $user = $request['user_id'];
        $chatList = 0;
            $past = Chat::where(['sender_id'=>$user, 'sender_type'=>'user'])->first();
            if($past) {
                $addchat = new ChatHistory([
                    'sender_id' => $user,
                    'message' => $message,
                    'sender' => 'user',
                    'chat_id' => $past->id
                ]);
                $addchat->save();
                $condition = $past->assigned_to == 0 && $past->status == '0';
                $chatdata = ["chat_id"=>$condition ? $past->id : $addchat->id,"type"=>$condition ? "new" : "history"];
                $notify_title = User::find($user)->name." sent a Message";
                $to = $past->assigned_to == 0 ? Admin::find(1)->device_key : $past->assigned->device_key;
            }
            else{
                $addchat = new Chat([
                    'sender_id' => $user,
                    'message' => $message,
                    'sender_type' => 'user'
                ]);
                $addchat->save();
                $chatdata = ["chat_id"=>$addchat->id,"type"=>"new"];
                $chatList = 1;
                $notify_title = "New query from App";
                $to = Admin::find(1)->device_key;
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
                    "type" => $chatdata['type'],
                    "chat_with" => "admin"
                ]
            ]
        ];
        $this->firebaseNotification($data);

        return $this->sendResponse($chat, 'Sent');

	}

    public function get_admin_chat($id) {
        $chatHistory = Chat::where(['sender_id'=>$id])->get();
        $data = [];
        foreach($chatHistory as $chat){
            $chat['history'] = ChatHistory::where(['chat_id'=>$chat->id])->get();
            array_push($data,$chat);
        }
        return $this->sendResponse($data, 'Chat History');
    }

    public function getVendorForChat($chat_id){
        $vendor = VendorLead::where('chat_id',$chat_id)->get();
        $data = [];
        foreach($vendor as $v) {
            if($v->vendor_type == 'vendor'){
                $list['name'] = $v->vendor->business_name;
                $list['register_by'] = User::where('id',$v->vendor->user_id)->first()->register_by;
                $list['mobile_number'] = VendorContactInformation::where('vendor_id',$v->vendor_id)->first()->mobile_number;
            }
            else{
                $list['name'] = $v->google->name;
                $list['register_by'] = '';
                $list['mobile_number'] = $v->google->phone;
            }
            array_push($data, $list);
        }
        return $this->sendResponse($data, 'Sent');
    }

}