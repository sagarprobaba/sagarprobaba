<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\SMSController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Razorpay\Api\Api;

use GuzzleHttp;
use GuzzleHttp\Client;

use Validator;
use Session;
use Hash;
use CustomValue;
use DB;

use App\User;
use App\GuestUser;
use App\Vendor;
use App\Admin;
use App\VendorCategory;
use App\VendorContactInformation;
use App\VendorOtherInformation;
use App\VendorServiceLocation;
use App\VendorRating;
use App\VendorLead;
use App\QueryForVendor;
use App\GoogleVendor;
use App\Category;
use App\ScrapperHost;
use App\VendorPlan;
use App\MembershipPlan;
use App\UserChatRoom;
use App\UserChat;
use App\CallHistory;
use App\Chat;
use App\ChatHistory;
use App\VendorList;
use App\VendorImages;
use App\VendorServices;

use App\Traits\Firebase;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Carbon;

class VendorController extends BaseController
{
    use Firebase;
    
    public function vendor_list(Request $request) {
        /*Get Data From Request*/
		
		$data['user_id'] = $request->user_id;
        $data['category_id'] = $request->category_id;
        $data['status'] = '0';
        
        $data['location'] = $request->location ? (is_array($request->location) && array_key_exists('name', $request->location) ? $request->location['name'] : "") : "";
        $data['lat_lng'] = $request->location ? new Point($request->location['lat'],$request->location['lng']) : null;
        
		$lat1 = $request->location['lat'];
		$lon1 = $request->location['lng'];
		
		//calculateDistance($lat1, $lon1, $lat2, $lon2)
        
        // $queryVend = QueryForVendor::where(['category_id'=>$request->category_id, 'location'=>$data['location']])->first();
        $queryVendor = QueryForVendor::create($data);
		
		$vendorlist['search_id'] = $queryVendor->id;
        $response = [];
        $category = [["id"=>$request->category_id]];
		//echo $request->category_id; die;
		
        $category = array_merge($category,Category::where("parent_id",$request->category_id)->get()->toArray());
        
		//echo '<pre>'; print_r($queryVendor); echo '</pre>'; die;
        
        
        foreach($category as $cat){
            //$response = array_merge($response,$this->getVendor($cat['id'], $request->location ?? ""));
			//echo $cat['id']; die;
			$response = array_merge($response,$this->getVendor($cat['id'], $request->location));
			
			
        }
        // $response = json_encode($response, JSON_INVALID_UTF8_IGNORE);
        // print_r($response);die;
        // $data = [
        //     "to" => Admin::find(1)->device_key,
        //     "notification" => [
        //         "title" => "New Query",
        //         "body" => [
        //             "message" => "New Query from ".$queryVendor->user->name,
        //             "chat" => $queryVendor->id,
        //             "type" => "query"
        //         ]
        //     ]
        // ];
        // $this->firebaseNotification($data);
        /*print_r($category); 
        print_r($response);
        
        die;*/
        
		//echo '<pre>'; print_r($response); echo '</pre>'; die;
		
        if(count($response) > 99){
            // $result = [
            //     'success' => true,
            //     'data'    => $response,
            //     'search_id' => $queryVendor->id,
            //     'message' => 'Vendor Found!!',
            // ];
            $queryVendor['status'] = '1';
            $queryVendor['response_count'] = count($response);
            $queryVendor->save();
			
			//echo 'Not empty';
			
			//echo '<pre>'; print_r($response); echo '</pre>'; //die;
			//echo $latLng = $response['lat_lng'];
			//echo $latLng = $response->lat_lng; die;
			//$latitude = $latLng[0];
			//$longitude = $latLng[1];

			
			//echo $lat2 = !empty($latitude)?$latitude:0;
			//echo $lon2 = !empty($longitude)?$longitude:0; die;
            
			
			
			//echo $calculated_distance = $this->calculateDistance($lat1, $lon1, $lat2, $lon2); die;
			
			$vendorlist['json_data'] = json_encode($response);
			$data_from = 'google';
            // return response()->json($result, 200,[],JSON_INVALID_UTF8_IGNORE);
            
            //echo 'Not empty'; die;
        }
        else{
            //echo 'in empty'; //die;
            
            //$google = $this->getGoogleVendor($request->category_id, $request->location ?? "", count($response));
            
            
            $google = $this->getGoogleVendor($request->category_id, $request->location, count($response));
            
			//echo '<pre>'; print_r($google); echo '</pre>'; die;
			
			//
            
            if(!empty($google)){
				//echo 'IF GOOGLE ';
				//echo '<pre>'; print_r($google); echo '</pre>'; 
				//echo response()->json($google); die;
				$google = $this->processArray($google);
				//echo '<pre>'; print_r($d); echo '</pre>';  
				
								// Convert the PHP array to JSON
				//echo $jsonData = json_encode($d); die;

				//$response = array_merge($response,$google);
				//$gresponse = array_merge($response,$google);
				//echo '<pre>'; print_r($google); echo '</pre>'; 
				//$arrayFromObject = get_object_vars($gresponse);
				
				//echo '<pre>'; print_r($arrayFromObject); echo '</pre>';
				//die;
				
				$response = $this->saveVendorList($google);
                
				//echo '<pre>'; print_r($response); echo '</pre>'; die;
				
				//echo json_encode($response);
				//die;
				
				
				// $result = [
                //     'success' => true,
                //     'data'    => $response,
                //     'search_id' => $queryVendor->id,
                //     'message' => 'Vendor Found!!',
                // ];
				
				//$lat2 = !empty($response['lat_lng'])?$response['lat_lng'][0]:0;
				//$lon2 = !empty($response['lat_lng'])?$response['lat_lng'][1]:0;
				
				
				//$calculated_distance = $this->calculateDistance($lat1, $lon1, $lat2, $lon2); //die;
				
				$data_from = 'not_google';
				
                $queryVendor['status'] = '1';
                $queryVendor['response_count'] = count($response);
                $queryVendor->save();
				
				//echo '<pre>'; print_r($response); echo '</pre>'; die;
				
				$vendorlist['json_data'] = json_encode($response);
                
				
				
				//return $result = response()->json($result, 200,[],JSON_INVALID_UTF8_IGNORE);
				
				//echo '<pre>'; print_r($vendorlist); echo '</pre>'; die;
				
            }
        }
        
        //calculateDistance($lat1, $lon1, $lat2, $lon2) {
		//lat1, lon1 from request
		//lat2, lon2 from response
        
		//echo '<pre>'; print_r($vendorlist); echo '</pre>'; die;
		
        if(count($response)<1){
            return $this->sendError('No Vendor Found!!', []);
        }
        
		//echo '<pre>'; print_r($vendorlist); echo '</pre>'; die;
		//echo '<pre>'; print_r($response); echo '</pre>'; //die;
		VendorList::create($vendorlist);
		
		//$query = VendorList::create($vendorlist)->toSql();
		
		//echo $query; die;
		
        $result = [
            'success' => true,
			'data_from' => $data_from,
            'data'    => array_slice(json_decode($vendorlist['json_data']),0,20,true),
            'search_id' => $queryVendor->id,
            'total' => $queryVendor['response_count'],
            'message' => 'Vendor Found!!',
        ];
		
		
		
		//echo '<pre>'; print_r($result); echo '</pre>'; die;
		
        return response()->json($result, 200,[],JSON_INVALID_UTF8_IGNORE);
    }

