<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use GuzzleHttp;
use GuzzleHttp\Client;

use Validator;
use Session;
use Hash;
use CustomValue;
use DB;
use Redirect;

use App\User;
use App\Category;
use App\Vendor;
use App\VendorCategory;
use App\VendorContactInformation;
use App\VendorServiceLocation;
use App\VendorRating;
use App\QueryForVendor;
use App\VendorLead;
use App\GoogleVendor;
use App\MembershipPlan;
use App\Chat;
use App\ChatHistory;
use App\GuestUser;
use App\ScrapperHost;
use App\VendorPlan;

use Illuminate\Contracts\Session\Session as SessionSession;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use App\Traits\Firebase;

class VendorController extends Controller
{
    use Firebase;

    public function vendor_list(Request $request) {
        DB::enableQueryLog();
        $query = Vendor::join('vendor_categories','vendor_categories.vendor_id','vendor.id')
        ->join('users','users.id','vendor.user_id')
        ->join('vendor_contact_info','vendor_contact_info.vendor_id','vendor.id')
        ->where(['vendor.status'=>'1','users.status'=>'1']);
        if($request->category_id != ''){
            $query->where('vendor_categories.category_id',$request->category_id);
        }
        $vendorWithCategory = $query->groupBy('vendor.id')->get()->toArray();
        $vendorWithLocation = [];
        $response = [];

        if($request->lat != '' && $request->lng != ''){
            $location = ['lat'=>$request->lat, 'lng'=>$request->lng];
            $vendorWithLocation = $this->getDistanceBetweenPoints($location);
            foreach($vendorWithCategory as $key => $vendor) {
                foreach($vendorWithLocation as $k => $val){
                    if($val['vendor_id'] == $vendor['vendor_id']){
                        $vendorWithCategory[$key]['service_location'] = $val['service_location'];
                        $response[] = $vendorWithCategory[$key];
                    }
                }
            }
        }
        else{
            $response = $vendorWithCategory;
        }
        // dd(DB::getQueryLog());
        $response = array_filter($response, function($value) {
            return !is_null($value) && $value !== "";
        });
          // print_r($response);die;

        if($response){
            $result = [
                'success' => true,
                'data'    => $response,
                'message' => 'Vendor Found!!',
            ];
            return $result;
        }
        else{
            
                $result = [
                    'success' => true,
                    'data'    => [],
                    'message' => 'No Vendor Found!!',
                ];
                return $result;
            
        }
    }

    public function getGoogleVendor($category, $location, $dist){
        $vendor = [];
        $cat = Category::find($category)->title;
        $google = GoogleVendor::where('category','Like','%'.$cat.'%')->get();
        if($google){
            foreach($google as $loc){
                $distance = CustomValue::getDistance($location, $loc);
                if($distance < $dist*5) {
                    $loc['type'] = 'google';
                    $vendor[] = $loc;
                }
            }
        }
        return $vendor;
    }

    public function getDistanceBetweenPoints($location) {
        $vendor = [];
        $data = VendorServiceLocation::where('status','1')->get();
        if($data){
            foreach($data as $loc){
                $distance = CustomValue::getDistance($location, $loc);
                if($distance < 1) {
                    $vendor[] = $loc;
                }
            }
        }
        else{
            $data = VendorContactInformation::where('status','1')->get();
            if($data){
                foreach($data as $loc){
                    $distance = CustomValue::getDistance($location, $loc);
                    if($distance < 5) {
                        $vendor[] = $loc;
                    }
                }
            }
        }
        
        return $vendor; 
    }

    public function vendor_google_list(Request $request){
        $host = ScrapperHost::find(1)->url;
        $client = new Client();
        $response = (string) $client->get($host."/data/json?cat=".$request->category."&address=".$request->location."&state=".$request->state."&nr_jd=".$request->limit."&nr_google=".$request->limit)->getBody();
        // $response = json_decode( $url);
		return $response;
    }

