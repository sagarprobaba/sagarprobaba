<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SMSController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests;
use App\Traits\Firebase;

use App\User;
use App\Admin;
use App\GuestUser;

use Auth;
use Response;
use Mail;
use Validator;
use Redirect;
use DB;
use Image;
use Hash;
use Session;
use App\Classes\GeniusMailer;
use Laravel\Socialite\Facades\Socialite;

use Softon\Indipay\Facades\Indipay;

class UserController extends Controller
{
    use Firebase;

    public function register(Request $request){
        $this->validate($request, [
            'name' => 'required',
			'email' => 'required|unique:users,email',
            'password' => 'required',
            'contact_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:users,contact_number',
		]);

        $records = $request->all();
        $hashed_password = Hash::make($request->password);
        $records['password'] = $hashed_password;
        $records['token'] = Hash::make(Str::random(60));
        $records['status'] = '0';
        $records['is_vendor'] = '0';
        $records['register_by'] = 'web';
        $user = User::create($records);

        if ($user) {

            $this->verifyUser_sendEmailandSms($user);

            $data = ['user_id'=>$user->id, 'portal'=>'web'];

            $fcmNotification = [
                'to'        => Admin::find(1)->device_key,
                'notification' => $data,
                'data' => ['message'=>'User Register']
            ];
            $this->firebaseNotification($fcmNotification);

            return response()->json(array('status' => 1, 'msg' => 'Your account has created successfully . You may login after your account activated by administrator .','user'=>$user->id));
        } else {
            return response()->json(array('status' => 2, 'msg' => 'Something went wrong, Try Again!!'));
        }
    }

    public function profile_edit(){
        $item = Auth::user();

        return view('user.profile_edit',compact(
            'item'
        ));

    }
    public function profile_edit_save(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.Auth::user()->userid.',userid',
            'contact_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:users,contact_number,'.Auth::user()->userid.',userid',
		]);

        $records = $request->all();

        if ($request->hasFile('profile_photo')) {
			if ($request->file('profile_photo')->isValid()) {

				$fileName=$request->file('profile_photo')->getClientOriginalName();
				$fileName =time()."_".$fileName;

				//upload
				$image = $request->file('profile_photo');
				$directory = base_path('/uploads/users/');
				$imageUrl = $directory.$fileName;

				Image::make($image)->resize(300, 300)->save($imageUrl);
				$records['profile_photo']=$fileName;
			}
		}
        $item = User::find(Auth::user()->userid);
        $item->fill($records);
		$item->save();

        return Redirect::back()->with('message', 'Successfully Updated!');
    }

    function login(Request $request){
		$this->validate($request, [
			'mobile' => "required|min:10|regex:/^([0-9\s\-\+\(\)]*)$/",
			'password' => "required",
		]);

		if(Auth::attempt(['contact_number' => $request->mobile, 'password' => $request->password])){

			$user=Auth::user();
			Auth::login($user);
			return 1;
		}else{
			return Redirect::back()->with('message', 'Something went wrong, Try Again!!');
		}
	}


    public function verifyUser_sendEmailandSms($user){
        $data = [
            'to' => $user->email,
            'type' => 'email_verify_mail',
            'user_name' => $user->name,
            'email' => $user->email,
            'mobile' => $user->contact_number,
        ];
        $mailer = new GeniusMailer();
        $mailer->sendAutoMail($data);

        $mobile_otp = rand(100000,999999);
        Session::put('mobile_otp', $mobile_otp);

        $sms_msg= $mobile_otp." is your Profilebaba OTP to verify your mobile number. Don't share it with anyone.";

        $SMSController=new SMSController;
        $SMSController->sms_send($user->contact_number,$sms_msg);
    }

    public function show_verify_otp($id) {
        $data = $id;
        return view('auth.otp_login',compact(
            'data'
        ));
    }    

    public function verify_otp($id, Request $request) {
        $this->validate($request, [
            'mobile_otp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:6',
		]);

        if($request->mobile_otp == Session::get('mobile_otp')){
            $user = User::find($id);
            $user['status'] = '1';
            $user->save();
            return Redirect::route('login');
        }
        else{
			return Redirect::back()->with('message', 'Mismatched Otp, Try again!!');
		}
    }

    public function check_active()
    {
        if (Auth::check()){
            if (Auth::user()->status == 1){
                return true;
            }
        }
        return false;
    }

    function dashboard() {
        return view('user.dashboard');
    }

    function user_enquiry() {

        $item = Auth::user();
        return view('user.user_enquiry',array('item' => $item));

    }

    function user_enquiry_send() {

        $item = Auth::user();
        return view('user.user_enquiry_send',array('item' => $item));
    }


    function otp_login() {
        return view('auth.otp_login');
    }

    public function changepassword()
    {
        return view('auth.changepassword');
    }

    public function changepasswordsave(Request $request){

        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password',
        ]);

        if (Hash::check($request->old_password, Auth::user()->password)) {
            $user_id = Auth::user()->userid;
            $obj_user = User::find($user_id);
            $obj_user->password = Hash::make($request->confirm_password);;
            $obj_user->save();
            return redirect()->back()->with('message', 'Password changed successfully !');
        }
        return redirect()->back()->with('error', 'Wrong password. Try again.');
    }

    public function saveUserToken(Request $request) {
        if(Auth::user()) {
            $user = User::where("id",Auth::user()->userid)->first();
            $user['device_key'] = $request->fcm_token;
            $user->save();
        }
        else{
            $ip = $_SERVER['REMOTE_ADDR'];
            $user = GuestUser::where('ip',$ip)->first();
            if($user){
                $user['device_key'] = $request->fcm_token;
                $user->save();
            }
            else{
                $user['ip'] = $ip;
                $user['device_key'] = $request->fcm_token;
                GuestUser::create($user);
            }
        }
        return response()->json(['token saved successfully.']);
    }

}