    public function getMoreVendors(Request $request){
        $validator = Validator::make($request->all(), [
            'search_id' => 'required',
            'page' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Error validation', $validator->errors());
        }

        $data = VendorList::where('search_id',$request->search_id)->get()->toArray();
        // dd($data);
        $res = array_slice(json_decode($data[0]['json_data']),$request->page-1,$request->limit??20);
        if(isset($res)) {
            $result = [
                'success' => true,
                'data'    => $res,
                'message' => 'Vendor Found!!',
            ];
            return response()->json($result, 200,[],JSON_INVALID_UTF8_IGNORE);
        }
        else{
            return $this->sendError('No Vendor Found!!', []); 
        }
    }

    public function getVendor($category, $location){
        //DB::enableQueryLog();
        $cond = "*";
        $where = "v.status='1'";
        $join = "JOIN users as u ON u.id = v.user_id JOIN vendor_contact_info as vci ON v.id = vci.vendor_id";
        $having = "";
        if($category != ''){
            $where = $where." and vc.category_id = ".$category;
            $join = $join." JOIN vendor_categories AS vc ON v.id = vc.vendor_id";
        }
        if($location != ''){
            $cond = $cond.", ST_Distance_Sphere(Point(".$location['lng'].",".$location['lat']."), vs.lat_lng) * 0.00099 AS 'distance'";
            //HAVING distance<50
			$having = $having."  ORDER BY distance ASC";
            $join = $join." JOIN vendor_service_location AS vs ON vs.vendor_id = v.id";
        }
		$select = "SELECT ".$cond." FROM vendor AS v ".$join." where ".$where." GROUP BY v.id ".$having; //die;
        $query = DB::select($select);

        $res = [];
        //print_r($query); die;

        foreach($query as $vendor){
            $vendor->profile_pic = env("APP_URL")."/uploads/users/".$vendor->profile_pic;
            @$lat_lng = VendorServiceLocation::where("vendor_id",$vendor->id)->first()->lat_lng;
            
            if($lat_lng != null){
                @$vendor->lat_lng = [$lat_lng->getlat(),$lat_lng->getlng()];
                $vendor->register_by = 'web';
                array_push($res,$vendor);
                
            }
            // array_push($res,$vendor);
        }
		
		
		
        return $res;
    }

    public function getGoogleVendor($category, $location, $count){
        
        $vendor = [];
        $cat = Category::where("id",$category)->first();
        //print_r($cat); die;
        //print_r($location); die;
		/*if(empty($cat->parent_id) || $cat->parent_id==''){
			$this->sendResponse([], 'No category!!');
		}*/
        
        if($cat && $cat->parent_id != 0){
            $pcat = Category::where("id",$cat->parent_id)->first()->title;
            $cat_title = $cat->title." ".$pcat;
        }
        else{
            $cat_title = $cat->title;
        }
        
            $area = "";
            if($location != "" ){
                $area = $location['name'] ?? "";
            }
            $host = ScrapperHost::find(1)->url;
            //print($host); //die;
            //echo '<br/>';
            
            $url = $host."/google/search?category=".$cat_title."&location=".$area."&state=Delhi&size=100&search_category=".$category;
            
            //print($url); die;
            
            $vendor = [];
            $client = new Client();
            //$request = $client->get($url)->getBody();
            
            $response = $client->get($url);
            $body = (string) $response->getBody();
            
            //var_dump($body); die;
            
            // Decode the JSON string
            $decodedData = json_decode($body,true);
            
            // Check for decoding errors
            if ($decodedData === null && json_last_error() !== JSON_ERROR_NONE) {
                // Handle JSON decoding error
                echo "JSON decoding error: " . json_last_error_msg();
            } else {
                // Now $decodedData contains the decoded JSON data
                //print_r($decodedData); 
            }
            
            /*$res = $decodedData;
            print_r($res); die; 
            
            die;*/
            
            //$res = json_decode($request,true);
            
            $res = $decodedData;
            //print_r($res); die; 
            
            
            
            //print_r($request); die;
            
            
            /*$res = json_decode($body,true);
            print($res); die;*/ 
            
            //print($res); die;
            
            foreach($res as $v){
                
				//echo '<pre>'; print_r($v); echo '</pre>'; die;
				
                $v['contact_number'] = $v['phone'];
                //$v['category_id'] = $category;
				/*echo $v['category'];
				
				$query = Category::where('title','Like','%'.$v['category'].'%');
				$sql = $query->toSql();

				echo $sql; 
				
				
				die;*/
				//echo Category::where('title','Like','%'.$v['category'].'%')->first()->id; die;
				
				$v['category_id'] = Category::where('title','Like','%'.$v['category'].'%')->first()->id;
				$v['service_location'] = $area;
                $v['business_name'] = $v['name'];
                
                $dist = 10;
               
				
				
                if(!empty($location)){
                    
                    //print_r($location); die;    
                    //$dist = CustomValue::getGoogleDistance($location,[$v['latitude'],$v['longitude']]);
                    /*Array
					(
					[lat] => 23.98766
					[lng] => 24.98407
					[name] =>
					)*/
                    //$dist = CustomValue::getGoogleDistance($v['latitude'],$v['longitude']); //die;
					
					$dist = CustomValue::getGoogleDistance($location['lat'],$location['lng']); //die;
					
                }
                
				//echo '<pre>'; print_r($v); echo '</pre>'; die;
				
				
				$v['distance'] = !empty($dist) ?$dist:"";
				
				
				
                $v['lat_lng'] = [$v['latitude'],$v['longitude']];
                
                //echo '<pre>'; print_r($v); echo '</pre>'; die;
                
                /*if($dist < 50){
                    $vendor[] = $v;
                }*/
                
				$vendor[] = $v;
                //print_r($vendor); die;
                
            }
        
        //print_r($vendor); die;
        
        usort($vendor, fn($a, $b) => $a['distance'] <=> $b['distance']);
		
		//echo '<pre>'; print_r($vendor); echo '</pre>'; 
		
		
		
		
		//die;
		
        return $vendor;
    }

    public function getVendorByLocation($location, $dist) {
        $vendor = [];
        $data = VendorServiceLocation::where('status','1')->get();
        if($data){
            foreach($data as $loc){
                $distance = CustomValue::getDistance($location, $loc);
                $loc['distance'] = $distance;
                $vendor[] = $loc;
            }
        }
        else{
            $data = VendorContactInformation::where('status','1')->get();
            if($data){
                foreach($data as $loc){
                    $distance = CustomValue::getDistance($location, $loc);
                    $loc['distance'] = $distance;
                    $vendor[] = $loc;
                }
            }
        }
        
        return $vendor; 
    }

    public function add_vendor(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required',
            'contact_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:users,contact_number',
        ]);

