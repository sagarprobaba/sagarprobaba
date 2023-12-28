<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\SMSController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Grimzy\LaravelMysqlSpatial\Types\Point;


use App\Http\Controllers\API\VendorController;

use GuzzleHttp;
use GuzzleHttp\Client;

use Validator;
use Session;
use Hash;
use DB;
use CustomValue;

use App\User;
use App\ForgotPassword;
use App\MembershipPlan;
use App\GuestUser;
use App\Vendor;
use App\Admin;
use App\VendorCategory;
use App\VendorContactInformation;
use App\VendorServiceLocation;
use App\VendorRating;
use App\VendorLead;
use App\QueryForVendor;
use App\GoogleVendor;
use App\Category;
use App\ScrapperHost;
use App\VendorPlan;
use App\VendorList;

use Illuminate\Contracts\Session\Session as SessionSession;

class AuthController extends BaseController
{

    public function checkMobile(Request $request){
        $contact = $request['contact_number'];

        $user = User::where('contact_number',$contact)->first();

        if($user){
            $user['vendor'] = $user->vendor;
            return $this->sendResponse($user, 'User found');
        }

        return $this->sendResponse([], 'No User found');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'contact_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ]);

        if($validator->fails()){
            return $this->sendError('Error validation', $validator->errors());
        }

        $authUser = User::where(['contact_number'=> $request->contact_number])->get()->first();
        if($authUser){
            if(Hash::check($request->password,$authUser->password)){
                if($authUser->status == '1' && $authUser->is_delete == '0'){
                    $success['token'] =  $authUser->token;
                    $success['user'] =  $authUser;
                    $authUser['device_key'] = $request->device_key;
                    $authUser['is_logged_in'] = '1';
                    $authUser->save();
                    $success['user']['profile_pic'] = $success['user']['profile_pic'] != "" ? env('APP_URL')."/uploads/users/".$success['user']['profile_pic'] : env('APP_URL')."/uploads/default-user-image.png";
                    return $this->sendResponse($success, 'User login successfully');
                }
                else{
                    return $this->sendError('User is not verified', [], 401);
                }
            }
            else{
                return $this->sendError('Invalid Password', [], 401);
            }
        }
        else{
            return $this->sendError('Invalid User', [], 401);
        }
    }

    public function register(Request $request)
    {
        
        //dd($request->contact_number);
		//echo $request->is_vendor; die;
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'lastname' => 'required',
            'password' => 'required',
            'contact_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ]);

        if($validator->fails()){
            return $this->sendError('Error validation', $validator->errors());
        }
        
        $users = User::where("contact_number",$request->contact_number)->first();
        
        
        
        if($users){
            if($users['status'] == '0'){
                return $this->sendError('Error', ['error'=>'User Not Verified']);
            }
            else{
                return $this->sendError('Error', ['error'=>'User Already Exists']);
            }
        }
        
        

        $records = $request->all();
        
        
        
        $hashed_password = Hash::make($request->password);
        $records['password'] = $hashed_password;
        $records['token'] = Hash::make(Str::random(60));
        $records['status'] = '0';
        $records['is_vendor'] = $request->is_vendor;
        $records['register_by'] = 'app';
        $records['lastname'] = $request->lastname;
        
        $records['company_category'] = $request->company_category;
        $records['plan'] = $request->plan;
        $records['company_name'] = $request->company_name;
        $records['company_email'] = $request->company_email;
        $records['company_phone'] = $request->company_phone;
        
        $records['company_address'] = $request->company_address;
        $records['about_company'] = $request->about_company;
        $records['latitude'] = $request->latitude;
        $records['longitude'] = $request->longitude;
        
        $user = User::create($records);
        

        $success['token'] =  $user->token;
        $success['name'] =  $user->name;
        $success['lastname'] =  $user->lastname;
        $success['user_id'] =  $user->id;

        if($user) {
            $otp = rand(100000,999999);
            $sms_msg= "Your otp is ".$otp." SELECTIAL";

            $SMSController=new SMSController;
            $response = $SMSController->sms_send($user->contact_number, $sms_msg);

            if($otp) {
                $success['mobile'] = $user->contact_number;
                $success['otp'] = $otp;
                $data = $success;
                $data['user_id'] = $user->id;
                $data['otp'] = $otp;
                $data['verify_type'] = "register";
                ForgotPassword::create($data);
            }
            else{
                return $this->sendError('Error', ['error'=>'Something went wrong, Try Again!!']);
            }
            return $this->sendResponse($success, 'Otp sent on your registered mobile number');
        }
        else{
            return $this->sendError('Unauthorised.', [], 400);
        }
    }

