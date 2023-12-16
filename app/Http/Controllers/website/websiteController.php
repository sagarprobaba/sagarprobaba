<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Mail\UserNotification;
use App\Models\Cpr_ad_category;
use App\Models\Cpr_ad_category_mapped_filter;
use App\Models\Cpr_ad_chat;
use App\Models\Cpr_ad_chat_file;
use App\Models\Cpr_ad_enquiry;
use App\Models\cpr_ad_filter_values;
use App\Models\Cpr_ad_mapped_category;
use App\Models\Cpr_ad_review;
use App\Models\Cpr_follow;
use App\Models\Api_cat;

use App\Models\Cpr_Add_filter_value;
use App\Models\Cpr_Add_images;
use App\Models\Cpr_Add_post;
use App\Models\Cpr_page;
use App\Models\Cpr_user_notification;
use App\Models\Cpr_subscription;
use App\Models\Cpr_wishlist;
use App\Models\webUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Stevebauman\Location\Facades\Location;

class websiteController extends Controller
{
    //
    public function pages($slug)
    {
        $data = Cpr_page::where('slug', $slug)->first();
        return view('web.cms', compact('data'));
    }

    public function termsconditions()
    {
        $data = Cpr_page::where('slug', 'terms-of-use')->first();
        return view('web.cms', compact('data'));
    }
    public function faq()
    {
        $data = Cpr_page::where('slug','top-faq')->first();
        return view('web.cms', compact('data'));
    }
    public function privacypolicy()
    {
        $data = Cpr_page::where('slug', 'privacy-policy')->first();
        return view('web.cms', compact('data'));
    }
    public function about()
    {
        $data = Cpr_page::where('slug','about-profile-baba')->first();
        return view('web.cms', compact('data'));
    }
    public function contact()
    {
        $data = Cpr_page::where('slug','contact-us')->first();
        return view('web.cms', compact('data'));
    }
    