        if($validator->fails()){
            return $this->sendError('Error validation', $validator->errors());
        }
        
        $data = $request;
            $user['name'] = $data['name'];
            $user['contact_number'] = $data['contact_number'];
            $user['password'] = Hash::make($data['password']);
            $user['token'] = Hash::make(Str::random(60));
            $u = User::create($user);
            $vendor['user_id'] = $u->id;
            $business = $data['business_name'] ?? $data['name'];
            $vendor['business_name'] = $business;
            $vendor['slug'] = str_replace(' ','-',strtolower($business));
            $v = Vendor::create($vendor);
            $loc['vendor_id'] = $v->id;
            $loc['mobile_number'] = empty($data['phone_number']) ? $data['contact_number'] : $data['phone_number'][0];
            $loc['alternate_number'] = $data['phone_number'][1] ?? '';
            $loc['email'] = $data['email'] ?? '';
            $loc['address'] = $data['address'];
            $loc['area'] = $data['area'] ?? '';
            $loc['lat_lng'] = new Point($data['lat_lng'][0],$data['lat_lng'][1]);
            VendorContactInformation::create($loc);
            $loc['service_location'] = $data['location'] ? $data['location'] : $data['address'];
            VendorServiceLocation::create($loc);
            $category = $data['category'];
            if ($category){
                foreach ($category as $category_one) {
                    $categories[] = array('vendor_id' => $v->id, 'category_id' => $category_one);
                }
                VendorCategory::insert($categories);
            }

            $plan['vendor_id'] = $vendor['user_id'];
            $plan['plan_id'] = 1;
            $plan['leads'] = 10;
            $plan['payment_mode'] = 'cash';
            $plan['payment_key'] = "";
            $plan['signature'] = "";
            $plan['transaction_id'] = "";
            $plan['order_id'] = "";
            $plan['status'] = '1';
            VendorPlan::create($plan);