    public function vendor_share(Request $request){
        // print($request->vendor);
        $chat = [];
        $chat['sender_id'] = session('id') == 1 ? 0 : session('id');
        $chat['sender'] = 'admin';
        $chat['chat_id'] = $request->chat_id;
        $chat['message'] = "Share Vendor";
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
                        
        $lead['chat_id'] = $history->id;
        $lead['status'] = '0';
        // DB::enableQueryLog();
        if($request->vendor_validate) {
            $google = $this->save_vendor($request); 
            foreach($google as $vendor){
                $lead['vendor_id'] = $vendor;
                $lead['vendor_type'] = "google";
                VendorLead::create($lead);
            }
        }

        if($request->vendor){
            foreach($request->vendor as $vendor){
                $lead['vendor_type'] = isset($vendor['type']) ? "google" : "vendor";
                $lead['vendor_id'] = isset($vendor['type']) ? $vendor['id'] : $vendor['vendor_id'];
                VendorLead::create($lead);
            }
        }
        // dd(DB::getQueryLog());
        // dd($lead);
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

        return true;
    }

    function vendor_filter(){
		$request = request();

		$name=$request->name;
		$category=$request->category;
		$phone=$request->phone;

		$form = $request->form;
		$to = $request->to;

		return GoogleVendor::

		when($name, function ($query) use ($name) {
			return $query->where('google_vendor.name', "like","%" . $name . "%");
		})
		->when($category, function ($query) use ($category) {
			return $query->where('google_vendor.category', "like","%" . $category . "%");
		})
		->when($phone, function ($query) use ($phone) {
			return $query->where('google_vendor.phone', "like","%" . $phone . "%");
		})
		->when($form, function ($query) use ($form,$to) {
			if (!$form) {
				return $query->whereDate('google_vendor.created_at', $to);
			}
			if (!$to) {
				return $query->whereDate('google_vendor.created_at', $form);
			}
			return $query->whereBetween('google_vendor.created_at', [$form,$to]);
		});
	}

    public function google_vendor_view(Request $request){
        if(session('id') == 1){
            $vendor = $this->vendor_filter()->orderBy('id','desc')->paginate(50);
        }
        else{
            $vendor = $this->vendor_filter()->where('added_by',session('id'))->orderBy('id','desc')->paginate(50);
        }
        $total_users = $vendor->total();

        if($request->ajax()){

			$view = view('admin.googleVendor.google_vendor',compact('vendor'))->render();
			
			return response()->json([
				'total_users' => $total_users,
				'data' => $view,
			]);

		}else{
			return view('admin.googleVendor.index',array('vendor'=>$vendor,'total_users'=>$total_users));
		}
        // dd($vendor);
        
    }

    public function google_vendor_create(){
        return view('admin.googleVendor.create');
    }

    public function google_vendor_save(Request $request){
        if($request->vendor_validate) {
            $this->save_vendor($request);            
        }
    }

    public function google_vendor_delete($id){
        GoogleVendor::Destroy($id);
        return Redirect::back();
    }

    public function google_vendor_editview($id){
        $vendor = GoogleVendor::find($id);
        return view('admin.googleVendor.edit',array('vendor'=>$vendor));
    }

    public function save_vendor($req){
        $ids = [];
        foreach($req->vendor_validate as $key => $vendor){
            $exist = GoogleVendor::where('phone',$vendor['phone'])->first();
            if(!$exist && $vendor['category'] != ""){
                $client = new Client(); //GuzzleHttp\Client
                $result =(string) $client->post("https://maps.googleapis.com/maps/api/geocode/json?address=".$vendor['address']."&key=AIzaSyBG7U89RzBTCmuQTrNvrUlgaMT7phsiCQw")->getBody();
                $json =json_decode($result);
                // print_r($json);
                @$lat =$json->results[0]->geometry->location->lat;
                @$lng =$json->results[0]->geometry->location->lng;
                $validate['lat_lng'] = new Point($lat, $lng);
                $validate['location'] = $vendor['address'];
                $validate['name'] = $vendor['name'];
                $validate['phone'] = $vendor['phone'];
                $validate['category'] = $vendor['category'];
                $validate['search_category_id'] = $req->cat;
                $validate['search_location'] = $req->location;
                $validate['added_by'] = session('id');
                $google = GoogleVendor::create($validate);
                array_push($ids,$google->id);
            }
        }
        return $ids;
    }

