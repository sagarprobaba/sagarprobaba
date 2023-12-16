<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Mail\UserRegister;
use App\Mail\forgetPassword;
use App\Models\Cpr_user_notification;
use App\Models\webUser;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class loginController extends Controller
{
    //
    public function index()
    {
        return view('web.login');
    }
    public function register()
    {
        return view('web.register');
    }
    public function registerUser(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|unique:web_users',
            'password' => 'required|confirmed',
        ]);
        $plan_date = Carbon::today();
        
           $old = webUser::where('phone',$request->phone)->where('account_type',$request->account_type)->first();
            if(isset($old))
            {
                return redirect()->back()->with('error','User Already Exist with This Mobile Number!');
            }
        // webUser::create($request->except('_token','password_confirmation','password')+['password'=>Hash::make($request->password)]+['plan_date'=>$plan_date]);
            $data = new webUser();
            $data->firstName = $request->firstName;
            $data->lastName = $request->lastName;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->account_type = $request->account_type;
            $data->plan_date = Carbon::today();
            $data->password = Hash::make($request->password);
            $data->save();
        $otp = '0000';
        Mail::to($request->email)->send(new UserRegister($otp));

        session()->put('otp',$otp);
        session()->put('email',$request->email);


        return redirect(route('login'))->with('success','User Register Successfully!.An OTP send to your register Email-Id');
    }
    public function submitlogin(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
            if(session()->has('otp'))
            {
                $request->validate([
                    'otp' => 'required',
                ]);
                if(session()->get('otp')==$request->otp)
                {
                    if (Auth::guard('webUser')->attempt(['email' => $request->email, 'password'=>$request->password])) {
                        session()->forget('otp');
                        session()->forget('email');
                        Cpr_user_notification::insert(['user_id'=>Auth::guard('webUser')->user()->id,'title'=>'Signup Success','notification'=>'Your Account Has Been Registered successfully!']);
                        return redirect()->route('userdashboard');
                    }
                    else
                    {
                        session()->flash('error', 'Email Or Password Was Incorect.');
                        return redirect()->back();
                    }
                }
                else
                {
                    return redirect()->back()->with('error','Incorrect OTP');
                }
            }
            else
            {
                if (Auth::guard('webUser')->attempt(['email' => $request->email, 'password'=>$request->password])) {
                    return redirect()->route('userdashboard');
                }
                else
                {
                    session()->flash('error', 'Email Or Password Was Incorect.');
                    return redirect()->back();
                }
            }
            
    }
    public function logout(Request $request) {
        $request->session()->flush();       
        return redirect('/')->with('success','Sign-out Successfully');      
    }
    public function resendOTP()
    {
        Mail::to(session()->get('email'))->send(new UserRegister(session()->get('otp')));
        return redirect(route('login'))->with('success','An OTP re-send to your register Email-Id');
    }
    static function socialLogin($user)
    {
        $log = webUser::where('email',$user->email)->first();
        if(!$log)
        {
            $log = new webUser();
            $log->firstName =$user->name;
            $log->email =$user->email;
            $log->provider_id =$user->id;
            $log->avatar =$user->avatar;
            $log->plan_date = Carbon::today();
            $log->save();
        }
        Auth::guard('webUser')->login($log);
       
    }
    public function loginWOA()
    {
        session()->forget('otp');
        webUser::where('email',session()->get('email'))->delete();
        session()->forget('email');
        return redirect(route('login'));
    }
    
    public function forgotPassword()
    {
        return view('web.forgotPassword');
    }
    public function fpassword(Request $request)
    {
       $data = webUser::where('email',$request->email)->first();
       if($data)
       {
        $otp = rand(111111,999999);
        Mail::to($request->email)->send(new forgetPassword($otp));
        session()->put('fotp',$otp);
        session()->put('femail',$request->email);
        return redirect()->back()->with('success','An OTP send to your Email-Id');
       }
       else
       {
        return redirect()->back()->with('error','Invalid Email Id');
       }
    }
    public function otpmatch(Request $request)
    {
            if(session()->get('fotp') == $request->otp)
            {
                session()->forget('fotp');
                return redirect()->back();
            }
            else
            {
                return redirect()->back()->with('error','Please Enter Correct OTP !');
            }   
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password'=>'required|confirmed',           
        ]);
        webUser::where('email',session()->get('femail'))->update(['password'=>Hash::make($request->password)]);        
        session()->forget('femail');
        return redirect(route('login'))->with('success','Your Password Has Been changed Successfully');
    }
    public function resendFotp()
    {
        Mail::to(session()->get('femail'))->send(new forgetPassword(session()->get('fotp')));
        return redirect()->back()->with('success','An OTP re-send to your register Email-Id');
    }
    public function flogin()
    {
        if(session()->has('fotp'))
        {
            session()->forget('fotp');
        }
        if(session()->has('femail'))
        {
            session()->forget('femail');
        }               
        return redirect(route('login'));
    }
}
