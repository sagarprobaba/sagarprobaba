<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Notification;

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

class NotificationController extends BaseController 
{
    use Firebase;

    public static function saveNotification($data) {
        Notification::create($data);
    }

    public function get_notification($user) {
        $data = Notification::where('user_id',$user)->get();
        return $this->sendResponse($data, 'Notification List!!');
    }

    public function update_notification($id) {
        $data = Notification::find($id);
        $data['status'] = '1';
        $data->save();
        return $this->sendResponse($data, 'Notification Read!!');
    }

    public function notification_count($user) {
        $data = Notification::where(['user_id'=>$user,"status"=>'0'])->count();
        return $this->sendResponse(["count" => $data], 'Notification Count!!');
    }
    
}