    public function getSub(Request $request)
    {
        return response()->json([
            'data' => Cpr_ad_category::where('parent_id', $request->id)->OrderByDesc('id')->get()
        ]);
    }
    public function getFilter(Request $request)
    {
        $data = Cpr_ad_category_mapped_filter::join('cpr_ad_filters', 'cpr_ad_filters.id', 'cpr_ad_category_mapped_filters.filter_id')->where('cpr_ad_category_mapped_filters.category_id', $request->id)->get();
        foreach ($data as $key => $value) {
            $fil = cpr_ad_filter_values::where('filter_id', $value->filter_id)->get();
            $data[$key]->filter_value = $fil;
        }
        return response()->json($data);
    }
    public function userdashboard()
    {
        $id = Auth::guard('webUser')->user()->id;
        $user =  webUser::find($id);
        $review = Cpr_ad_review::where('user_id',$id)->orderByDesc('id')->get();
        $noti = Cpr_user_notification::where('user_id', $id)->orderByDesc('id')->limit(10)->get();
        $notiCount = Cpr_user_notification::where('user_id',$id)->whereDate('created_at',Carbon::today())->count('id');
        $ad = Cpr_Add_post::where('user_id', $id)->orderByDesc('id')->limit(10)->get();
        $ads = Cpr_Add_post::where('user_id', $id)->orderByDesc('id')->get();
        $myResponce = Cpr_Add_post::join('cpr_ad_enquiries', 'cpr_ad_enquiries.ad_id', 'cpr__add_posts.id')->where('cpr__add_posts.user_id',$id)->orderByDesc('cpr__add_posts.id')->get();

        $ads1 = Cpr_Add_post::where('user_id', $id)->orderByDesc('id')->get();
        $ads2 = Cpr_Add_post::where('user_id', $id)->orderByDesc('id')->get();
        // $myResponce = Cpr_ad_enquiry::where('email',$user->email)->orderByDesc('id')->get();
        $enquiries = Cpr_ad_enquiry::join('cpr__add_posts','cpr__add_posts.id','cpr_ad_enquiries.ad_id')->where('cpr_ad_enquiries.user_id', $id)->orderByDesc('cpr_ad_enquiries.id')->get();
        $rscnt = $myResponce->count();
        $adcnt = $ads->count();
        $wishlist = Cpr_wishlist::join('cpr__add_posts', 'cpr__add_posts.id', 'cpr_wishlists.ad_id')->where('cpr_wishlists.user_id', $id)->select('cpr__add_posts.*', 'cpr_wishlists.*', 'cpr_wishlists.id as wishId')->get();
        if (!empty($wishlist)) {
            foreach ($wishlist as $key => $val) {
                $pics = Cpr_Add_images::where('ad_id', $val->ad_id)->orderBy('image_order','ASC')->first();
                $wishlist[$key]->image = $pics->image;
            }
        }
        $ip = request()->ip();
        // 45.124.146.33
        $currentUserInfo = Location::get($ip);

        // return $wishlist;
        $cat = Cpr_ad_category::where('parent_id', 0)->where('status',1)->orderByDesc('id')->get();
        $subcat = Cpr_ad_category::where('parent_id', Auth::guard('webUser')->user()->company_category)->where('status',1)->orderByDesc('id')->get();
        $city = DB::table('cities')->where('country_id', 101)->orderBy('name', 'ASC')->get();
        $state = DB::table('states')->where('country_id', 101)->orderBy('name', 'ASC')->get();
        $subscriptions = Cpr_subscription::where('active_status',1)->orderByDesc('id')->get();
        return view('web.myAccount', compact('user','subcat', 'ad', 'ads', 'rscnt', 'adcnt', 'wishlist', 'currentUserInfo', 'cat', 'city', 'state', 'ads1', 'noti','review','ads2','enquiries','notiCount','subscriptions'));
    }
    public function adlist($slug)
    {

        $cat = Cpr_ad_category::where('category_slug', $slug)->first();
        $f1 = $cat->id;
        $filter1 = Cpr_ad_category_mapped_filter::join('cpr_ad_filters', 'cpr_ad_filters.id', 'cpr_ad_category_mapped_filters.filter_id')->where('category_id', $f1)->get();
        foreach ($filter1 as $key => $value) {
            $fil = cpr_ad_filter_values::where('filter_id', $value->filter_id)->get();
            $filter1[$key]->filter_value = $fil;
        }

        //   return $filter1;
        
        $apicat = Api_cat::where('map_cat_id',$cat->id)->pluck('api_cat')->toArray();
        
        $apiads = Cpr_Add_post::whereIn('api_cat',$apicat)->pluck('id')->toArray();
        
        $webads = Cpr_ad_mapped_category::where('category_id',$cat->id)->pluck('ad_id')->toArray();
        
        $allad = array_merge($apiads,$webads);
        
        $data  = Cpr_Add_post::whereIn('id',array_unique($allad))->where('status',1)->get();
                
        
        // $data = Cpr_ad_mapped_category::join('cpr__add_posts', 'cpr__add_posts.id', 'cpr_ad_mapped_categories.ad_id')->where('cpr_ad_mapped_categories.category_id', $cat->id)->where('cpr__add_posts.status', 1)->orderByDesc('cpr__add_posts.id')->get();
        
        // $data = Cpr_ad_mapped_category::join('cpr__add_posts', 'cpr__add_posts.id', 'cpr_ad_mapped_categories.ad_id')->where('cpr_ad_mapped_categories.category_id', $cat->id)->where('cpr__add_posts.status', 1)->whereDate('ExDate', '>=', Carbon::today())->orderByDesc('cpr__add_posts.id')->get();
      
        foreach ($data as $key => $value) {
            $pic = Cpr_Add_images::where('ad_id',$value->id)->orderBy('image_order','ASC')->first();
            $data[$key]->adimage = $pic?->image;
            $use = webUser::find($value->user_id);
            $data[$key]->companyLogo = $use->companyLogo;
            $data[$key]->image = $use->image;
            $data[$key]->companyName = $use->companyName;
            $data[$key]->firstName = $use->firstName;
            $data[$key]->lastName = $use->lastName;
            $data[$key]->phone = $use->phone;
        }
        // return $data;
        $cnt = $data->count();
        $maxAmt = $data->max('price');
        $catlist = Cpr_ad_category::where('parent_id', $cat->id)->where('status',1)->orderByDesc('id')->get();

        return view('web.adlist', compact('cat', 'data', 'cnt', 'filter1', 'maxAmt'));
    }

