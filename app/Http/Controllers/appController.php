<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\FreelancerAttendance;
use App\Models\Verification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\webUser;
use App\Mail\UserRegister;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Cpr_ad_category;
use App\Models\Seller_review;
use App\Models\Cpr_Add_post;
use App\Models\Cpr_ad_mapped_category;
use App\Models\Cpr_Add_images;
use App\Models\Cpr_wishlist;
use App\Models\Cpr_ad_enquiry;
use App\Models\Cpr_user_notification;
use App\Mail\UserNotification;
use App\Models\Cpr_ad_review;
use App\Models\Cpr_ad_chat;
use App\Models\Cpr_ad_chat_file;
use App\Models\Cpr_ad_category_mapped_filter;
use App\Models\cpr_ad_filter_values;
use App\Models\Cpr_Add_filter_value;
use App\Models\Cpr_user_photo;
use App\Models\Api_cat;
use App\Models\Cpr_auction;
use App\Models\Cpr_auction_enquiry;
use App\Models\Cpr_auction_bid;
use App\Models\Search_data;
use App\Models\Cpr_subscription;
use App\Mail\forgetPassword;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
class appController extends Controller
{

    public function user_registration(Request $request)
    {
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
        ]);
        $plan_date = Carbon::today();
        $old = webUser::where('phone',$request->phone)->where('account_type',$request->account_type)->first();
        if(isset($old))
        {
            return response()->json([
                'status' => "failed",
                'message' => "User Already Exist",                
            ],404);
        }
        $data = new webUser();
        $data->firstName = $request->firstName;
        $data->lastName = $request->lastName;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->account_type = $request->account_type;
        $data->plan_date = Carbon::today();
        $data->password = Hash::make($request->password);
        $data->save();
        $otp = rand(111111, 999999);
        Cpr_user_notification::insert(['user_id' => $data->id, 'title' => 'Signup Success', 'notification' => 'Your Account Has Been Registered successfully!']);

        // Mail::to($request->email)->send(new UserRegister($otp));
        $phone = $request->phone;
        Http::get('http://webmsg.smsbharti.com/app/smsapi/index.php?key=461010EFAF1B57&campaign=0&routeid=9&type=text&contacts='.$phone.'&senderid=SPTSMS&msg=Your otp is '.$otp.' SELECTIAL&template_id=1707166619134631839');

        return response()->json([
            'status' => 'success',
            'message' => "",
            'otp' => $otp,
            'email' => $request->email,
            'user_id' => $data->id,
        ], 200);
    }
    public  function signup_app(Request $request)
    {
        // return $request->all();
       $old = webUser::where('phone',$request->phone)->where('account_type',$request->account_type)->first();
        if(isset($old))
        {
            return response()->json([
                'status' => 'error',
                'message' => "User Already Exist",
            ], 404);
        }
        $image = null;
        $logo = null;
        $cac_certificate = null;
        $path = public_path('user');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        if ($request->hasFile('image')) {
            $rand_val = date('YMDHIS') . rand(11111, 99999);
            $image_file_name = md5($rand_val);
            $file = $request->file('image');
            $fileName = $image_file_name . '.' . $file->getClientOriginalExtension();
            $file->move($path, $fileName);
            $image = $fileName;
        }
        if ($request->hasFile('companyLogo')) 
        {

            $file = $request->file('companyLogo');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $fileName);
            $logo = $fileName;
        }
        if ($request->hasFile('cac_certificate')) {

            $file = $request->file('cac_certificate');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $fileName);
            $cac_certificate = $fileName;
        }

        $user = webUser::create($request->except('_token', 'image', 'companyLogo', 'cac_certificate', 'password') + ['image' => $image] + ['companyLogo' => $logo] + ['cac_certificate' => $cac_certificate] + ['password' => Hash::make($request->password)]);
        
        $plan_date = Carbon::today();
            
        $exdate = Carbon::now()->addDays(28);
            
        $ad = new Cpr_Add_post();
        $ad->user_id = $user->id;
        $ad->title = $request->companyName;
        $ad->country = $request->country;
        $ad->state = $request->state;
        $ad->city = $request->city;
        $ad->location = $request->location;
        $ad->negotiable = $request->negotiable;
        $ad->description = $request->description;
        $ad->price = $request->price;
        $ad->plan = "free";
        $ad->plan_date = $plan_date;
        $ad->video_url = $request->video_url;
        $ad->ExDate = $exdate;
        $ad->save();

        if (isset($request->category)) {
            $category = explode(',', $request->category);
            foreach ($category as $catg) {
                if (isset($catg)) {
                    $ct = '';
                    $ct = $catg;
                    $category = new Cpr_ad_mapped_category();
                    $category->ad_id = $ad->id;
                    $category->category_id = $ct;
                    $category->save();
                }
            }
        }
        
        
        return response()->json([
            'status' => 'success',
            'message' => "",
            'data' => (object)[]
        ],200);
    }

    public function fpassword(Request $request)
    {
        $data = webUser::where('phone', $request->phone)->first();
        if ($data) {
            $otp = rand(111111, 999999);
            $phone = $data->phone;
            // Mail::to($data->email)->send(new forgetPassword($otp));
            Http::get('http://webmsg.smsbharti.com/app/smsapi/index.php?key=461010EFAF1B57&campaign=0&routeid=9&type=text&contacts='.$phone.'&senderid=SPTSMS&msg=Your otp is '.$otp.' SELECTIAL&template_id=1707166619134631839');

            return response()->json([
                'status' => 'success',
                'message' => "An OTP send to your Email-Id",
                'otp' => $otp,
                'phone' => $request->phone,
            ], 200);
        } else {

            return response()->json([
                'status' => 'error',
                'message' => "Invalid Email Id",
            ], 404);
        }
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed',
        ]);
        webUser::where('phone', $request->phone)->update(['password' => Hash::make($request->password)]);

        return response()->json([
            'status' => 'success',
            'message' => "Your Password Has Been changed Successfully",
        ], 200);
    }

        public function resend_otp(Request $request)
        {
            $data = webUser::where('phone', $request->phone)->first();
            $phone = $request->phone;
            $otp = rand(111111, 999999);
            // Mail::to($data->email)->send(new UserRegister($otp));
            $phone = $request->phone;
            Http::get('http://webmsg.smsbharti.com/app/smsapi/index.php?key=461010EFAF1B57&campaign=0&routeid=9&type=text&contacts='.$phone.'&senderid=SPTSMS&msg=Your otp is '.$otp.' SELECTIAL&template_id=1707166619134631839');
            return response()->json([
                'status' => 'success',
                'message' => "",
                'otp' => $otp,
                'phone' => $request->phone,
            ], 200);
        }

    public function user_login(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'password' => 'required',
        ]);

        $data  = webUser::where('phone', $request->phone)->where('account_type', $request->account_type)->first();
        if (isset($data)) {

            if (Hash::check($request->password, $data->password)) {
                return response()->json([
                    'status' => 'success',
                    'message' => "",
                    'profile' => $data
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => "Password Was Wrong",
                    'data' => (object)[]
                ], 404);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => "User Not Found!!!",
                'data' => (object)[]
            ], 404);
        }
    }

    public function user_profile($id)
    {
        $data  = webUser::find($id);
        $url = env('APP_URL') . 'public/user/';
        
        if(isset($data))
        {
            if(isset($data->company_category))
            {
               $cat = Cpr_ad_category::find($data->company_category);
               
               $data->company_category_name = $cat?->category_name;
            }
            else
            {
                $data->company_category_name = '';
            }
        }
        return response()->json([
            'status' => 'success',
            'message' => "",
            'url' => $url,
            'profile' => $data
        ], 200);
    }

    public function profile_update(Request $request, $id)
    {
        $request->validate([
            'phone' => 'required|unique:web_users,id,'.$id,
        ]);

        $data = webUser::find($id);
        $image = $data->image;
        $logo = $data->companyLogo;
        $cac_certificate = $data->cac_certificate;
        $path = public_path('user');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        if ($request->hasFile('image')) {
            $rand_val = date('YMDHIS') . rand(11111, 99999);
            $image_file_name = md5($rand_val);
            $file = $request->file('image');
            $fileName = $image_file_name . '.' . $file->getClientOriginalExtension();
            $file->move($path, $fileName);
            $image = $fileName;
        }
        if ($request->hasFile('companyLogo')) {

            $file = $request->file('companyLogo');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $fileName);
            $logo = $fileName;
        }
        if ($request->hasFile('cac_certificate')) {

            $file = $request->file('cac_certificate');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $fileName);
            $cac_certificate = $fileName;
        }

        webUser::whereId($id)->update($request->except('_token', 'image', 'companyLogo', 'cac_certificate') + ['image' => $image] + ['companyLogo' => $logo] + ['cac_certificate' => $cac_certificate]);
        return response()->json([
            'status' => 'success',
            'message' => "",
            'data' => (object)[]
        ], 200);
    }

    public function add_images(Request $request, $id)
    {
        if ($request->hasFile('images')) {
            $path = public_path('/user');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            foreach ($request->file('images') as $img) {
                $file = $img;
                $fileName = uniqid() . '_' . trim($file->getClientOriginalName());
                $file->move($path, $fileName);
                $image = new Cpr_user_photo();
                $image->user_id = $id;
                $image->photos = $fileName;
                $image->save();
            }
        }
        return response()->json([
            'status' => 'success',
            'message' => "",
            'data' => (object)[]
        ], 200);
    }
    public function images_list($id)
    {
        $data = Cpr_user_photo::where('user_id', $id)->get();
        return response()->json([
            'status' => 'success',
            'message' => "",
            'photo_url' => env('APP_URL') . 'public/user/',
            'data' => $data
        ], 200);
    }

    public function main_category()
    {
        $cat = Cpr_ad_category::where('parent_id', 0)->orderBy('sort','asc')->get();
        $url = env('APP_URL') . 'public/public/category/icon/';
        return response()->json([
            'status' => 'success',
            'message' => "",
            'icon_url' => $url,
            'data' => $cat
        ], 200);
    }
    public function home_category()
    {
        $cat = Cpr_ad_category::where('parent_id', 0)->where('home',1)->orderBy('sort','asc')->get();
        $url = env('APP_URL') . 'public/public/category/icon/';
        return response()->json([
            'status' => 'success',
            'message' => "",
            'icon_url' => $url,
            'data' => $cat
        ], 200);
    }
    public function sub_category($id)
    {
        $cat = Cpr_ad_category::where('parent_id', $id)->orderBy('sort','asc')->get();
        $url = env('APP_URL') . 'public/public/category/icon/';
        return response()->json([
            'status' => 'success',
            'message' => "",
            'icon_url' => $url,
            'data' => $cat
        ], 200);
    }

    public function provider_list($id)
    {
        $data  = webUser::where('company_category', $id)
            ->where('status', 1)
            ->where('account_type', 'v')
            ->get(['id', 'firstName', 'lastName', 'phone', 'companyName', 'companyAddress', 'companyLogo', 'company_category']);



        foreach ($data as $key => $value) {
            if (isset($value->company_category)) {
                $cat = Cpr_ad_category::find($value->company_category);
            } else {
                $cat = '';
            }
            $data[$key]->company_category = $cat->category_name;
            $data[$key]->company_category_id = $cat->id;

            $reviewSeller = Seller_review::where('seller_id', $value->id)->orderByDesc('id')->get();
            $AvSeller = Seller_review::where('seller_id', $value->id)->sum('rating');
            $revcntSeller = $reviewSeller->count();
            $revcntSeller == 0 ? $revAveSeller = 0 : $revAveSeller = $AvSeller / $revcntSeller;
            $data[$key]->rating = (int)$revAveSeller;
        }

        return response()->json([
            'status' => 'success',
            'message' => "",
            'log_url' => $url = env('APP_URL') . 'public/user/',
            'data' => $data
        ], 200);
    }
    public function provider_list_subcat(Request $request, $id)
    {
        $ads  =  Cpr_ad_mapped_category::where('category_id', $id)->pluck('ad_id')->toArray();
        
        $prov =  Cpr_Add_post::whereIn('id',$ads)->pluck('user_id')->toArray();
        
        $apicat = Api_cat::where('map_cat_id',$id)->pluck('api_cat')->toArray();
        
        $apiads = Cpr_Add_post::whereIn('api_cat',$apicat)->pluck('user_id')->toArray();
    
        $allad = array_merge($apiads,$prov);
        
        $latitude = $request->latitude; // Replace with your desired latitude
        $longitude = $request->longitude; // Replace with your desired longitude
        $radiusInKm = 50;


        $data = webUser::whereIn('id', array_unique($allad))->withinRadius($latitude, $longitude)
            ->selectRaw("id,firstName,lastName,phone,companyName,companyAddress,location,companyLogo, company_category,latitude, longitude,status,account_type")
            ->orderBy("distance", 'asc')
            ->where('status', 1)
            ->where('account_type', 'v')
            ->get();

        foreach ($data as $key => $value) {
            if (isset($value->company_category)) {
                $cat = Cpr_ad_category::find($value->company_category);
            } else {
                $cat = '';
            }
            $data[$key]->company_category = $cat->category_name;
            $data[$key]->company_category_id = $cat->id;

            $reviewSeller = Seller_review::where('seller_id', $value->id)->orderByDesc('id')->get();
            $AvSeller = Seller_review::where('seller_id', $value->id)->sum('rating');
            $revcntSeller = $reviewSeller->count();
            $revcntSeller == 0 ? $revAveSeller = 0 : $revAveSeller = $AvSeller / $revcntSeller;
            $data[$key]->rating = (int)$revAveSeller;
        }

        return response()->json([
            'status' => 'success',
            'message' => "",
            'log_url' => $url = env('APP_URL') . 'public/user/',
            'data' => $data
        ], 200);
    }

    public function provider_detail($id)
    {
        $data  = webUser::whereId($id)
            ->where('status', 1)
            ->where('account_type', 'v')
            ->first();
        $photos = Cpr_user_photo::where('user_id', $id)->get();
        if (isset($data->company_category)) {
            $cat = Cpr_ad_category::find($data->company_category);
        } else {
            $cat = '';
        }
        $data->company_category = $cat->category_name;
        $data->company_category_id = $cat->id;

        $servises = Cpr_Add_post::where('user_id', $id)->orderByDesc('id')->get()->makeHidden([
            "subCategory1",
            "subCategory2",
            "subCategory3",
            "subCategory4",
            "subCategory5",
        ]);
        foreach ($servises as $key => $value) {

            $subcat =  Cpr_ad_mapped_category::where('ad_id', $value->id)->latest('id')->first();
            $adimg =  Cpr_Add_images::where('ad_id', $value->id)->first();
            $allimg =  Cpr_Add_images::where('ad_id', $value->id)->get();

            if (isset($subcat->category_id)) {
                $sb = Cpr_ad_category::find($subcat->category_id);
                $sub = $sb ? $sb->category_name : '';
            } else {
                $sub = '';
            }
            $servises[$key]->sub_category =  $sub;
            $servises[$key]->logo =  $adimg ? $adimg->image : '';
            $servises[$key]->images =  $allimg ? $allimg : [];
        }
        $products = $servises;
        $reviwes = Seller_review::where('seller_id', $id)->orderByDesc('id')->get();
        foreach ($reviwes as $key => $reviwe) {
            $use =  webUser::find($reviwe->user_id);
            if (isset($use)) {
                $reviwes[$key]->user_logo = $use->image;
            } else {
                $reviwes[$key]->user_logo = '';
            }
        }
        return response()->json([
            'status' => 'success',
            'message' => "",
            'logo_url' => env('APP_URL') . 'public/user/',
            'photo_url' => env('APP_URL') . 'public/user/',
            'service_logo_url' => env('APP_URL') . 'public/ad/',
            'product_logo_url' => env('APP_URL') . 'public/ad/',
            'data' => $data,
            'servises' => $servises,
            'reviwes' => $reviwes,
            'products' => $products,
            'photos' => $photos,
        ], 200);
    }

    public function wish_list($id)
    {
        $wishlist = Cpr_wishlist::join('cpr__add_posts', 'cpr__add_posts.id', 'cpr_wishlists.ad_id')->where('cpr_wishlists.user_id', $id)->select('cpr__add_posts.*', 'cpr_wishlists.*', 'cpr_wishlists.id as wishId')->get();
        if (!empty($wishlist)) {
            foreach ($wishlist as $key => $val) {
                $pics = Cpr_Add_images::where('ad_id', $val->ad_id)->orderBy('image_order', 'ASC')->first();
                $wishlist[$key]->image = $pics->image;
                $subcat =  Cpr_ad_mapped_category::where('ad_id', $val->ad_id)->first();
                if (isset($subcat->category_id)) {
                    $sb = Cpr_ad_category::find($subcat->category_id);
                    $sub = $sb ? $sb->category_name : '';
                } else {
                    $sub = '';
                }
                $wishlist[$key]->category =  $sub;
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => "",
            'image_url' => env('APP_URL') . 'public/ad/',
            'wishlist' => $wishlist
        ], 200);
    }
    public function service_list($id)
    {
        $servises = Cpr_Add_post::where('user_id', $id)->orderByDesc('id')->get()->makeHidden([
            "subCategory1",
            "subCategory2",
            "subCategory3",
            "subCategory4",
            "subCategory5",
        ]);
        foreach ($servises as $key => $value) {

            $subcat =  Cpr_ad_mapped_category::where('ad_id', $value->id)->first();
            $adimg =  Cpr_Add_images::where('ad_id', $value->id)->first();
            $images =  Cpr_Add_images::where('ad_id', $value->id)->get();
            if (isset($subcat->category_id)) {
                $sb = Cpr_ad_category::find($subcat->category_id);
                $sub = $sb ? $sb->category_name : '';
            } else {
                $sub = '';
            }
            $servises[$key]->category =  $sub;
            $servises[$key]->logo =  $adimg ? $adimg->image : '';
            $servises[$key]->images =  $images ? $images : [];
        }

        return response()->json([
            'status' => 'success',
            'message' => "",
            'service_logo_url' => env('APP_URL') . 'public/ad/',
            'servises' => $servises
        ], 200);
    }

    public function service_response($id)
    {
        $servises = Cpr_Add_post::where('user_id', $id)->orderByDesc('id')->get()->makeHidden([
            "subCategory1",
            "subCategory2",
            "subCategory3",
            "subCategory4",
            "subCategory5",
        ]);
        foreach ($servises as $key => $value) {

            $subcat =  Cpr_ad_mapped_category::where('ad_id', $value->id)->first();
            $adimg =  Cpr_Add_images::where('ad_id', $value->id)->first();
            if (isset($subcat->category_id)) {
                $sb = Cpr_ad_category::find($subcat->category_id);
                $sub = $sb ? $sb->category_name : '';
            } else {
                $sub = '';
            }
            $servises[$key]->category =  $sub;
            $servises[$key]->logo =  $adimg ? $adimg->image : '';

            $cnt = Cpr_ad_enquiry::where('ad_id', $value->id)->count();

            $servises[$key]->response_count =  $cnt;
        }

        return response()->json([
            'status' => 'success',
            'message' => "",
            'response_logo_url' => env('APP_URL') . 'public/ad/',
            'response' => $servises
        ], 200);
    }

    public function service_queries($id)
    {
        $enquiries = Cpr_ad_enquiry::join('cpr__add_posts', 'cpr__add_posts.id', 'cpr_ad_enquiries.ad_id')->where('cpr_ad_enquiries.user_id', $id)->orderByDesc('cpr_ad_enquiries.id')->get();
        foreach ($enquiries as $key => $value) {

            $subcat =  Cpr_ad_mapped_category::where('ad_id', $value->ad_id)->first();
            $adimg =  Cpr_Add_images::where('ad_id', $value->ad_id)->first();
            if (isset($subcat->category_id)) {
                $sb = Cpr_ad_category::find($subcat->category_id);
                $sub = $sb ? $sb->category_name : '';
            } else {
                $sub = '';
            }
            $enquiries[$key]->category =  $sub;
            $enquiries[$key]->logo =  $adimg ? $adimg->image : '';
        }
        return response()->json([
            'status' => 'success',
            'message' => "",
            'enquiries_logo_url' => env('APP_URL') . 'public/ad/',
            'enquiries' => $enquiries
        ], 200);
    }

    public function notification($id)
    {
        $noti = Cpr_user_notification::where('user_id', $id)->orderByDesc('id')->limit(10)->get();
        $notiCount = Cpr_user_notification::where('user_id', $id)->whereDate('created_at', '= ', Carbon::today())->count('id');
        return response()->json([
            'status' => 'success',
            'message' => "",
            'notification_count' => $notiCount,
            'notification' => $noti,
        ], 200);
    }

    public function send_Offer(Request $request, $id)
    {

        $old  =  Cpr_ad_enquiry::where('user_id', $id)->where('ad_id', $request->ad_id)->first();
        if (!isset($old)) {
            $own = Cpr_Add_post::find($request->ad_id);
            $user1 = webUser::find($id);
            $data = new Cpr_ad_enquiry();
            $data->name = $user1->firstName . ' ' . $user1->lastName;
            $data->phone = $user1->phone;
            $data->email = $user1->email;
            $data->subject = $request->offer;
            $data->message = $request->message;
            $data->ad_id = $request->ad_id;
            $data->reciever_id = $own->user_id;
            $data->main_cat = $request->main_cat;
            $data->source = $request->source;
            $data->user_id = $id;
            $data->save();

            $msg = "One Buyer name: " . $data->name . " interested in Your Ad!";
                $datan = new Cpr_ad_chat();
                $datan->sender_id = $id;
                $datan->receiver_id = $own->user_id;
                $datan->ad_id = $request->ad_id;
                $datan->message = "Offering Rs.".$request->offer." for this service.".$request->message;
                $datan->save();
            $user = webUser::find($own->user_id);
            Cpr_user_notification::insert(['user_id' => $own->user_id, 'sender_id' => $data->user_id, 'ad_id' => $data->ad_id, 'title' => 'Buyer Contacted', 'notification' => 'One Buyer name: ' . $data->name . ' interested in Your Ad!!', 'type' => 'lead', 'source' => $request->source]);

            // Mail::to($user->email)->send(new UserNotification($msg));
            return response()->json([
                'status' => 'success',
                'message' => "Offer Send successfully",
                'data' => (object)[]
            ], 200);
        } else {
            return response()->json([
                'status' => 'success',
                'message' => "Offer Already Exist",
                'data' => (object)[]
            ], 404);
        }
    }
    public function send_Offer_App(Request $request, $id)
    {
        $old  =  Cpr_ad_enquiry::where('user_id', $id)->where('reciever_id', $request->reciever_id)->first();
        if (!isset($old)) {
            $user1 = webUser::find($id);
            $data = new Cpr_ad_enquiry();
            $data->name = $user1->firstName . ' ' . $user1->lastName;
            $data->phone = $user1->phone;
            $data->email = $user1->email;
            $data->reciever_id = $request->reciever_id;
            $data->source = $request->source;
            $data->main_cat = $request->main_cat;
            $data->user_id = $id;
            $data->save();
            $own = webUser::find($request->reciever_id);
            $name = $own->firstName . ' ' . $own->lastName;
            $msg = "One Buyer name: " . $name . " interested in Your Ad!";
            Cpr_user_notification::insert(['user_id' => $request->reciever_id, 'sender_id' => $data->user_id, 'title' => 'Buyer Contacted', 'notification' => 'One Buyer name: ' . $data->name . ' interested in Your Ad!!', 'type' => 'lead', 'source' => $request->source]);

            // Mail::to($own->email)->send(new UserNotification($msg));
            return response()->json([
                'status' => 'success',
                'message' => "Offer Send successfully",
                'data' => (object)[]
            ], 200);
        } else {
            return response()->json([
                'status' => 'success',
                'message' => "Offer Already Exist",
                'data' => (object)[]
            ], 404);
        }
    }
    public function user_review(Request $request, $id)
    {
        $user1 = webUser::find($id);
        $data = new Seller_review();
        $data->user_id = $id;
        $data->seller_id = $request->user_id;
        $data->name = $user1->firstName . ' ' . $user1->lastName;
        $data->email = $user1->email;
        $data->rating = $request->rating;
        $data->review_title = $request->review_title;
        $data->review = $request->message;
        $data->save();

        return response()->json([
            'status' => 'success',
            'message' => "Review Send successfully",
            'data' => (object)[]
        ], 200);
    }
    public function subscription(Request $request, $id)
    {
            $cbs = Cpr_subscription::find($request->plan);
            
            $plan_date = Carbon::now();
            
            $plan_exp_date = Carbon::now()->addDays($cbs->validity_days);
        
            webUser::whereId($id)->update(['plan' => $cbs->id, 'plan_date' => $plan_date, 'plan_exp_date' => $plan_exp_date]);
            
        
            return response()->json([
                'status' => 'success',
                'message' => "Payment successfully",
                'data' => (object)[]
            ], 200);
    }

    function search_data(Request $request)
    {
        // array_unique
        $cat = Cpr_ad_category::where('category_name', 'like', "%{$request->keyword}%")->pluck('id')->toArray();
        
        $post = Cpr_ad_mapped_category::whereIn('category_id', $cat)->pluck('ad_id')->toArray();
        
        $apicat = Api_cat::whereIn('map_cat_id',$cat)->pluck('api_cat')->toArray();
        
        $apiads = Cpr_Add_post::whereIn('api_cat',$apicat)->pluck('id')->toArray();
    
        $allad = array_merge($apiads,$post);

        $pro = Cpr_Add_post::whereIn('id',array_unique($allad))->pluck('user_id')->toArray();

        $latitude = $request->latitude; // Replace with your desired latitude
        $longitude = $request->longitude;

        $keyword = $request->keyword;
        $data  = webUser::where('status', 1)
            ->where(function ($query) use ($pro, $keyword) {
                $query->OrwhereIn('id', array_unique($pro));
                $query->Orwhere('companyName', 'like', "%{$keyword}%");
                $query->Orwhere('firstName', 'like', "%{$keyword}%");
                $query->Orwhere('lastName', 'like', "%{$keyword}%");
            })
            ->withinRadius($latitude, $longitude)
            ->where('account_type', 'v')
            ->get(['id', 'firstName', 'lastName', 'phone', 'companyName', 'companyAddress', 'companyLogo', 'company_category']);

        foreach ($data as $key => $value) {
            if (isset($value->company_category)) {
                $cat = Cpr_ad_category::find($value->company_category);
            } else {
                $cat = '';
            }
            $data[$key]->company_category = $cat->category_name;
            $data[$key]->company_category_id = $cat->id;

            $reviewSeller = Seller_review::where('seller_id', $value->id)->orderByDesc('id')->get();
            $AvSeller = Seller_review::where('seller_id', $value->id)->sum('rating');
            $revcntSeller = $reviewSeller->count();
            $revcntSeller == 0 ? $revAveSeller = 0 : $revAveSeller = $AvSeller / $revcntSeller;
            $data[$key]->rating = (int)$revAveSeller;
        }

        return response()->json([
            'status' => 'success',
            'message' => "",
            'log_url' => $url = env('APP_URL') . 'public/user/',
            'data' => $data
        ], 200);
    }
    function user_chat(Request $request, $id)
    {
        // dd($request->file('chatfile'));
        $data = new Cpr_ad_chat();
        $data->sender_id = $id;
        $data->receiver_id = $request->receiver_id;
        $data->ad_id = $request->ad_id;
        $data->chat_file_name = $request->chatfilename;
        $data->message = $request->chatMessage;
        $data->save();
        if ($request->hasFile('chatfile')) {

            $path = public_path('/ad_chat');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }


            foreach ($request->file('chatfile') as $img) {

                //  return "hello";
                $file = $img;
                $fileName = uniqid() . '_' . trim($file->getClientOriginalName());
                $file->move($path, $fileName);
                $image = new Cpr_ad_chat_file();
                $image->chat_id = $data->id;
                $image->chatfile = $fileName;
                $image->save();
            }
        }
        $rec = webUser::find($request->receiver_id);
        $send = webUser::find($id);
        $msg = "You have received A message from " . $send->firstName . " " . $send->lastName . " ";
        Cpr_user_notification::insert(['user_id' => $request->receiver_id, 'ad_id' => $data->ad_id, 'title' => 'Ad Chat', 'notification' => $msg]);
        // Mail::to($rec->email)->send(new UserNotification($msg));

        return response()->json([
            'status' => 'success',
            'message' => "Message Send successfully",
            'data' => (object)[]
        ], 200);
    }
    function chat_list(Request $request)
    {
        $rec_id = $request->receiver_id;
        $data = Cpr_ad_chat::where(function ($query) use ($rec_id) {
            $query->Orwhere('sender_id', $rec_id);
            $query->Orwhere('receiver_id', $rec_id);
        })->where('ad_id', $request->ad_id)->get();

        foreach ($data as $key => $value) {
            $send = webUser::find($value->sender_id);
            $receiver = webUser::find($value->receiver_id);
            $data[$key]->sender_name = $send ? $send->firstName . " " . $send->lastName : '';
            $data[$key]->receiver_name = $receiver ? $receiver->firstName . " " . $receiver->lastName : '';
            $files = Cpr_ad_chat_file::where('chat_id', $value->id)->pluck('chatfile')->toArray();
            $data[$key]->attach_files = $files;
        }
        return response()->json([
            'status' => 'success',
            'message' => "",
            'file_url' => $url = env('APP_URL') . 'public/ad_chat/',
            'data' => $data
        ], 200);
    }
    public function show_response(Request $request)
    {
        $enquiries = Cpr_ad_enquiry::join('web_users', 'web_users.id', 'cpr_ad_enquiries.user_id')->where('cpr_ad_enquiries.ad_id', $request->ad_id)->orderByDesc('cpr_ad_enquiries.id')->get();
        return response()->json([
            'status' => 'success',
            'message' => "",
            'file_url' => $url = env('APP_URL') . 'public/user/',
            'data' => $enquiries
        ], 200);
    }

    public function addtowish(Request $request, $id)
    {
        $data = new Cpr_wishlist();
        $data->ad_id = $request->ad_id;
        $data->user_id = $id;
        $data->save();

        return response()->json([
            'status' => 'success',
            'message' => "Servise added to wishlist",
            'data' => (object)[]
        ], 200);
    }
    public function removefromwish($id)
    {
        Cpr_wishlist::whereId($id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => "Servise removed from wishlist",
            'data' => (object)[]
        ], 200);
    }

    function servicefilter($id)
    {
        $data = Cpr_ad_category_mapped_filter::join('cpr_ad_filters', 'cpr_ad_filters.id', 'cpr_ad_category_mapped_filters.filter_id')->where('cpr_ad_category_mapped_filters.category_id', $id)->get(['cpr_ad_category_mapped_filters.*', 'cpr_ad_filters.*', 'cpr_ad_category_mapped_filters.id as id']);
        $fiters = array();
        foreach ($data as $key => $value) {
            $fil = cpr_ad_filter_values::where('filter_id', $value->filter_id)->get(['id', 'filter_value']);
            $data[$key]->filter_value = $fil;
            $fiters[$key]['parent_category'] = $value->category_id;
            $fiters[$key]['filter_id'] = $value->filter_id;
            $fiters[$key]['filter_name'] = $value->filter_name;
            $fiters[$key]['filter_values'] = $fil;
        }
        return response()->json([
            'status' => 'success',
            'message' => "",
            'data' => $fiters
        ], 200);
    }
    public function addService(Request $request, $id)
    {
            $user = webUser::find($id);
        
            $cbs = Cpr_subscription::find($user->plan);
            
            $plan_date = $user->plan_date;
            
            $exdate = Carbon::now()->addDays($user->validity_days);
            
            $addcount = Cpr_Add_post::where('user_id', $user->id)->where('plan',$user->plan)->count('id');
            
            if ($addcount == $cbs->number_of_enquiries) {
                $msg = "warning ! Your Current plan Capacity is Over!";
                Cpr_user_notification::insert(['user_id' => $user->id, 'title' => 'Plan Upgrade', 'notification' => 'warning ! Your Current plan Capacity is Over!']);
                // Mail::to($user->email)->send(new UserNotification($msg));
                return response()->json([
                    'status' => 'warning',
                    'message' => "Your Current plan Capacity is Over!",
                    'data' => (object)[]
                ], 404);
            }
            
        $ad = new Cpr_Add_post();
        $ad->user_id = $user->id;
        $ad->title = $request->title;
        $ad->country = $request->country;
        $ad->state = $request->state;
        $ad->city = $request->city;
        $ad->location = $request->location;
        $ad->negotiable = $request->negotiable;
        $ad->description = $request->description;
        $ad->price = $request->price;
        $ad->plan = $request->plan;
        $ad->plan_date = $plan_date;
        $ad->video_url = $request->video_url;
        $ad->ExDate = $exdate;
        $ad->save();
        $msg = "Post Saved Successfully!";

        if (isset($request->category)) {
            $category = explode(',', $request->category);
            foreach ($category as $catg) {
                if (isset($catg)) {
                    $ct = '';
                    $ct = $catg;
                    $category = new Cpr_ad_mapped_category();
                    $category->ad_id = $ad->id;
                    $category->category_id = $ct;
                    $category->save();
                }
            }
        }

        if (isset($request->filter)) {
            $filter_value = explode(',', $request->filter);
            foreach ($filter_value as $filt) {
                if (isset($filt)) {
                    $filter = new Cpr_Add_filter_value();
                    $filter->ad_id = $ad->id;
                    $filter->cat_id = $ct;
                    $filter->filter_value_id = $filt;
                    $filter->save();
                }
            }
        }
        if ($request->hasFile('images')) {
            $path = public_path('/ad');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            foreach ($request->file('images') as $img) {
                $file = $img;
                $fileName = uniqid() . '_' . trim($file->getClientOriginalName());
                $file->move($path, $fileName);
                $image = new Cpr_Add_images();
                $image->ad_id = $ad->id;
                $image->image = $fileName;
                $image->save();
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => "",
            'data' => (object)[]
        ], 200);
    }
    public function updateService(Request $request, $id)
    {
        $ad = Cpr_Add_post::find($id);
        $ad->title = $request->title;
        $ad->country = $request->country;
        $ad->state = $request->state;
        $ad->city = $request->city;
        $ad->location = $request->location;
        $ad->negotiable = $request->negotiable;
        $ad->description = $request->description;
        $ad->price = $request->price;
        $ad->video_url = $request->video_url;
        $ad->save();
        if (isset($request->filter)) {
            $catid = Cpr_ad_mapped_category::where('ad_id', $id)->orderBy('id', 'desc')->first();
            Cpr_Add_filter_value::where('ad_id', $id)->delete();
            $filter_value = explode(',', $request->filter);
            foreach ($filter_value as $filt) {
                if (isset($filt)) {
                    $filter = new Cpr_Add_filter_value();
                    $filter->ad_id = $id;
                    $filter->cat_id = $catid;
                    $filter->filter_value_id = $filt;
                    $filter->save();
                }
            }
        }
        if ($request->hasFile('images')) {
            $path = public_path('/ad');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            Cpr_Add_images::where('ad_id', $id)->delete();
            foreach ($request->file('images') as $img) {
                $file = $img;
                $fileName = uniqid() . '_' . trim($file->getClientOriginalName());
                $file->move($path, $fileName);
                $image = new Cpr_Add_images();
                $image->ad_id = $id;
                $image->image = $fileName;
                $image->save();
            }
        }


        return response()->json([
            'status' => 'success',
            'message' => "",
            'data' => (object)[]
        ], 200);
    }

    public function editService($id)
    {
        $data = Cpr_Add_post::find($id);

        $cat =  Cpr_ad_mapped_category::where('ad_id', $id)->get();
        $catid = Cpr_ad_mapped_category::where('ad_id', $id)->orderBy('id', 'desc')->first();
        $fl = Cpr_ad_category_mapped_filter::join('cpr_ad_filters', 'cpr_ad_filters.id', 'cpr_ad_category_mapped_filters.filter_id')->where('cpr_ad_category_mapped_filters.category_id', $catid->category_id)->get(['cpr_ad_category_mapped_filters.*', 'cpr_ad_filters.*', 'cpr_ad_category_mapped_filters.id as id']);

        $fiters = array();
        foreach ($fl as $key => $value) {

            $fil = cpr_ad_filter_values::where('filter_id', $value->filter_id)->get(['id', 'filter_value']);
            $fl[$key]->filter_value = $fil;
            $fiters[$key]['parent_category'] = $value->category_id;
            $fiters[$key]['filter_id'] = $value->filter_id;
            $fiters[$key]['filter_name'] = $value->filter_name;
            $fiters[$key]['filter_values'] = $fil;
        }
        $filtervalues = Cpr_Add_filter_value::where('ad_id', $id)->get();
        $photos =  Cpr_Add_images::where('ad_id', $id)->get();

        return response()->json([
            'status' => 'success',
            'message' => "",
            'photo_url' => env('APP_URL') . 'public/ad/',
            'filtercate' => $catid,
            'category' => $cat,
            'filters' => $fiters,
            'filtervalues' => $filtervalues,
            'photo' => $photos,
            'data' => $data,
        ], 200);
    }
    public function delete_service($id)
    {
        Cpr_Add_filter_value::where('ad_id', $id)->delete();
        Cpr_Add_images::where('ad_id', $id)->delete();
        Cpr_ad_mapped_category::where('ad_id', $id)->delete();
        Cpr_Add_post::whereId($id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => "Service Deleted Successfully",
            'data' => (object)[]
        ], 200);
    }
    public function state_list()
    {
        $state = DB::table('states')->where('country_id', 101)->orderBy('name', 'ASC')->get(['id', 'name']);

        return response()->json([
            'status' => 'success',
            'message' => "",
            'data' => $state
        ], 200);
    }
    public function city_list($id)
    {
        $state = DB::table('cities')->where('country_id', 101)->where('state_id', $id)->orderBy('name', 'ASC')->get(['id', 'name']);

        return response()->json([
            'status' => 'success',
            'message' => "",
            'data' => $state
        ], 200);
    }

    public function enquiry_list(Request $request, $id)
    {
        // $data = Cpr_ad_enquiry::where('source','!=','web')->where('reciever_id',$id);

        $data = Cpr_ad_enquiry::join('web_users', 'web_users.id', 'cpr_ad_enquiries.user_id')->where('cpr_ad_enquiries.reciever_id', $id)->where('cpr_ad_enquiries.source', '!=', 'web')->orderByDesc('cpr_ad_enquiries.id');

        if (isset($request->source)) {
            $data = $data->where('cpr_ad_enquiries.source', $request->source);
        }
        $data = $data->get();

        return response()->json([
            'status' => 'success',
            'message' => "",
            'file_url' => $url = env('APP_URL') . 'public/user/',
            'data' => $data
        ], 200);
    }

    public function lead_history($id)
    {
        $noti = Cpr_user_notification::where('user_id', $id)->where('type', 'lead')->orderByDesc('id')->get();
        
        $used_list = $noti->count();
        $remaining = 100 - $used_list;
        $use =  webUser::find($id);
        
        $plan = Cpr_subscription::find($use->plan);
        
        foreach ($noti as $key => $value) {
            $own = webUser::find($value->sender_id);
            $noti[$key]->buyer = $own?->firstName . ' ' . $own?->lastName;
        }
        return response()->json([
            'status' => 'success',
            'message' => "",
            'plan' => $plan?->name,
            'used_leads' => $used_list,
            'remaining_leads' => $remaining,
            'profile' => $use,
            'url' => env('APP_URL') . 'public/user/',
            'data' => $noti
        ], 200);
    }

    public function auction_list($id)
    {
        $data = Cpr_auction::where('auction_start_time', '<=', date('Y-m-d H:i:00'))->where('cpr_ad_category_id', $id)->orderByDesc('id')->get();

        foreach ($data as $key => $value) {
            $cat = Cpr_ad_category::find($id);
            $data[$key]->cat_name = $cat->category_name;
            $data[$key]->cat_image = $cat->icon;
            $number = Cpr_auction_enquiry::where('cpr_auction_id', $value->id)->count();
            $part = Cpr_auction_bid::where('cpr_auction_id', $value->id)->count();
            $data[$key]->lead_qty = $number;
            $data[$key]->total_participants = $part;
        }

        return response()->json([
            'status' => 'success',
            'icon_url' => env('APP_URL') . 'public/public/category/icon/',
            'message' => "",
            'data' => $data
        ], 200);
    }
    public function upcoming_auction_list($id)
    {
        $data = Cpr_auction::where('auction_start_time', '>', date('Y-m-d H:i:00'))->where('cpr_ad_category_id', $id)->orderByDesc('id')->get();

        foreach ($data as $key => $value) {
            $cat = Cpr_ad_category::find($id);
            $data[$key]->cat_name = $cat->category_name;
            $data[$key]->cat_image = $cat->icon;
            $number = Cpr_auction_enquiry::where('cpr_auction_id', $value->id)->count();
            $part = Cpr_auction_bid::where('cpr_auction_id', $value->id)->count();
            $data[$key]->lead_qty = $number;
            $data[$key]->total_participants = $part;
        }

        return response()->json([
            'status' => 'success',
            'icon_url' => env('APP_URL') . 'public/public/category/icon/',
            'message' => "",
            'data' => $data
        ], 200);
    }

    public function palce_bid(Request $request, $id)
    {
        $data = new Cpr_auction_bid();
        $data->cpr_auction_id = $request->auction_id;
        $data->web_user_id = $id;
        $data->bid_amount = $request->amount;
        $data->save();
        return response()->json([
            'status' => 'success',
            'message' => "Bid Placed Successfully",
            'data' => (object)[]
        ], 200);
    }
    public function participants_list($id)
    {

        $data = Cpr_auction_bid::where('cpr_auction_id', $id)->orderByDesc('id')->get();

        foreach ($data as $key => $value) {
            $use =  webUser::find($value->web_user_id);
            $data[$key]->name = $use->firstName . ' ' . $use->lastName;
            $data[$key]->companyName = $use->companyName;
            $data[$key]->image = $use->image;
        }

        return response()->json([
            'status' => 'success',
            'message' => "",
            'log_url' => env('APP_URL') . 'public/user/',
            'data' => $data
        ], 200);
    }
    public function search_crone()
    {
        $new = Search_data::where('status',0)->first();
        if(isset($new))
        {
                $catname = Cpr_ad_category::find($new->query);
                $cat = $catname->category_name;
                $location = $new->address;
                $res = Http::get('http://profilebabascraper-env.eba-dbyrek3q.ap-south-1.elasticbeanstalk.com/google/search?query='.$cat.'&location='.$location.'&size=2')->collect();
               
               foreach ($res as $key => $value) {
                    
                    $use =  webUser::where('phone',(int)$value['phone'])->first();
                    if(isset($value['category']))
                    {
                        $oldcat = Cpr_ad_category::where('category_name',$value['category'])->first();
                        if(isset($oldcat))
                        {
                            $newc = $oldcat->id;
                        }
                        else
                        {
                            $string = preg_replace('/[^A-Za-z0-9\-]/', ' ', $value['category']);
                            $slug = Str::slug($string, '-');
                            $ct = new Cpr_ad_category();
                            $ct->parent_id = $catname->parent_id;
                            $ct->category_name = $value['category'];
                            $ct->category_slug = $slug;
                            $ct->meta_keywords = $slug;
                            $ct->description = $value['category'];
                            $ct->save();
                            $newc = $ct->id;
                        }
                    }
                    else
                    {
                        $newc = null;
                    }
                    if(!isset($use))
                    {
                        if($catname->parent_id == 0)
                        {
                           $pc = $newc; 
                        }
                        else
                        {
                            $pc = $catname->parent_id; 
                        }
                    
                        
                        $data = new webUser();
                        $data->firstName = $value['name'];
                        $data->phone = (int)$value['phone'];
                        $data->latitude = $value['latitude'];
                        $data->longitude = $value['longitude'];
                        $data->location = $value['address'];
                        $data->email = $value['email'];
                        $data->company_category = $pc;
                        $data->account_type = 'v';
                        $data->source = 'api';
                        $data->plan_date = Carbon::today();
                        $data->password = Hash::make((int)$value['phone']);
                        $data->save();
                        $uid = $data->id;
                    }
                    else
                    {
                        $uid = $use->id;
                    }
                    $ad = new Cpr_Add_post();
                    $ad->user_id = $uid;
                    $ad->title = $value['category'];
                    $ad->location = $value['address'];
                    $ad->plan = 'free';
                    $ad->plan_date = Carbon::now();
                    $ad->ExDate = Carbon::now()->addDays(3);
                    $ad->source = 'api';
                    $ad->save();
                    
                    if($newc != null)
                    {
                        $category = new Cpr_ad_mapped_category();
                        $category->ad_id = $ad->id;
                        $category->category_id = $newc;
                        $category->save();
                    }
                    
                    
                }
            Search_data::whereId($new->id)->update(['status'=>1]);
        }
        
        return response()->json([
            'status' => 'success',
            'message' => "Data Saved Successfully",
            'data' => (object)[]
        ], 200);
    }
    
    public function search_data_new(Request $request)
    {
        // return $request->address;
        $olddata = Search_data::where('query',$request->query_msg)->where('address',$request->address)->first();
        if(!isset($olddata))
        {
        $data = new Search_data();
        $data->query = $request->query_msg;
        $data->address = $request->address;
        $data->save();
        
        }
        return response()->json([
            'status' => 'success',
            'message' => "Data Saved Successfully",
            'data' => (object)[]
        ], 200);
        
    }
    public function subscription_list()
    {
       $datas = Cpr_subscription::where('active_status',1)->orderByDesc('id')->get();

        return response()->json([
            'status'=> 'success',
            'message'=> "",
            'data'=>$datas
        ], 200);
    }
     
    
    
    
    
    
    
    
    
    
    
}