    public function google_vendor_edit(Request $request, $id){
        $gvendor = GoogleVendor::find($id);
        $client = new Client(); //GuzzleHttp\Client
        $result =(string) $client->post("https://maps.googleapis.com/maps/api/geocode/json?address=".$request->location."&key=AIzaSyBG7U89RzBTCmuQTrNvrUlgaMT7phsiCQw")->getBody();
        $json =json_decode($result);
                // print_r($json);
        @$lat =$json->results[0]->geometry->location->lat;
        @$lng =$json->results[0]->geometry->location->lng;
        $gvendor['lat_lng'] = new Point($lat, $lng);
        $gvendor['location'] = $request->location;
        $gvendor['name'] = $request->name;
        $gvendor['category'] = $request->category;
        $gvendor['status'] = $request->status;
        $gvendor->save();
        
        return Redirect::back();
    }

    public function vendor_membership(){
        $vendor = VendorPlan::all();
        return view('admin.membership_vendor.index',array('vendor'=>$vendor));
    }

    public function vendor_membership_delete($id){
        VendorPlan::Destroy($id);
        
        $vendor = VendorPlan::all();
        return view('admin.membership_vendor.index',array('vendor'=>$vendor));
    }

    public function vendor_membership_create($id){
        $plan = VendorPlan::find($id);
        return view('admin.membership_vendor.create', array('vendor'=>$plan));
    }

    public function add_vendor_plan(Request $request){
        $vendorp = VendorPlan::where('id',$request->vendor_plan_id)->first();
        $vendorp['plan_id'] = $request->plan;
        $vendorp['payment_mode'] = 'cash';
        $vendorp['leads'] = (int)$vendorp['leads'] + (int)$request->lead;
        $vendorp->save();

        $vendor = VendorPlan::all();
        return view('admin.membership_vendor.index',array('vendor'=>$vendor));
    }    

    public function move_google_vendor(Request $request)
	{	
		$item = new User;
		
		$this->validate($request, [
            'name' => 'required',
			'email' => 'required|unique:users,email',
            'password' => 'required',
            'contact_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:users,contact_number',
		]);

        $records = $request->all();

        if ($request->hasFile('profile_pic')) {
			if ($request->file('profile_pic')->isValid()) {

				$fileName=$request->file('profile_pic')->getClientOriginalName();
				$fileName =time()."_".$fileName;

				//upload
				$image = $request->file('profile_pic');
				$directory = base_path('/uploads/users/');
				$imageUrl = $directory.$fileName;

				Image::make($image)->resize(300, 300)->save($imageUrl);
				$records['profile_pic']=$fileName;
			}
		}
		if($request->password!=''){
			$records['password']=Hash::make($request->password);
		}else{
			unset($records['password']);
		}
        $records['is_vendor'] = '1';
        $records['status'] = '1';
        $item->fill($records);
		$item->save();

        $data = GoogleVendor::find($request->google_vendor_id);
        $vendor['user_id'] = $item->id;
        $vendor['business_name'] = $data->name;
        $vendor['slug'] = str_replace(' ','-',strtolower($data->name));
        $v = Vendor::create($vendor);
        $loc['vendor_id'] = $v->id;
        $loc['mobile_number'] = $data->phone;
        $loc['email'] = $request->email;
        $loc['address'] = $data->location;
        $loc['lat_lng'] = $data->lat_lng;
        VendorContactInformation::create($loc);

        GoogleVendor::Destroy($request->google_vendor_id);

		return Redirect::route('admin.user.business_location',['userid'=>$item->id, 'id'=>$v->id])->with('message', 'Added Successfully ! ');
	}

}