    public function addfilter(Request $request)
    {
        if (isset($request->ids)) {
            $filt = Cpr_Add_filter_value::whereIn('filter_value_id', explode(',', $request->ids))->where('cat_id', $request->catid)->select('ad_id')->groupBy('ad_id')->get();
            $ids = array();
            foreach ($filt as $key => $value) {

                array_push($ids, $value->ad_id);
            }

            $data = Cpr_ad_mapped_category::join('cpr__add_posts', 'cpr__add_posts.id', 'cpr_ad_mapped_categories.ad_id')->where('cpr_ad_mapped_categories.category_id', $request->catid)->where('cpr__add_posts.status', 1)->whereBetween('cpr__add_posts.price', [$request->min, $request->max])->whereIn('cpr__add_posts.id', $ids)->orderByDesc('cpr__add_posts.id')->get();
        } else {
            $data = Cpr_ad_mapped_category::join('cpr__add_posts', 'cpr__add_posts.id', 'cpr_ad_mapped_categories.ad_id')->where('cpr_ad_mapped_categories.category_id', $request->catid)->whereBetween('cpr__add_posts.price', [$request->min, $request->max])->where('cpr__add_posts.status', 1)->orderByDesc('cpr__add_posts.id')->get();
        }
        $cnt = $data->count();
        foreach ($data as $key => $value) {
            $pic = Cpr_Add_images::where('ad_id', $value->id)->orderBy('image_order','ASC')->first();
            $data[$key]->adimage = $pic->image;
            $use = webUser::find($value->user_id);
            $data[$key]->companyLogo = $use->companyLogo;
            $data[$key]->image = $use->image;
            $data[$key]->companyName = $use->companyName;
            $data[$key]->firstName = $use->firstName;
            $data[$key]->lastName = $use->lastName;
        }
        $html = '';

        foreach ($data as $data) {
            $url = url('product_detail/' . $data->id);
            $image = asset('public/ad/' . $data->adimage);
            $mer = url('merchant-profile/' . $data->user_id);
            if (isset($data->companyLogo)) {
                $logo = asset('public/user/' . $data->companyLogo);
            } elseif (isset($data->image)) {
                $logo = asset('public/user/' . $data->image);
            } else {
                $logo = asset('assets/images/users/avatar-3.jpg');
            }
            if ($data->companyName) {
                $name = $data->companyName;
            } else {
                $name = $data->firstName . '' . $data->lastName;
            }


            $html .= '                       
        <div class="col-6 col-sm-6 col-md-3 col-lg-3 item">
            <!--Start Product Image-->
            <div class="product-image">
                <!--Start Product Image-->
                <a href="' . $url . '" class="product-img">
                    <!-- image -->

                    <img class="primary blur-up lazyload" data-src="' . $image . '" src="' . $image . '" alt="image" title="" style="max-width: 210px;max-height: 130px;width:auto">
                    <!-- End image -->
                    <!-- Hover image -->
                    <img class="hover blur-up lazyload" data-src="' . $image . '" src="' . $image . '" alt="image" title="" style=" max-width: 210px;max-height: 130px;width:auto">
                    <!-- End hover image -->
                   
                </a>
                <!--End Product Image-->
                <!--<div class="product-labels"><span class="lbl on-sale">Sponsored</span></div>-->
            </div>
            <!--End Product Image-->
            <!--Start Product Details-->
            <div class="product-details text-left">
                <!--Product Name-->
                <div class="product-name ">
                    <a href="javascript:void(0)">' . $data->title . '</a>
                </div>
                <!--End Product Name-->
                <!--Product Price-->
                <div class="product-price">
                    <span class="price">N' . $data->price . '</span>
                </div>
                <!--End Product Price-->
                
                <div class="mrchant_wrap">
                    <a href="' . $mer . '">
                       
                        <img src="' . $logo . '">
                    
                        
                       
                    <div class="mrchant_info"><h5>
                            ' . $name . '
                        </h5></div></a>
                </div>

            </div>
            <!--End Product Details-->
        </div>
       ';
        }


        return response()->json(['data' => $html, 'cnt' => $cnt]);
    }
    public function merchantProfile($id)
    {
        $user = webUser::find($id);
        $data = Cpr_Add_post::where('user_id', $id)->orderByDesc('id')->get();
        $cnt = $data->count();
        $follower = Cpr_follow::where('author_id',$id)->count();
        return view('web.merchant', compact('data', 'user', 'cnt','follower'));
    }

    function deleteNoti($id)
    {
        Cpr_user_notification::whereId($id)->delete();
        return redirect()->back()->with('success', 'Notification Deleted successfully!');
    }
    public function getRes(Request $request)
    {
        $data = Cpr_ad_enquiry::where('ad_id',$request->id)->orderByDesc('id')->get();
        return response()->json(['data' => $data]);
    }
    public function chating(Request $request)
    {
        $data = new Cpr_ad_chat();
        $data->sender_id = $request->sender_id;
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
                $file = $img;
                $fileName = uniqid() . '_' . trim($file->getClientOriginalName());
                $file->move($path, $fileName);
                $image = new Cpr_ad_chat_file();
                $image->chat_id = $data->id;
                $image->chatfile = $fileName;
                $image->save();
            }
        }
                
                $msg = "You have received A message from ".Auth::guard('webUser')->user()->firstName."".Auth::guard('webUser')->user()->lastName." ";
                Cpr_user_notification::insert(['user_id'=> $request->sender_id,'ad_id'=>$data->ad_id,'title'=>'Ad Chat','notification'=>$msg]);
                Mail::to(Auth::guard('webUser')->user()->email)->send(new UserNotification($msg));

        return redirect()->back()->with('conver','message send successfully!');
    }
    public function startChat($id)
    {
        session()->put('ad_id',$id);
        return redirect()->back();
    }
    public function follow($id)
    {
        Cpr_follow::insert(['follower_id'=>Auth::guard('webUser')->user()->id,'author_id'=>$id]);
        return redirect()->back()->with('success','You follow this User Successfully!');
    }
    public function unfollow($id)
    {
        Cpr_follow::where(['follower_id'=>Auth::guard('webUser')->user()->id,'author_id'=>$id])->delete();
        return redirect()->back()->with('error','You unfollow this User Successfully!');
    }
}