    public function add_vendor(Request $request) {
        $new = false;
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required',
            'contact_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ]);

        if($validator->fails()){
            return $this->sendError('Error validation', $validator->errors());
        }
        
        $data = $request;
        $u = User::where(['contact_number'=> $data['contact_number'],'status'=>'1'])->get()->first();
        if($u){
            
			//echo '<pre>'; print_r($u); echo '</pre>';
			$u['is_vendor'] = '1';
            $u->save();
        }
        else{
            $user['name'] = $data['name'];
            $user['contact_number'] = $data['contact_number'];
            $user['password'] = Hash::make($data['password']);
            $user['token'] = Hash::make(Str::random(60));
            $user['is_vendor'] = '1';
			
			
			$records['company_category'] = $data['company_category'];
			
			$records['company_name'] = $data['company_name'];
			$records['company_email'] = $data['company_email'];
			$records['company_phone'] = $data['company_phone'];
        
			$records['company_address'] = $data['company_address'];
			$records['about_company'] = $data['about_company'];
			//$records['latitude'] = $request->latitude;
			//$records['longitude'] = $request->longitude;
			
			$u = User::create($user);
            $new = true;
        }
            
			

			// Dump and Die
			//dd($u->toSql());

			$vendor['user_id'] = $u->id;
            $business = $data['business_name'] ?? $data['name'];
            $vendor['business_name'] = $business;
            $vendor['slug'] = str_replace(' ','-',strtolower($business));
            $vendor['status'] = '1';
            $v = Vendor::create($vendor);
            $loc['vendor_id'] = $v->id;
            $loc['mobile_number'] = $data['phone_number'][0] ?? '';
            $loc['alternate_number'] = $data['phone_number'][1] ?? '';
            $loc['email'] = $data['email'] ?? '';
            $loc['address'] = $data['address'];
            $loc['area'] = $data['area'] ?? '';
            $loc['lat_lng'] = new Point($data['lat_lng'][0],$data['lat_lng'][1]);
            VendorContactInformation::create($loc);
            $loc['service_location'] = $data['address'];
            VendorServiceLocation::create($loc);
            $category = $data['category'];
            if ($category){
                foreach ($category as $category_one) {
                    $categories[] = array('vendor_id' => $v->id, 'category_id' => $category_one);
                }
                VendorCategory::insert($categories);
            }
            
            if($new) {
                $otp = rand(100000,999999);
                $sms_msg= "Your otp is ".$otp." SELECTIAL";
    
                $SMSController=new SMSController;
                $response = $SMSController->sms_send($u->contact_number, $sms_msg);
    
                if($otp) {
                    $success['mobile'] = $u->contact_number;
                    $success['otp'] = $otp;
                    $data = $success;
                    $data['user_id'] = $u->id;
                    $data['otp'] = $otp;
                    $data['verify_type'] = "register";
                    ForgotPassword::create($data);
                }
                else{
                    return $this->sendError('Error', ['error'=>'Something went wrong, Try Again!!']);
                }
                return $this->sendResponse($success, 'Otp sent on your registered mobile number');
            }
            else{
                return $this->sendResponse([], 'Vendor Added');
            }
    }