        return $this->sendResponse([], 'Vendor Saved!!');
    }

    public function add_business_profile(Request $request) {
                
        $data = $request;
            $vendor['user_id'] = $data['user_id'];
            $business = $data['business_name'];
            $vendor['business_name'] = $business;
            $vendor['slug'] = str_replace(' ','-',strtolower($business));
            $v = Vendor::create($vendor);
            $loc['vendor_id'] = $v->id;
            $loc['mobile_number'] = $data['phone_number'][0] ?? '';
            $loc['alternate_number'] = $data['phone_number'][1] ?? '';
            $loc['email'] = $data['email'] ?? '';
            $loc['address'] = $data['address'];
            $loc['area'] = $data['area'] ?? '';
            $loc['lat_lng'] = new Point($data['lat_lng'][0],$data['lat_lng'][1]);
            VendorContactInformation::create($loc);
            $loc['service_location'] = $data['location'] ? $data['location'] : $data['address'];
            VendorServiceLocation::create($loc);
            // print($loc['lat_lng']);
            // print($loc['lat_lng']->getlat());
            $category = $data['category'];
            if ($category){
                foreach ($category as $category_one) {
                    $categories[] = array('vendor_id' => $v->id, 'category_id' => $category_one);
                }
                VendorCategory::insert($categories);
            }

            $plan['vendor_id'] = $vendor['user_id'];
            $plan['plan_id'] = 1;
            $plan['leads'] = 10;
            $plan['payment_mode'] = 'cash';
            $plan['payment_key'] = "";
            $plan['signature'] = "";
            $plan['transaction_id'] = "";
            $plan['order_id'] = "";
            $plan['status'] = '1';
            VendorPlan::create($plan);

        return $this->sendResponse([], 'Vendor Saved!!');
    }

    public function save_vendor_rating(Request $request) {
        $data = $request->all();
        VendorRating::create($data);
        return $this->sendResponse([], 'Rating Saved!!');
    }

    public function get_vendor_rating($id) {
        $data = VendorRating::where('vendor_id', $id)->get();
        return $this->sendResponse($data, 'Rating List!!');
    }

    public function get_vendor_lead($id) {
        $lead = VendorLead::where('vendor_id', $id)->get();
        $data = [];
        if($lead) {
            foreach($lead as $l){
                if($l->chat_id != NULL){
                    $chat = $l->chat->chat;
                    $l['sender'] = 'Guest User';
                    $l['message'] = $chat['message'];
                    if($chat['sender_type'] == 'user'){
                       $sender = User::where(['id'=>$chat['sender_id']])->first();
                       $l['sender'] = $sender->name;
                       $l['sender_contact'] = $sender->contact_number;
                       $l['sender_id'] = $sender->id;
                    }
                    unset($l['chat']);
                }
                if($l->call_id != NULL){
                    $chat = $l->call;
                    $sender = User::where(['id'=>$chat['user_id']])->first();
                    $l['sender'] = $sender->name;
                    $l['sender_contact'] = $sender->contact_number;
                    $l['sender_id'] = $sender->id;
                    unset($l['call']);
                }
                if($l->search_id != NULL) {
                    $query = $l->vendor_query;
                    @$l['category'] = $query->category->title;
                    @$vendor_loc = VendorContactInformation::where('vendor_id', $id)->first();
                    $l['distance'] = "";
                    $l['contact_info'] = "";
                    if($vendor_loc){
                        $l['contact_info'] = $vendor_loc['mobile_number'];
                        @$l['distance'] = CustomValue::getDistance($query->lat_lng, $vendor_loc['lat_lng']);
                    }
                    unset($l['vendor_query']);
                }
                $l['vendor_type'] = VendorCategory::where("vendor_id",$id)->first()->category->title;
                $data[] = $l;
            }
        }
        return $this->sendResponse($data, 'Lead List!!');
    }

    public function update_lead($id, $status) {
        $lead = VendorLead::find($id);
        $lead['status'] = $status;
        $lead->save();
        return $this->sendResponse([], 'Lead Status Updated!!');
    }

    public function update_scrapper_host(Request $request) {
        $lead = ScrapperHost::find(1);
        $lead['url'] = $request->host;
        $lead->save();
        return $this->sendResponse([], 'Host Updated!!');
    }

    public function saveVendorPlan(Request $request) {
        $plan['vendor_id'] =$request->vendor_id;
        $plan['plan_id'] = $request->plan_id;
        $plan['leads'] = $request->leads;
        $plan['payment_mode'] = $request->payment_mode ?? 'cash';
        $plan['payment_key'] = $request->payment_key;
        $plan['signature'] = $request->signature;
        $plan['transaction_id'] = $request->transaction_id;
        $plan['order_id'] = $request->order_id;

        $api = new Api('rzp_test_zHe1g6NarBxhhe', 'AEBq1ustLxgGZkrCYLrHdLtb');
        $attributes  = array('razorpay_signature'  => $request->signature,  'razorpay_payment_id'  => $request->payment_key ,  'razorpay_order_id' => $request->order_id);
        $order  = $api->utility->verifyPaymentSignature($attributes);
        if($order){
            $plan['status'] = '1';
        }
        else{
            $plan['status'] = '0';
        }
        VendorPlan::create($plan);
        return $this->sendResponse([], 'Plan Updated!!');
    }

    public function vendor_history($id){
        $plan = VendorPlan::where(['vendor_id'=>$id, 'vendor_type'=>'vendor'])->orderBy('id','DESC')->get();
        $price = 0;
        $lead = 0;
        $vendor_lead = 0;
        $plans = [];
        $vendor=['active_plan'=>[], 'transaction'=>[]];
        foreach($plan as $p) {
            $price = ($p->plan->price_per_lead == "" ? $p->plan->total_price : $p->plan->price_per_lead * $p->leads);
            $lead = $p->leads;
            array_push($plans, $p);
        }
        if(count($plans)>0){
            $vendor['active_plan'] = ['price' => $price, 'plans' => $plans[0]];
        }
        if(count($plans)>1){
            $vendor['transaction'] = array_slice($plans,1);
        }

        $vendors = Vendor::where("user_id",$id)->get();
        foreach($vendors as $v){
            
            $leads = VendorLead::where('vendor_id',$v->id)->get()->count();
            $vendor_lead = $vendor_lead+$leads;
        }

        $vendor['leads'] = ['total' => $lead, 'pending' => $lead-$vendor_lead];
        return $this->sendResponse($vendor, 'Vendor Plan & History');
    }

    public function save_vendor(Request $request){
        $ids = [];
        foreach($request->vendor as $key => $vendor){
            // $exist = GoogleVendor::where('phone',$vendor['phone'])->first();
            // if(!$exist){
                $vexist = VendorContactInformation::where('mobile_number',$vendor['phone'])->first();
                if(!$vexist){
                    $uexist = User::where('contact_number',$vendor['phone'])->first();
                    if(!$uexist){
                        $checkCat = Category::where('title',$vendor['category'])->first();
                        $gcat = [];
                        if(!$checkCat){
                            $cat['title'] = $vendor['category'];
                            $cat['parent_id'] = '-1';
                            $gcat = Category::create($cat);
                        }
                        $lat =$vendor['lat'];
                        $lng =$vendor['lng'];
                        
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
                        array_push($ids,$vendor);

                    }
                    else{
                        $vendor['result'] = 'Exist';
                        array_push($ids,$vendor);
                    }
                }
                else{
                    $vendor['result'] = 'Exist';
                    array_push($ids,$vendor);
                }
        }
        return $ids;
    }

    public function get_membership_area(Request $request) {
        $area = MembershipPlan::select('area')->distinct()->get();
        $data =[];
        foreach($area as $a){
            $data[] = $a['area'];
        }
        return $this->sendResponse($data, 'Membership Area List');
    }

    public function save_call_history(Request $request) {
        $data['user_id'] = $request->user_id;
        $data['category_id'] = $request->category_id;
        $data['vendor_id'] = $request->vendor_id;
        $data['location'] = $request->location ?? "";
        $ch = CallHistory::where(['user_id'=>$data['user_id'],'category_id'=>$data['category_id'],'vendor_id'=>$data['vendor_id']])->orderBy('id','desc')->first();
        if(!$ch){
            $call = CallHistory::create($data);
            $plan['vendor_id'] =$request->vendor_id;
            $plan['vendor_type'] = "vendor";
            $plan['call_id'] = $call->id;
            $plan['status'] = '0';
            VendorLead::create($plan);
        }
        else{
            $plan['vendor_id'] =$request->vendor_id;
            $plan['vendor_type'] = "vendor";
            $plan['call_id'] = $ch->id;
            $plan['status'] = '0';
            $call = CallHistory::create($data);
            $lead = $this->checkVendorLead($plan['vendor_id'],$data['user_id'],0,$plan['call_id']);
            // print($lead);
            if($lead){
                $plan['call_id'] = $call->id;
                VendorLead::create($plan);
            }
        }
        
        return $this->sendResponse([], 'Call Log Added');
    }

    public function get_call_history($id) {
        $result = [];
        $data = CallHistory::where('user_id',$id)->get();
		
		//die('check');
		
		/*$query = CallHistory::where('user_id',$id);
		$sql = $query->toSql();

		echo $sql; //die;*/
		
		
        if($data){
            foreach($data as $d) {
                
				//echo '<pre>'; print_r($d); echo '<pre>'; die;
				//echo $d->user_id;  die;
				
				$v_details = Vendor::where("user_id",$d->user_id)->first(); //die;
				$business_name = $v_details->business_name;
				
				//echo VendorContactInformation::where("vendor_id",$d->vendor_id)->first()->mobile_number;
				$catid = $d->category_id; //die;
				
				$cat = Category::where("id",$catid)->first();
				//echo '<pre>'; print_r($cat); echo '<pre>'; die;
				
				//echo $cat->title; die;
				
				//die;
				$d['vendor'] = $business_name;
                $d['category'] = $cat->title;
				
				//
				
                //$d['contact_number'] = VendorContactInformation::where("vendor_id",$d->vendor_id)->first()->mobile_number;
				//echo $d->vendor_id; die;
				$vinfo = VendorContactInformation::where("vendor_id",$d->vendor_id)->first()->mobile_number; //die;
				$d['contact_number'] = !empty($vinfo)?$vinfo:"";
				
				//echo '<pre>'; print_r($d); echo '<pre>'; die;
				
            }
        }
		
		//echo '<pre>'; print_r($d); echo '<pre>'; die;
		//echo '<pre>'; print_r($data); echo '<pre>'; die;
		
        $result['call'] = $data;

        $mHistory = [];
        $data = UserChatroom::where("user1",$id)->orWhere("user2",$id)->get();
        if($data){
            foreach($data as $d) {
                $msg = UserChat::where(["chatroom_id"=>$d->id])->orderBy('id','desc')->first();  
                if($msg) {
                    $msg['vendor_id'] = ($d->user1 != $id) ? $id : $d->user2;
                    @$msg['contact_number'] = VendorContactInformation::where("vendor_id",$msg['vendor_id'])->first()->mobile_number;
                    array_push($mHistory,$msg);
                }
            }
        }
        if($mHistory) {
            foreach($mHistory as $mh){
                $mh['vendor'] = Vendor::where("id",$mh->vendor_id)->first();
                $category = VendorCategory::where("vendor_id",$mh->vendor_id)->first();
                $mh['category_id'] = $category->category_id;
                $mh['category'] = $category->category;
            }
        }
        $result['message'] = $mHistory;

        return $this->sendResponse($result, 'Call History');
    }

    public function saveVendorLead(Request $request) {
        $plan['vendor_id'] =$request->vendor_id;
        $plan['vendor_type'] = "vendor";
        $plan['status'] = '0';
        
        $plan['reciever_id'] = $request->reciever_id;
        $plan['source'] = $request->source;
        $plan['main_cat'] = $request->main_cat;
		$plan['location'] = $request->location;
		
        $res = VendorLead::create($plan);
		//echo '<pre>'; print_r($res); echo '</pre>';  die;
		if($res){
			return $this->sendResponse([], 'Generate new Lead!!');
		}else{
			return $this->sendResponse([], 'Not Generated!!');
		}

		

		
    }

    public function get_all_vendor_lead($id, Request $request) {
        $from_date = "";
        $to_date = "";
        $qstatus = ""; 
        if($request->from_date){
            $from_date = $request->from_date;
            $to_date = $request->to_date;
        }
        if($request->status != ""){
            $qstatus = $request->status;
        }
        $user = Vendor::where("user_id",$id)->get();

        $data = [];
        $price = 0;
        $lead = 0;
        $plans = [];
        $data = [];
        $count = ["New"=>0, "Follow Up"=>0, "Completed"=>0, "Not Interested"=>0, "Not Reachable"=>0, "Contacted"=>0, "Read"=>0];
        $vendor_lead = 0;
        $leadStatus = ["New", "Follow Up", "Completed", "Not Interested", "Not Reachable", "Contacted", "Read"];
        $plan = VendorPlan::where(['vendor_id'=>$id, 'vendor_type'=>'vendor'])->orderBy('id','DESC')->get();
            
        foreach($plan as $p) {
            $price = ($p->plan->price_per_lead == "" ? $p->plan->total_price : $p->plan->price_per_lead * $p->leads);
            $lead = $p->leads;
            array_push($plans, $p);
        }
        if(count($plans)>0){
            $data['active_plan'] = $plans[0];
        }

        foreach($user as $u){
            $leads = VendorLead::where('vendor_id',$u->id)->get()->count();
            $vendor_lead = $vendor_lead+$leads;  
            // DB::enableQueryLog();
            $leads = VendorLead::where('vendor_id', $u->id);
            if($qstatus != ""){
                $leads = $leads->where("status",$qstatus);
            }
            if($from_date != ""){
                $leads = $leads->whereDate("created_at",">=",$from_date)->whereDate("created_at","<=",$to_date);
            }
            $leads= $leads->get();
            // dd(DB::getQueryLog());
            if($leads) {
                foreach($leads as $l){
                    if(in_array($leadStatus[$l["status"]], $leadStatus)){
                        $count[$leadStatus[$l['status']]]++;
                    }

                    if($l->chat_id != NULL){
                        $chat = UserChat::where("id",$l->chat_id)->first();
                        if($chat){
                            $l['sender'] = 'Guest User';
                            @$l['message'] = $chat['message'];
                            $sender = User::where(['id'=>$chat['sender_id']])->first();
                            @$l['sender'] = $sender->name;
                            @$l['sender_contact'] = $sender->contact_number;
                            @$l['sender_id'] = $sender->id;
                            @$l['location'] = $sender->address;
                            unset($l['chat']);
                        }
                    }
                    if($l->call_id != NULL){
                        $chat = $l->call;
                        $sender = User::where(['id'=>$chat['user_id']])->first();
                        @$l['sender'] = $sender->name;
                        @$l['sender_contact'] = $sender->contact_number;
                        @$l['sender_id'] = $sender->id;
                        @$l['location'] = $sender->address;
                        unset($l['call']);
                    }
                    if($l->search_id != NULL) {
                        $query = $l->vendor_query;
                        @$l['category'] = $query->category->title;
                        @$vendor_loc = VendorContactInformation::where('vendor_id', $id)->first();
                        $l['distance'] = "";
                        $l['contact_info'] = "";
                        if($vendor_loc){
                            @$l['contact_info'] = $vendor_loc['mobile_number'];
                            @$l['distance'] = CustomValue::getDistance($query->lat_lng, $vendor_loc['lat_lng']);
                        }
                        unset($l['vendor_query']);
                    }
                    @$l['vendor_type'] = VendorCategory::where("vendor_id",$u->id)->first()->category->title;
                    $data['data'][] = $l;
                }
                $data['leads'] = ["total"=>$lead,"pending"=>$lead-$vendor_lead];
                $data['leads_count'] = $count;
            }
        }
        return $this->sendResponse($data, 'Lead List!!');
    }

    public function edit_vendor_profile(Request $request, $id){
        $vendor = Vendor::where('id',$id)->first();
        $records['business_name'] = $request->business_name;
        $records['about_me'] = $request->about_me;
        $records['slug'] = str_replace(' ','-',strtolower($request->business_name));
        if ($request->hasFile('file')) {
			if ($request->file('file')->isValid()) {

                $this->validate($request, [
                    'file' => 'mimes:jpeg,jpg,png,gif'
                ]);

				$fileName = $request->file('file')->extension();
				$fileName =time()."_b.".$fileName;
				//upload
				$request->file('file')->move('uploads/users/', $fileName);
				//column name
				$records['logo']=$fileName;
			}
		}
        
        $vendor->fill($records);
        if($vendor->save()){

            // ----------LocationInformationCategory------------- //
            $categories = array();
            $category = $request->category;

            VendorCategory::where('vendor_id', $vendor->id)->delete();
            if ($category){
                foreach ($category as $category_one) {
                    $categories[] = array('vendor_id' => $vendor->id, 'category_id' => $category_one);
                }
                VendorCategory::insert($categories);
            }
            // ----------Inserting LocationInformationCategory------------- //

        }

        $records = $request->all();
        if($request->google_location != ''){
            $arr = explode(',',explode('@',$request->google_location)[1]);
            $records['lat_lng'] = new Point($arr[0],$arr[1]);
        }
        
        $contact_information = VendorContactInformation::where('vendor_id',$id)->first();
        $contact_information->fill($records);
		$contact_information->save();

        $other_information = VendorOtherInformation::where('vendor_id',$id)->first();
        $other_information->fill($records);
		$other_information->save();

        if($request->service_location){
            VendorServiceLocation::where('vendor_id', $request->vendor_id)->delete();
            $location = json_decode($request->service_location);
            foreach($location as $loc){
                $service_loc = new VendorServiceLocation;
                $records['service_location'] = $loc[0];
                $records['lat_lng'] = new Point($loc[1]->lat,$loc[1]->lng);
                $service_loc->fill($records);
                $service_loc->save();
            }
        }

        $images = array();
        $banner = $request->banner;

        if ($banner){
            foreach ($banner as $banner_one) {
                $images[] = array('vendor_id' => $vendor->id, 'file' => $banner_one);
            }
            VendorImages::insert($images);
        }

        return $this->sendResponse($vendor, 'Vendor Profile Updated');
    }
	
	
	public function cvf_convert_object_to_array($data) {

		if (is_object($data)) {
			$data = get_object_vars($data);
		}

		if (is_array($data)) {
			return array_map(__FUNCTION__, $data);
		}
		else {
			return $data;
		}
	}
	
	
	// Function to recursively replace Infinity and NaN values with null
	public function processArray($inputArray) {
        // Define the callback function as a closure
        $replaceInfAndNaN = function($item) use (&$replaceInfAndNaN) {
            if (is_array($item)) {
                return array_map($replaceInfAndNaN, $item);
            } else {
                return is_float($item) && (is_infinite($item) || is_nan($item)) ? null : $item;
            }
        };

        // Call array_map with the callback function and the input array
        $resultArray = array_map($replaceInfAndNaN, $inputArray);
		return $resultArray;
        // Do something with the resultArray if needed
        //print_r($resultArray);
    }
	
	
	
	
	
	public function saveVendorList($request){
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
						
						//$vendor['new_vendor_id'] = $user->id;
						//$ids['new_vendor_id'] = $user->id;
						$vendor['new_vendor_id'] = !empty($user->id)?$user->id:"";
						
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
	
	
	
	
	public function calculateDistance($lat1, $lon1, $lat2, $lon2) {
		//lat1, lon1 from request
		//lat2, lon2 from response
		
		//$p = 0.017453292519943295;
		//$c = cos;
		//$a = 0.5 - cos(($lat2 - $lat1) * $p) / 2 + cos($lat1 * $p) * cos($lat2 * $p) * (1 - cos(($lon2 - $lon1) * $p)) / 2;
		//$a = 0.5 - (float)cos(($lat2 - $lat1) * $p) / 2 + cos($lat1 * $p) * cos($lat2 * $p) * (1 - cos(($lon2 - $lon1) * $p)) / 2;
		
		//return (12742 * round(asin(sqrt($a))));
		
		//echo $lat1.'--c1--'.$lon1.'--c2--'.$lat2.'--c3--'.$lon2; die;
		
		$p = 0.017453292519943295;
		$latDiff = (float)($lat2 - $lat1);
		$lonDiff = (float)($lon2 - $lon1);

		$a = 0.5 - cos($latDiff * $p) / 2 + cos($lat1 * $p) * cos($lat2 * $p) * (1 - cos($lonDiff * $p)) / 2;
		$distance = 12742 * asin(sqrt((float)$a));

		// Optionally, round the distance to a specific decimal place if needed
		$roundedDistance = round($distance, 2);

		return $roundedDistance;
		
		
		
		
		
		
	}
	
	
	
	public function getServiceQueries($id) {
        $result = $whatsapp_lead_array = $call_lead_array = $cdata = [];
        //echo $id; //die; 
		
		$whatsapp_data = VendorLead::where('vendor_id', $id)->where('source', 'whatsapp')->get();
		$call_data = VendorLead::where('vendor_id', $id)->where('source', 'call')->get(); 
		
		//echo '<pre>'; print_r($whatsapp_data); echo '<pre>'; die;
		//echo '<pre>'; print_r($call_data); echo '<pre>'; die;
		
		//$id - vendor id
		//{{live_url}}api/get-call-history/27 - this is vendor id
		//echo $id;
		
		if(!empty($whatsapp_data)){
			foreach ($whatsapp_data as $whatsapp_lead) {
				// Accessing individual attributes
				$id = $whatsapp_lead->id;
				$vendorId = $whatsapp_lead->vendor_id;
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
				$vendorId = $call_lead->vendor_id;
				$source = $call_lead->source;
				// ... access other attributes as needed

				// You can also access the attributes as an array
				$call_lead_array[] = $call_lead->attributesToArray();

				// Do something with the data...
				// For example, you can print the data:
				
			}
		}
		
		//print_r($whatsapp_lead_array); die;
		
		//print_r($call_lead_array);
		//die;
		
		
		if($whatsapp_lead_array){
            foreach($whatsapp_lead_array as $a=>$d) {
				
				//echo '<pre>'; print_r($d); echo '<pre>'; die;
                $id = !empty($d['vendor_id'])?$d['vendor_id']:"";
				$reciever_id = !empty($d['reciever_id'])?$d['reciever_id']:"";
				//$v_details = Vendor::where("user_id",$id)->first(); //die;
				//echo $id; die;
				
				$cu_details = User::where("id",$reciever_id)->first();
				$v_details = Vendor::where("user_id",$id)->first();
				
				//$v_details = Vendor::where('user_id', $id)->get();
				
				//{{live_url}}api/get-call-history/27 - this is vendor id
				
				if(empty($v_details)){
					return $this->sendResponse([], 'No details');
				}else{
					
					$business_name = !empty($v_details->business_name)?$v_details->business_name:""; //die;
					$customer_name = !empty($cu_details->name)?$cu_details->name:""; //die;
					
					$catid = $d['main_cat'];
					$cat = Category::where("id",$catid)->first();
					//echo $cat->title;
					//echo '<pre>'; print_r($cat); echo '<pre>'; die;
					
					$vinfo = VendorContactInformation::where("vendor_id",$id)->first()->mobile_number; //die;
					
					//if($d->source=='whatsapp'){
						$res[$a]['id'] = $d['id'];
						$res[$a]['reciever_id'] = $d['reciever_id'];
						$res[$a]['category_id'] = $catid;
						$res[$a]['source'] = $d['source'];
						$res[$a]['location'] = $d['location'];
						$res[$a]['vendor_id'] = $id;
						
						$res[$a]['vendor'] = $business_name;
						$res[$a]['customer_name'] = $customer_name;
						
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
            foreach($call_lead_array as $a=>$d) {
				
				//echo '<pre>'; print_r($d); echo '<pre>'; die;
                $id = $d['vendor_id'];
				//$v_details = Vendor::where("user_id",$id)->first(); //die;
				//echo $id; die;
				$v_details = Vendor::where("user_id",$id)->first();
				
				//{{live_url}}api/get-call-history/27 - this is vendor id
				//echo $v_details->business_name;
				//echo '<pre>'; print_r($v_details); echo '<pre>'; die;
				
				if(empty($v_details)){
					return $this->sendResponse([], 'No vendor');
				}else{
					
					
					
					$business_name = !empty($v_details->business_name)?$v_details->business_name:""; //die;
					$catid = $d['main_cat'];
					$cat = Category::where("id",$catid)->first();
					
					$vinfo = VendorContactInformation::where("vendor_id",$id)->first()->mobile_number; //die;
					
					//if($d->source=='whatsapp'){
						$res[$a]['id'] = $d['id'];
						$res[$a]['reciever_id'] = $d['reciever_id'];
						$res[$a]['category_id'] = $catid;
						$res[$a]['source'] = $d['source'];
						$res[$a]['location'] = $d['location'];
						$res[$a]['vendor_id'] = $id;
						
						$res[$a]['vendor'] = $business_name;
						$res[$a]['category_title'] = !empty($cat->title)?$cat->title:"";
						
						
						$res[$a]['contact_number'] = !empty($vinfo)?$vinfo:"";
					//}
					
					//echo '<pre>'; print_r($res); echo '<pre>'; die;
					
					$cdata['call'] = $res;
					//echo '<pre>'; print_r($res); echo '<pre>'; die;
					
					
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
		
		
		//$result = $cdata;
		//echo '<pre>'; print_r($result); echo '<pre>'; die;
		//$result['message'] = $mHistory;
		
		if(empty($cdata['call']) && empty($cdata['wp_message']) ){
			return $this->sendResponse('', 'No Data');
		}else{
		
			$result = $cdata;
			return $this->sendResponse($result, 'Call History');
		}
		

        //return $this->sendResponse($result, 'Call History');
    }
	
	public function vendorDelete($id){
        $u = User::where(['id'=> $id,'status'=>'1','is_vendor'=>'1'])->get()->first();
        if($u){
            
			//echo '<pre>'; print_r($u); echo '</pre>';
			$u['is_delete'] = '1';
			$u['deleted_at'] = Carbon::now();
            $u->save();
			return $this->sendResponse("", 'Account Deleted'); 
        }
    }
	
	
	
	
	public function getAllServiceQueries($id) {
        $result = $whatsapp_lead_array = $call_lead_array = $cdata = [];
        //echo $id; //die; 
		
		$whatsapp_data = VendorLead::where('vendor_id', $id)->get();
		//$call_data = VendorLead::where('vendor_id', $id)->where('source', 'call')->get(); 
		
		//echo '<pre>'; print_r($whatsapp_data); echo '<pre>'; die;
		//echo '<pre>'; print_r($call_data); echo '<pre>'; die;
		
		//$id - vendor id
		//{{live_url}}api/get-call-history/27 - this is vendor id
		//echo $id;
		
		if(!empty($whatsapp_data)){
			foreach ($whatsapp_data as $whatsapp_lead) {
				// Accessing individual attributes
				$id = $whatsapp_lead->id;
				$vendorId = $whatsapp_lead->vendor_id;
				$source = $whatsapp_lead->source;
				// ... access other attributes as needed

				// You can also access the attributes as an array
				$whatsapp_lead_array[] = $whatsapp_lead->attributesToArray();

				// Do something with the data...
				// For example, you can print the data:
				
			}
		}
		
		
		
		
		
		//print_r($whatsapp_lead_array); die;
		
		//print_r($call_lead_array);
		//die;
		
		
		if($whatsapp_lead_array){
            foreach($whatsapp_lead_array as $a=>$d) {
				
				//echo '<pre>'; print_r($d); echo '<pre>'; die;
                $id = !empty($d['vendor_id'])?$d['vendor_id']:"";
				$reciever_id = !empty($d['reciever_id'])?$d['reciever_id']:"";
				//$v_details = Vendor::where("user_id",$id)->first(); //die;
				//echo $id; die;
				
				$cu_details = User::where("id",$reciever_id)->first();
				$v_details = Vendor::where("user_id",$id)->first();
				
				//$v_details = Vendor::where('user_id', $id)->get();
				
				//{{live_url}}api/get-call-history/27 - this is vendor id
				
				if(empty($v_details)){
					return $this->sendResponse([], 'No details');
				}else{
					
					$business_name = !empty($v_details->business_name)?$v_details->business_name:""; //die;
					$customer_name = !empty($cu_details->name)?$cu_details->name:""; //die;
					
					$catid = $d['main_cat'];
					$cat = Category::where("id",$catid)->first();
					//echo $cat->title;
					//echo '<pre>'; print_r($cat); echo '<pre>'; die;
					
					$vinfo = VendorContactInformation::where("vendor_id",$id)->first()->mobile_number; //die;
					
					//if($d->source=='whatsapp'){
						$res[$a]['id'] = $d['id'];
						$res[$a]['reciever_id'] = $d['reciever_id'];
						$res[$a]['category_id'] = $catid;
						$res[$a]['source'] = $d['source'];
						$res[$a]['location'] = $d['location'];
						$res[$a]['vendor_id'] = $id;
						
						$res[$a]['vendor'] = $business_name;
						$res[$a]['customer_name'] = $customer_name;
						
						$res[$a]['category_title'] = !empty($cat->title)?$cat->title:"";
						
						
						$res[$a]['contact_number'] = !empty($vinfo)?$vinfo:"";
					//}
					
					//echo '<pre>'; print_r($res); echo '<pre>'; die;
					
					$cdata['all_message'] = $res;
					//echo '<pre>'; print_r($res); echo '<pre>'; //die;
					
					
				}	
				
					
				
				
				//{{live_url}}api/get-call-history/27 - this is vendor id
					
					
				
				
				
            }
			
			//echo '<pre>'; print_r($cdata); echo '<pre>'; die;
			
        }
		
		
		
		
		
		
		
        //$result['call'] = $data;
		
		
		//$result = $cdata;
		//echo '<pre>'; print_r($result); echo '<pre>'; die;
		//$result['message'] = $mHistory;
		
		if(empty($cdata['all_message']) ){
			return $this->sendResponse('', 'No Data');
		}else{
		
			$result = $cdata;
			return $this->sendResponse($result, 'Call History');
		}
		

        //return $this->sendResponse($result, 'Call History');
    }
	
	
	public function saveVendorServices(Request $request) {
        
		$data = $request->all();
		if ($request->hasFile('business_logo')) {
			if ($request->file('business_logo')->isValid()) {

				$fileName=$request->file('business_logo')->getClientOriginalName();
				$fileName =time()."_".$fileName;

				//upload
				$request->file('business_logo')->move('uploads/users/', $fileName);
				$data['business_logo']=$fileName;
			}
		}
		
		VendorServices::create($data);
        return $this->sendResponse([], 'Service Saved!!');
    }
	
	
	public function getVendorOtherServices($id) {
        $data = VendorServices::where('vendor_id', $id)->get();
        return $this->sendResponse($data, 'Other Services List!!'); 
    }
	

}