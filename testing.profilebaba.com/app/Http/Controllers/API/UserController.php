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
use App\UserLead;
use App\ExecutiveNumber;
use App\VendorCategory;
use App\VendorContactInformation;
use App\VendorServiceLocation;
use App\VendorOtherInformation;
use App\ReferNumber;
use Illuminate\Contracts\Session\Session as SessionSession;
use App\Category;
use Illuminate\Support\Carbon;



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
	
	
	public function saveUserLead(Request $request) {
        $plan['user_id'] =$request->user_id;
        
        $plan['status'] = '0';
        
        $plan['reciever_id'] = $request->reciever_id;
        $plan['source'] = $request->source;
        $plan['main_cat'] = $request->main_cat;
		$plan['location'] = $request->location;
		
        $res = UserLead::create($plan); 
		//echo '<pre>'; print_r($res); echo '</pre>';  die;
		if($res){
			return $this->sendResponse([], 'Generate new Lead!!');
		}else{
			return $this->sendResponse([], 'Not Generated!!');
		}

		

		
    }
	
	
	public function getUserQueries($id) {
        $result = $whatsapp_lead_array = $call_lead_array = $cdata = [];
        //echo $id; //die; 
		
		$whatsapp_data = UserLead::where('user_id', $id)->where('source', 'whatsapp')->get();
		$call_data = UserLead::where('user_id', $id)->where('source', 'call')->get(); 
		
		//echo '<pre>'; print_r($whatsapp_data); echo '<pre>'; die;
		//echo '<pre>'; print_r($call_data); echo '<pre>'; die;
		
		//$id - vendor id
		//{{live_url}}api/get-call-history/27 - this is vendor id
		//echo $id;
		
		if(!empty($whatsapp_data)){
			foreach ($whatsapp_data as $whatsapp_lead) {
				// Accessing individual attributes
				$id = $whatsapp_lead->id;
				$vendorId = $whatsapp_lead->user_id;
				$source = $whatsapp_lead->source;
				// ... access other attributes as needed

				// You can also access the attributes as an array
				$whatsapp_lead_array[] = $whatsapp_lead->attributesToArray();

				// Do something with the data...
				// For example, you can print the data:
				
			}
		}
		
		
		
		if(!empty($call_data)){
			foreach ($call_data as $call_lead) {
				// Accessing individual attributes
				$id = $call_lead->id;
				$vendorId = $call_lead->user_id;
				$source = $call_lead->source;
				// ... access other attributes as needed

				// You can also access the attributes as an array
				$call_lead_array[] = $call_lead->attributesToArray();

				// Do something with the data...
				// For example, you can print the data:
				
			}
		}
		
		//print_r($whatsapp_lead_array); //die;
		//print_r($call_lead_array); die;
		//die;
		
		
		if($whatsapp_lead_array){
            foreach($whatsapp_lead_array as $a=>$d) {
				
				//echo '<pre>'; print_r($d); echo '<pre>'; die;
                $id = $d['user_id'];
				$reciever_id = !empty($d['reciever_id'])?$d['reciever_id']:"";
				//$v_details = Vendor::where("user_id",$id)->first(); //die;
				//echo $id; die;
				$u_details = User::where("id",$id)->first();
				$v_details = Vendor::where('user_id', $reciever_id)->first();
				
				//print_r($u_details); die;
				//$v_details = Vendor::where('user_id', $id)->get();
				
				//{{live_url}}api/get-call-history/27 - this is vendor id
				
				if(empty($u_details)){
					return $this->sendResponse([], 'No details');
				}else{
					
					$user_name = !empty($u_details->name)?$u_details->name:""; //die;
					$catid = $d['main_cat'];
					$cat = Category::where("id",$catid)->first();
					//echo $cat->title;
					//echo '<pre>'; print_r($cat); echo '<pre>'; die;
					
					$vinfo = $u_details->contact_number; //die;
					
					//if($d->source=='whatsapp'){
						$res[$a]['id'] = $d['id'];
						$res[$a]['reciever_id'] = $d['reciever_id'];
						$res[$a]['category_id'] = $catid;
						$res[$a]['source'] = $d['source'];
						$res[$a]['location'] = $d['location'];
						$res[$a]['user_id'] = $id;
						
						$res[$a]['user_name'] = $user_name;
						$res[$a]['business_name'] = !empty($v_details->business_name)?$v_details->business_name:"";
						$res[$a]['category_title'] = !empty($cat->title)?$cat->title:"";
						
						
						$res[$a]['contact_number'] = !empty($vinfo)?$vinfo:"";
					//}
					
					//echo '<pre>'; print_r($res); echo '<pre>'; die;
					
					$cdata['wp_message'] = $res;
					//echo '<pre>'; print_r($res); echo '<pre>'; //die;
					
					
				}	
				
					
				
				
				//{{live_url}}api/get-call-history/27 - this is vendor id
					
					
				
				
				
            }
			
			//echo '<pre>'; print_r($cdata); echo '<pre>'; die;
			
        }
		
		
		
		if($call_lead_array){
            foreach($call_lead_array as $b=>$e) {
				
				//echo '<pre>'; print_r($d); echo '<pre>'; die;
                $id = $e['user_id'];
				$reciever_id = !empty($e['reciever_id'])?$e['reciever_id']:"";
				//$v_details = Vendor::where("user_id",$id)->first(); //die;
				//echo $id; die;
				$cu_details = User::where("id",$id)->first();
				$v_details = Vendor::where('user_id', $reciever_id)->first();
				
				
				//print_r($u_details); die;
				//$v_details = Vendor::where('user_id', $id)->get();
				
				//{{live_url}}api/get-call-history/27 - this is vendor id
				
				if(empty($cu_details)){
					return $this->sendResponse([], 'No details');
				}else{
					
					$user_name = !empty($cu_details->name)?$cu_details->name:""; //die;
					$catid = $e['main_cat'];
					$cat = Category::where("id",$catid)->first();
					//echo $cat->title;
					//echo '<pre>'; print_r($cat); echo '<pre>'; die;
					
					$vinfo = $cu_details->contact_number; //die;
					
					//if($d->source=='whatsapp'){
						$res[$b]['id'] = $e['id'];
						$res[$b]['reciever_id'] = $e['reciever_id'];
						$res[$b]['category_id'] = $catid;
						$res[$b]['source'] = $e['source'];
						$res[$b]['location'] = $e['location'];
						$res[$b]['user_id'] = $id;
						
						$res[$b]['user_name'] = $user_name;
						$res[$b]['business_name'] = !empty($v_details->business_name)?$v_details->business_name:"";
						$res[$b]['category_title'] = !empty($cat->title)?$cat->title:"";
						
						
						$res[$b]['contact_number'] = !empty($vinfo)?$vinfo:"";
					//}
					
					//echo '<pre>'; print_r($res); echo '<pre>'; die;
					
					$cdata['call'] = $res;
					//echo '<pre>'; print_r($res); echo '<pre>'; //die;
					
					
				}	
				
					
				
				
				//{{live_url}}api/get-call-history/27 - this is vendor id
					
					
				
				
				
            }
        }
		
		//echo '<pre>'; print_r($cdata); echo '<pre>'; die;
		//die;
		
		
		
		
		//echo '<pre>'; print_r($cdata); echo '<pre>'; die;
		
		//echo '<pre>'; print_r($d); echo '<pre>'; die;
		//echo '<pre>'; print_r($data); echo '<pre>'; die;
		
        //$result['call'] = $data;
		if(empty($cdata['call']) && empty($cdata['wp_message']) ){
			return $this->sendResponse('', 'No Data');
		}else{
		
			$result = $cdata;
			return $this->sendResponse($result, 'Call History');
		}	
    }
	
	
	
	public function userDelete($id){
        $u = User::where(['id'=> $id,'status'=>'1'])->get()->first();
        if($u){
            
			//echo '<pre>'; print_r($u); echo '</pre>';
			$u['is_delete'] = '1';
			$u['deleted_at'] = Carbon::now();
            $u->save();
			return $this->sendResponse("", 'Account Deleted');
        }
    }
	
}