    public function generateOtp(Request $request) {
        $validator = Validator::make($request->all(), [
            'contact_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ]);

        if($validator->fails()){
            return $this->sendError('Error validation', $validator->errors());
        }

        $user = User::where(['contact_number'=>$request->contact_number])->get()->first();

        if($user){
            $otp = rand(100000,999999);
            $sms_msg= "Your otp is ".$otp." SELECTIAL";

            $SMSController=new SMSController;
            $response = $SMSController->sms_send($user->contact_number, $sms_msg);

            if($otp) {
                $success['mobile'] = $user->contact_number;
                $success['otp'] = $otp;
                $data = [];
                $data['user_id'] = $user->id;
                $data['otp'] = $otp;
                ForgotPassword::create($data);
                return $this->sendResponse($success, 'Otp sent on your registered mobile number');
            }
            else{
                return $this->sendError('Error', ['error'=>'Something went wrong, Try Again!!']);
            }
        }
        else{
            return $this->sendError('Error', ['error'=>'There is no user with this mobile number']);
        }
    }

    public function resendOtp(Request $request) {
        $validator = Validator::make($request->all(), [
            'contact_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ]);

        if($validator->fails()){
            return $this->sendError('Error validation', $validator->errors());
        }

        $user = User::where(['contact_number'=>$request->contact_number])->get()->first();

        if($user){
            @ $otp = ForgotPassword::where(['user_id'=>$user->id,'verify_type'=>$request->verification_type])->orderBy('id', 'DESC')->first()->otp;
            $sms_msg= "Your otp is ".$otp." SELECTIAL";
            $SMSController=new SMSController;
            $response = $SMSController->sms_send($user->contact_number, $sms_msg);

            if($otp) {
                $success['mobile'] = $user->contact_number;
                $success['otp'] = $otp;
                $data = [];
                $data['user_id'] = $user->id;
                $data['otp'] = $otp;
                return $this->sendResponse($success, 'Otp sent on your registered mobile number');
            }
            else{
                return $this->sendError('Error', ['error'=>'Something went wrong, Try Again!!']);
            }
        }
        else{
            return $this->sendError('Error', ['error'=>'There is no user with this mobile number']);
        }
    }

    public function verifyOtp(Request $request) {
        $validator = Validator::make($request->all(), [
            'otp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:6',
            'contact_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ]);

        if($validator->fails()){
            return $this->sendError('Error validation', $validator->errors());
        }
        
        $user = User::where(['contact_number'=>$request->contact_number])->get()->first();

        if($user) {
            $otp = ForgotPassword::where(['user_id'=>$user->id,'verify_type'=>'register'])->orderBy('id', 'DESC')->first();
            if($otp){
                if($request->otp == $otp->otp) {
                    ForgotPassword::Destroy($otp->id);
                    $user['device_key'] = $request->device_key;
                    $user['is_logged_in'] = '1';
                    $user['status'] = '1';
                    $query = $user->save();
                    if($query) {
                        $success['token'] =  $user->token;
                        $success['user'] =  $user;
                        $success['user']['profile_pic'] = $success['user']['profile_pic'] != "" ? env('APP_URL')."/uploads/users/".$success['user']['profile_pic'] : env('APP_URL')."/uploads/default-user-image.png";
                        return $this->sendResponse($success, 'User Registered and Verified');
                    }
                    else{
                        return $this->sendError('Error', ['error'=>'Something went wrong, Try again']);
                    }
                }
                else{
                    return $this->sendError('Error', ['error'=>'Mismatched OTP']);
                }
            }
            else{
                return $this->sendError('Error', ['error'=>'OTP session time expired']);
            }
        }
        else {
            return $this->sendError('Error', ['error'=>'No user found']);
        }

    }

    public function verifyOtpandResetPassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'otp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:6',
            'password' => 'required',
            'contact_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ]);

        if($validator->fails()){
            return $this->sendError('Error validation', $validator->errors());
        }
        
        $user = User::where(['contact_number'=>$request->contact_number])->get()->first();

        if($user) {
            $otp = ForgotPassword::where(['user_id'=>$user->id])->orderBy('id', 'DESC')->first();
            if($otp){
                if($request->otp == $otp->otp) {
                    ForgotPassword::Destroy($otp->id);
                    $password = Hash::make($request->password);
                    $user['password'] = $password;
                    $user['status'] = '1';
                    $query = $user->save();
                    if($query) {
                        return $this->sendResponse(['is_logged_in'=>$user->is_logged_in], 'Password is reset');
                    }
                    else{
                        return $this->sendError('Error', ['error'=>'Something went wrong, Try again']);
                    }
                }
                else{
                    return $this->sendError('Error', ['error'=>'Mismatched OTP']);
                }
            }
            else{
                return $this->sendError('Error', ['error'=>'OTP session time expired']);
            }
        }
        else {
            return $this->sendError('Error', ['error'=>'No user found']);
        }

    }

    public function updateDeviceToken($id, Request $request) {
        $user = User::find($id);
        $user['device_key'] = $request->device_key;
        $user->save();
        return $this->sendResponse([], 'Device key is updated');
    }

    public function membership_plan(Request $request) {
        $user = MembershipPlan::where('area',$request->area)->get();
        return $this->sendResponse($user, 'Plan List');
    }

    public function logout($id, Request $request) {
        $user = User::find($id);
        $user['device_key'] = "";
        $user['is_logged_in'] = '0';
        $user->save();
        return $this->sendResponse([], 'User logged out');
    }

    public function searchListApi(Request $request) {
        $data = [];
        $search = $request['search'];
        DB::enableQueryLog();
        $category = Category::where('title','like','%'.$search.'%')->get();
        $vendor = Vendor::where('business_name','like','%'.$search.'%')->get();
        $location = VendorContactInformation::where('address','like','%'.$search.'%')->orWhere('area','like','%'.$search.'%')->get();
        $gvendor = GoogleVendor::where('name','like','%'.$search.'%')->get();
        // dd(DB::getQueryLog());
        if($category){
            foreach($category as $cat){
                array_push($data,$cat['title']);
            }
        }

        if($vendor){
            foreach($vendor as $v){
                array_push($data,$v['business_name']);
            }
        }

        if($gvendor){
            foreach($gvendor as $v){
                array_push($data,$v['name']);
            }
        }

        if($location){
            foreach($location as $loc){
                if($loc['address'] != ""){
                    array_push($data,$loc['address']);
                }
                if($loc['area'] != ""){
                    array_push($data,$loc['area']);
                }
            }
        }

        $data = array_values(array_unique($data));

        return $this->sendResponse($data, 'Search List');
    }

    public function searchDataApi(Request $request) {
        $data = [];
		
		
		$search = $request['search'];
		$name = $request['name']; 
		$lat = $request['lat'];
		$lng = $request['lng'];
		
		$userlocation = array('name'=>$name,'lat'=>$lat,'lng'=>$lng);
		//echo '<pre>'; print_r($userlocation); echo '</pre>';
		
		//die;
		
		
        
		//echo '<pre>'; print_r($userlocation); echo '</pre>'; die;
		
        $category = Category::where('title','like','%'.$search.'%')->get();
        $svendor = Vendor::where('business_name','like','%'.$search.'%')->get();
        $location = VendorContactInformation::where('address','like','%'.$search.'%')->orWhere('area','like','%'.$search.'%')->get();
        // dd(DB::getQueryLog());
		
		
		/*$client = new Client(); //GuzzleHttp\Client
        echo $result =(string) $client->post("https://maps.googleapis.com/maps/api/geocode/json?address=".$userlocation."&key=AIzaSyBG7U89RzBTCmuQTrNvrUlgaMT7phsiCQw")->getBody();
        $json =json_decode($result);
		echo '<pre>'; print_r($json); echo '</pre>'; die;*/
        
		/*echo '<pre>'; print_r($category); echo '</pre>'; 
		echo '<pre>'; print_r($svendor); echo '</pre>'; 
		echo '<pre>'; print_r($location); echo '</pre>'; */
		//die;
		
        if($category){
            foreach($category as $cat){
                $ven = VendorCategory::where('category_id',$cat['id'])->get();
                if($ven){
                    foreach($ven as $v){
                        $vendor = $this->getVendorDetail($v['vendor_id'], $userlocation);
						//echo '<pre>'; print_r($vendor); echo '</pre>'; die;
						
                        if($vendor != ""){
                            array_push($data,$vendor);
                        }
                    }
                }
            }
			
			//echo 'in cat';
        }

        if($svendor){
            foreach($svendor as $v){
                $vendor = $this->getVendorDetail($v['id'], $userlocation);
                //echo '<pre>'; print_r($vendor); echo '</pre>'; die;
				
				if($vendor != ""){
                    array_push($data,$vendor);
                }
            }
			
			//echo 'in vend';
			
        }
		
		//echo '<pre>'; print_r($data); echo '</pre>'; die;
		
        if($location){
            foreach($location as $loc){
                $vendor = $this->getVendorDetail($loc['vendor_id'], $userlocation);
                if($vendor != ""){
                    array_push($data,$vendor);
                }
            }
			
			//echo 'in loc';
			
        }
        //echo $userlocation; //die;
		
		//echo '<pre>'; print_r($svendor); echo '</pre>'; die;
		
        $response = [];
        
        //echo '<pre>'; print_r($data); echo '</pre>'; die;
		
        if($data){
            foreach($data as $d){
                foreach($d as $v){
                    $response[] = $v;
                }
            }
            //$gvendres = $this->getGoogleVendorList($search,$userlocation);
			//echo '<pre>'; print_r($gvendres); die;
			
            $response = json_decode(json_encode($response), true);
            $newres = [];
            $used = [];
            foreach ( $response AS $key => $line ) { 
                if ( !in_array($line['business_name'], $used) ) { 
                    $used[] = $line['business_name']; 
                    $newres[$key] = $line; 
                } 
            }
            //echo 'IN DB';
            $response = $newres; //array_merge($newres, $gvendres);
			
			//echo '<pre>'; print_r($response); echo '</pre>'; die;
        }
        else{
            //echo 'IN EMPTY'; die;
			
			//echo 'NOT IN DB';
			
			$gresponse = $this->getGoogleVendorList($search,$userlocation);
			
			//echo '<pre>'; print_r($gresponse); echo '</pre>'; die;
			
			$response = $this->saveVendor($gresponse);
			
			/*$response = json_decode(json_encode($response), true);
			
			// Check if "data" is set and is an array
			if (isset($response['data']) && is_array($response['data'])) {
				// Convert the associative array to a numerically indexed array
				$response['data'] = array_values($response['data']);
			}*/
			
			// Encode the modified array back to JSON
			//$response = json_encode($response, JSON_PRETTY_PRINT);

			// Output the result
			//echo $newJsonData;
			
			//echo '<pre>'; print_r($response); echo '</pre>'; die;
			
			
			//$response = $this->getGoogleVendorList($search,$userlocation);
			
			
			
			
        }
        
        //echo '<pre>'; print_r($response); die;

        return $this->sendResponse($response, 'Searched Data');
    }

    public function getVendorDetail($vendor, $location){
        //DB::enableQueryLog();
		//echo '<pre>'; print_r($location); echo '</pre>'; die;
		
		
		$lng = !empty($location['lng'])?$location['lng']:"";
		$lat = !empty($location['lat'])?$location['lat']:""; //die;
		
        $cond = "*,c.title as category";
        $where = "v.status='1' and u.status='1' and v.id=".$vendor;
        $join = "JOIN users as u ON u.id = v.user_id JOIN vendor_categories AS vc ON v.id = vc.vendor_id JOIN category as c ON c.id = vc.category_id";
        $having = "";
        if($location != ''){
            $cond = $cond.", ST_Distance_Sphere(Point(".$lng.",".$lat."), vs.lat_lng) * 0.00099 AS 'distance'";
            $having = $having." HAVING distance<50 ORDER BY distance ASC";
            $join = $join." JOIN vendor_service_location AS vs ON vs.vendor_id = v.id";
        }
        $select = "SELECT ".$cond." FROM vendor AS v ".$join." where ".$where." GROUP BY v.id ".$having; //die;
        $query = DB::select($select);
        // dd(DB::getQueryLog());
    
        foreach($query as $vendor){
            $vendor->profile_pic = env("APP_URL")."/uploads/users/".$vendor->profile_pic;
            if(gettype($vendor->lat_lng) != "string"){
                @$vendor['lat_lng'] = [$vendor->lat_lng->getlat(),$vendor->lat_lng->getlng()];
            }
            else{
                $vendor->lat_lng = [];
            }
        }
    
        return count($query) == 0 ? "" : $query;
    }

    public function getGoogleVendorList($search, $location){
        
            //echo '<pre>'; print_r($location); echo '<pre>'; die;
			
			$area = "";
            if($location != "" ){
                $area = $location['name'] ?? "";
            }
            $host = ScrapperHost::find(1)->url;
            $url = $host."/google/search?query=".$search."&location=".$area."&size=100";
            //print($url); die;
            
            $vendor = [];
            $client = new Client();
            $request = $client->get($url)->getBody();
            //print_r($request); die;
            $res = json_decode($request,true);
            
            
            foreach($res as $v){
                //echo $v['category'];
				$v['contact_number'] = $v['phone'];
				
				//echo Category::where('title','Like','%'.$v['category'].'%')->first()->id; die;
				//$vid = Category::where('title','Like','%'.$v['category'].'%')->first()->id;
				
				
				$category = Category::where('title', 'like', '%' . $v['category'] . '%')->first();
				$vid = $category ? $category->id : null;
				$vid = !empty($vid)?$vid:"";
                $v['category_id'] = $vid;
				
				
				//die;

				$v['service_location'] = $area;
                $v['business_name'] = $v['name'];
                
                $dist = 10;
                //print($location); //die;
                if($location != ""){
                    //$dist = CustomValue::getGoogleDistance($location,[$v['latitude'],$v['longitude']]);
                    //echo $v['latitude'].'--'.$v['longitude']; //die;
                    
                    $dist = CustomValue::getGoogleDistance($v['latitude'],$v['longitude']);
                    
                    //die;
                    
                }
                
                //print($dist);
                //print_r($v); die;
                
                $v['distance'] = $dist;
                $v['lat_lng'] = [$v['latitude'],$v['longitude']];
                
                
                
                if($dist < 500000){
                    $vendor[] = $v;
                }
            }
        //print_r($vendor); die;
        usort($vendor, fn($a, $b) => $a['distance'] <=> $b['distance']);
		
		//echo '<pre>'; print_r($vendor); echo '<pre>'; die;
		
        return $vendor;
    }
	
	
	
	public function saveVendor($request){
        $ids = [];
		//echo '<pre>'; print_r($request); echo '<pre>'; die;
        foreach($request as $key => $vendor){
				//echo $vendor['phone']; die;
				
                $vexist = VendorContactInformation::where('mobile_number',$vendor['phone'])->first();
                $uexist = User::where('contact_number',$vendor['phone'])->first();
				
				$new_vendor_id = !empty($uexist)?$uexist->id:"";
				$new_vendor_id = !empty($new_vendor_id)?$new_vendor_id:"";
				
				if(!$vexist){
                    
					
                    if(!$uexist){
                        $checkCat = Category::where('title',$vendor['category'])->first();
                        
						$gcat = [];
                        if(!$checkCat){
                            $cat['title'] = $vendor['category'];
                            $cat['parent_id'] = '-1';
                            $gcat = Category::create($cat);
                        }
						
						$lat =$vendor['lat_lng'][0];
                        $lng =$vendor['lat_lng'][1];
						
						$hashed_password = Hash::make(Str::random(6));
                        $records['password'] = $hashed_password;
                        $records['token'] = Hash::make(Str::random(60));
                        $records['name'] = $vendor['name'];
                        $records['contact_number'] = $vendor['phone'];
                        $records['status'] = '0';
                        $records['is_vendor'] = '1';
                        $records['register_by'] = 'google';
						
						$user = User::create($records);
						
						$ven['user_id'] = $user->id;
						$ven['business_name'] = $vendor['name'];
                        $ven['slug'] = str_replace(' ','-',strtolower($vendor['name']));
                        $new_ven = Vendor::create($ven);
                        
                        $validate[] = ['category_id'=>($gcat) ? $gcat['id'] : $checkCat->id,'vendor_id'=>$new_ven->id];
                        VendorCategory::insert($validate);
                        
                        $venContact['lat_lng'] = new Point($lat, $lng);
                        $venContact['mobile_number'] = $vendor['phone'];
                        $venContact['address'] = $vendor['address'];
                        $venContact['vendor_id'] = $new_ven->id;
                        VendorContactInformation::create($venContact);

                        $venContact['lat_lng'] = new Point($lat, $lng);
                        $venContact['service_location'] = $vendor['address'];
                        $venContact['vendor_id'] = $new_ven->id;
                        VendorServiceLocation::create($venContact);

                        $vendor['result'] = 'OK';
						
						$vendor['new_vendor_id'] = !empty($user->id)?$user->id:"";
						//$ids['new_vendor_id'] = $user->id;
						
                        array_push($ids,$vendor);
						
						//echo 'INNER IF';
						//echo '<pre>'; print_r($ids); echo '</pre>'; die;

                    }
                    else{
						//echo 'IN FIRST ELSE';
						
						$vendor['new_vendor_id'] = !empty($new_vendor_id)?$new_vendor_id:"";
                        $vendor['result'] = 'Exist';
                        array_push($ids,$vendor);
						
						//echo 'IN FIRST ELSE';
						//echo '<pre>'; print_r($ids); echo '</pre>'; die;
						
                    }
                }
                else{
					//$ids['new_vendor_id'] = $user->id;
                    //echo 'IN SECOND ELSE';
					//echo $new_vendor_id; die;
					$vendor['new_vendor_id'] = !empty($new_vendor_id)?$new_vendor_id:"";
					$vendor['result'] = 'Exist';
                    array_push($ids,$vendor);
					
					//echo '<pre>'; print_r($ids); echo '</pre>'; die; 
					
                }
        }
		
		//echo '<pre>'; print_r($ids); echo '</pre>'; die;
        return $ids;
    }
	
	
	/*public function checkDetail(){
		echo '<pre>'; print_r($request); echo '</pre>'; die;
	}*/
	
	public function checkSaveVendor($request){
        $ids = [];
		echo '<pre>'; print_r($request); echo '</pre>'; die;
        /*foreach($request as $key => $vendor){
				echo $vendor['phone']; die;
				
                $vexist = VendorContactInformation::where('mobile_number',$vendor['phone'])->first();
                $uexist = User::where('contact_number',$vendor['phone'])->first();
				
				$new_vendor_id = !empty($uexist)?$uexist->id:"";
				$new_vendor_id = !empty($new_vendor_id)?$new_vendor_id:"";
				
				if(!$vexist){
                    
					
                    if(!$uexist){
                        $checkCat = Category::where('title',$vendor['category'])->first();
                        
						$gcat = [];
                        if(!$checkCat){
                            $cat['title'] = $vendor['category'];
                            $cat['parent_id'] = '-1';
                            $gcat = Category::create($cat);
                        }
						
						$lat =$vendor['lat_lng'][0];
                        $lng =$vendor['lat_lng'][1];
						
						$hashed_password = Hash::make(Str::random(6));
                        $records['password'] = $hashed_password;
                        $records['token'] = Hash::make(Str::random(60));
                        $records['name'] = $vendor['name'];
                        $records['contact_number'] = $vendor['phone'];
                        $records['status'] = '0';
                        $records['is_vendor'] = '1';
                        $records['register_by'] = 'google';
						
						$user = User::create($records);
						
						$ven['user_id'] = $user->id;
						$ven['business_name'] = $vendor['name'];
                        $ven['slug'] = str_replace(' ','-',strtolower($vendor['name']));
                        $new_ven = Vendor::create($ven);
                        
                        $validate[] = ['category_id'=>($gcat) ? $gcat['id'] : $checkCat->id,'vendor_id'=>$new_ven->id];
                        VendorCategory::insert($validate);
                        
                        $venContact['lat_lng'] = new Point($lat, $lng);
                        $venContact['mobile_number'] = $vendor['phone'];
                        $venContact['address'] = $vendor['address'];
                        $venContact['vendor_id'] = $new_ven->id;
                        VendorContactInformation::create($venContact);

                        $venContact['lat_lng'] = new Point($lat, $lng);
                        $venContact['service_location'] = $vendor['address'];
                        $venContact['vendor_id'] = $new_ven->id;
                        VendorServiceLocation::create($venContact);

                        $vendor['result'] = 'OK';
						
						//$vendor['new_vendor_id'] = $user->id;
						$ids['new_vendor_id'] = $user->id;
						
                        array_push($ids,$vendor);
						
						//echo 'INNER IF';
						//echo '<pre>'; print_r($ids); echo '</pre>'; die;

                    }
                    else{
						//echo 'IN FIRST ELSE';
						
						$vendor['new_vendor_id'] = !empty($new_vendor_id)?$new_vendor_id:"";
                        $vendor['result'] = 'Exist';
                        array_push($ids,$vendor);
						
						//echo 'IN FIRST ELSE';
						//echo '<pre>'; print_r($ids); echo '</pre>'; die;
						
                    }
                }
                else{
					//$ids['new_vendor_id'] = $user->id;
                    //echo 'IN SECOND ELSE';
					//echo $new_vendor_id; die;
					$vendor['new_vendor_id'] = !empty($new_vendor_id)?$new_vendor_id:"";
					$vendor['result'] = 'Exist';
                    array_push($ids,$vendor);
					
					//echo '<pre>'; print_r($ids); echo '</pre>'; die; 
					
                }
        }
		
		//echo '<pre>'; print_r($ids); echo '</pre>'; die;
        return $ids;*/
    }
	
    
}


