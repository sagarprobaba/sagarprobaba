<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\SMSController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Validator;
use Session;
use Hash;

use App\Vendor;
use App\User;
use App\ExecutiveNumber;
use App\VendorCategory;
use App\VendorContactInformation;
use App\VendorServiceLocation;
use App\VendorOtherInformation;
use App\ReferNumber;
use Illuminate\Contracts\Session\Session as SessionSession;

class UserController extends BaseController
{
    public function user_profile($id){
        $user = User::where('id',$id)->first();
        if($user->is_vendor == 1) {
            $vendor = Vendor::where('user_id', $id)->get();
            foreach($vendor as $key => $v) {
                $category = VendorCategory::where(['vendor_id'=>$v['id']])->with('category',function ($query) {})->get();
                $vendor[$key]['category'] = $category;
                $contact_info = VendorContactInformation::where(['vendor_id'=>$v['id']])->get();
                $vendor[$key]['contact_info'] = $contact_info;
                $service_location = VendorServiceLocation::where(['vendor_id'=>$v['id']])->get();
                $vendor[$key]['service_location'] = $service_location;
                $other_info = VendorOtherInformation::where(['vendor_id'=>$v['id']])->get();
                $vendor[$key]['other_info'] = $other_info;
            }
            $user['business_profile'] = $vendor;
        }
        return $this->sendResponse($user, 'User Profile');
    }

    public function user_validate(Request $request){
        $user = User::where('contact_number', $request->phone_number)->first();
        if($user){
            return $this->sendError('Phone Number already exists', []);
        }
        else{
            return $this->sendResponse([], 'Success');
        }
    }

    public function edit_user_profile(Request $request, $id){
        $user = User::where('id',$id)->first();
        if ($request->hasFile('profile_pic')) {
			if ($request->file('profile_pic')->isValid()) {

				$fileName=$request->file('profile_pic')->getClientOriginalName();
				$fileName =time()."_".$fileName;

				//upload
				$request->file('profile_pic')->move('uploads/users/', $fileName);
				$user['profile_pic']=$fileName;
			}
		}
        if($request->name && $request->name != ""){
            $user['name'] = $request->name;
        }
        if($request->lastname && $request->lastname != ""){
            $user['lastname'] = $request->lastname;
        }
        
        if($request->company_category && $request->company_category != ""){
            $user['company_category'] = $request->company_category;
        }
        
        if($request->plan && $request->plan != ""){
            $user['plan'] = $request->plan;
        }
        
        if($request->company_name && $request->company_name != ""){
            $user['company_name'] = $request->company_name;
        }
        
        if($request->company_email && $request->company_email != ""){
            $user['company_email'] = $request->company_email;
        }
        
        if($request->company_phone && $request->company_phone != ""){
            $user['company_phone'] = $request->company_phone;
        }
        
        
        if($request->company_address && $request->company_address != ""){
            $user['company_address'] = $request->company_address;
        }
        
        if($request->about_company && $request->about_company != ""){
            $user['about_company'] = $request->about_company;
        }
        
        if($request->latitude && $request->latitude != ""){
            $user['latitude'] = $request->latitude;
        }
        
        if($request->longitude && $request->longitude != ""){
            $user['longitude'] = $request->longitude;
        }
        
        
        if($request->email && $request->email != ""){
            $user['email'] = $request->email;
        }
        if($request->password && $request->password != ""){
            $user['password'] = Hash::make($request->password);
        }
        $user->save();
        
        $user['profile_pic'] = $user['profile_pic'] !="" ? env('APP_URL')."/uploads/users/".$user['profile_pic'] : env('APP_URL')."/uploads/default-user-image.png";
        
        return $this->sendResponse($user, 'User Profile Updated');
    }

    public function add_executive_number(Request $request){
        $validator = Validator::make($request->all(), [
            'contact_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:executive_number,contact_number',
        ]);
        if($validator->fails()){
            return $this->sendError('Error validation', $validator->errors());
        }

        $number['contact_number'] = $request->contact_number;
        ExecutiveNumber::create($number);
        return $this->sendResponse([], 'Number Added');
    }

    public function get_executive_number(Request $request){
        $number = ExecutiveNumber::where(['status' => '1'])->get();
        return $this->sendResponse($number, 'Executive Numbers');
    }

    public function refer_number(Request $request){
        $number = $request->contact_number;
        $user = $request->user_id;
        $refer['user_id'] = $user;
        foreach ($number as $num) {
            $refer['phone_number'] = $num;
            ReferNumber::create($refer);
        }
        return $this->sendResponse([], 'Refer successfully');
    }
}