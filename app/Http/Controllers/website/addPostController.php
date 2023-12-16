<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Mail\AdApprove;
use App\Mail\UserNotification;
use App\Models\Cpr_ad_category;
use App\Models\Cpr_ad_category_mapped_filter;
use App\Models\Cpr_ad_chat;
use App\Models\Cpr_ad_chat_file;
use App\Models\Cpr_ad_enquiry;
use App\Models\Cpr_ad_event;
use App\Models\Cpr_ad_mapped_category;
use App\Models\Cpr_ad_review;
use App\Models\Cpr_Add_filter_value;
use App\Models\Cpr_Add_images;
use App\Models\Cpr_Add_post;
use App\Models\Cpr_user_notification;
use App\Models\Cpr_wishlist;
use App\Models\webUser;
use App\Models\Cpr_subscription;
use App\Models\Seller_review;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class addPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $subcat = Cpr_ad_category::where('parent_id', Auth::guard('webUser')->user()->company_category)->where('status',1)->orderByDesc('id')->get();
        $cat = Cpr_ad_category::where('parent_id',0)->orderByDesc('id')->where('status',1)->get();
        $city = DB::table('cities')->where('country_id',101)->orderBy('name','ASC')->get();
        $state = DB::table('states')->where('country_id',101)->orderBy('name','ASC')->get();
        
        return view('web.addPost',compact('cat','state','city','subcat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $currentDateTime = Carbon::now();

    //   return $request->category;
        if (isset(Auth::guard('webUser')->user()->id)) {
            $userId = Auth::guard('webUser')->user()->id;
            $plan_date = Auth::guard('webUser')->user()->plan_date;
            $exdate = Carbon::now()->addDays(3);


            if ($request->plan == 'free') {
                $plan_date = Auth::guard('webUser')->user()->plan_date;
                $exdate = Carbon::now()->addDays(3);
                $addcount = Cpr_Add_post::where('user_id', $userId)->where('plan', 'free')->count('id');
                
                if ($addcount == 5) {
                    $msg = "warning ! Your Free plan Capacity is Over!";
                    Cpr_user_notification::insert(['user_id' => $userId, 'title' => 'Plan Upgrade', 'notification' => 'warning ! Your Free plan Capacity is Over!']);
                    Mail::to(Auth::guard('webUser')->user()->email)->send(new UserNotification($msg));
                    return redirect()->back()->with('error', 'warning ! Your Free plan Capacity is Over!');
                }
            }
            if ($request->plan == 'Boost') {
                $plan_date = Auth::guard('webUser')->user()->boost_plan_date;
                $exdate = Carbon::now()->addDays(15);

                $addcount = Cpr_Add_post::where('user_id', $userId)->where('plan', 'Boost')->count('id');
                
                if ($addcount == 10) {
                    $msg = "warning ! Your Boost plan Capacity is Over!";
                    Cpr_user_notification::insert(['user_id' => $userId, 'title' => 'Plan Upgrade', 'notification' => 'warning ! Your Boost plan Capacity is Over!']);
                    Mail::to(Auth::guard('webUser')->user()->email)->send(new UserNotification($msg));
                    return redirect()->back()->with('error', 'warning ! Your Boost plan Capacity is Over!');
                }
            }
            if ($request->plan == 'Premium') {
                $plan_date = Auth::guard('webUser')->user()->premium_plan_date;
                $exdate = Carbon::now()->addDays(30);
                $addcount = Cpr_Add_post::where('user_id', $userId)->where('plan', 'Premium')->count('id');
                
                if ($addcount == 20) {
                    $msg = "warning ! Your Premium plan Capacity is Over!";
                    Cpr_user_notification::insert(['user_id' => $userId, 'title' => 'Plan Upgrade', 'notification' => 'warning ! Your Premium plan Capacity is Over!']);
                    Mail::to(Auth::guard('webUser')->user()->email)->send(new UserNotification($msg));
                    return redirect()->back()->with('error', 'warning ! Your Premium plan Capacity is Over!');
                }
            }
        } else {
            $request->validate([
                'firstName' => 'required',
                'lastName' => 'required',
                'email' => 'required|email|unique:web_users',
                'password' => 'required|confirmed',
            ]);
            $data = new webUser();
            $data->firstName = $request->firstName;
            $data->lastName = $request->lastName;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->plan_date = Carbon::today();
            $data->password = Hash::make($request->password);

            $data->save();
            $userId = $data->id;
            Auth::guard('webUser')->attempt(['email' => $request->email, 'password' => $request->password]);
            $plan_date = $data->plan_date;
        }

        if (isset($request->adId)) {
            // Cpr_ad_mapped_category::where('ad_id', $request->adId)->delete();
            Cpr_Add_filter_value::where('ad_id', $request->adId)->delete();
            $ad = Cpr_Add_post::find($request->adId);
            $ad->user_id = $userId;
            $ad->title = $request->title;
            $ad->country = $request->country;
            $ad->state = $request->state;
            $ad->city = $request->city;
            $ad->location = $request->location;
            $ad->location = $request->location;
            $ad->negotiable = $request->negotiable;
            $ad->description = $request->description;
            $ad->price = $request->price;
            $ad->plan = $request->plan;
            $ad->plan_date = $plan_date;
            $ad->video_url = $request->video_url;

            $ad->ExDate = $exdate;

            $ad->save();
            $msg = "Post Updated Successfully!";
        } else {
            $ad = new Cpr_Add_post();
            $ad->user_id = $userId;
            $ad->title = $request->title;
            $ad->country = $request->country;
            $ad->state = $request->state;
            $ad->city = $request->city;
            $ad->location = $request->location;
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
            foreach ($request->category as $catg) {
            if (isset($catg)) {
                $category = new Cpr_ad_mapped_category();
                $category->ad_id = $ad->id;
                $category->category_id = $catg;
                $category->save();
            }
        }
        }
        if (isset($request->filter)) {
            // return "hello";
            foreach ($request->filter as $filt) {
                if (isset($filt)) {
                    $filter = new Cpr_Add_filter_value();
                    $filter->ad_id = $ad->id;
                    $filter->cat_id = $request->upper_cat_id;
                    $filter->filter_value_id = $filt;
                    $filter->save();
                }
            }
        }
        Cpr_Add_images::where('ad_id',session()->get('tempId'))->update(['ad_id'=>$ad->id]);

        session()->forget('tempId');

        return redirect()->back()->with('success', $msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function ajaxcity(Request $request)
    {
        return response()->json([
            'cities' => DB::table('cities')->where('state_id',$request->state)->get()         
        ]);
    }
    public function product_detail($id)
    {
        $data = Cpr_Add_post::find($id);
        Cpr_Add_post::whereId($id)->update(['view'=>$data->view + 1]);
        $cat = Cpr_ad_mapped_category::where('ad_id',$data->id)->first();
        
        $pics = Cpr_Add_images::where('ad_id',$id)->orderByDesc('id')->get();
        $thumb = Cpr_Add_images::where('ad_id',$id)->orderBy('image_order','ASC')->first();
        $city = DB::table('cities')->whereId($data->city)->first();
        $state = DB::table('states')->whereId($data->state)->first();
        $user = webUser::find($data->user_id);
        $fill = Cpr_Add_filter_value::join('cpr_ad_filter_values','cpr_ad_filter_values.id','cpr__add_filter_values.filter_value_id')->where('ad_id',$data->id)->get();
        $also = Cpr_ad_mapped_category::join('cpr__add_posts','cpr__add_posts.id','cpr_ad_mapped_categories.ad_id')->where('cpr_ad_mapped_categories.category_id',$cat?->category_id)->where('cpr__add_posts.status',1)->orderBy('cpr__add_posts.id','Asc')->get();     
        
        $ads = array();
        $ads = session()->get('ads',[]);
        if(!in_array($id,$ads))
        {
            session()->push('ads', $id);
        }
        $rece = Cpr_Add_post::whereIn('id',$ads)->orderByDesc('id')->limit(20)->get(); 
        $review = Cpr_ad_review::where('ad_id',$id)->orderByDesc('id')->get();
        $Av = Cpr_ad_review::where('ad_id',$id)->sum('rating');
        $revcnt = $review->count();
        $revcnt==0?$revAve=0:$revAve=$Av/$revcnt;
        
        //seller review
        $reviewSeller = Seller_review::where('seller_id',$data->user_id)->orderByDesc('id')->get();
        $AvSeller = Seller_review::where('seller_id',$data->user_id)->sum('rating');
        $revcntSeller = $reviewSeller->count();
        $revcntSeller == 0 ? $revAveSeller = 0 : $revAveSeller = $AvSeller / $revcntSeller;
        return view('web.adDetail', compact('data', 'pics', 'thumb', 'city', 'state', 'user', 'fill', 'also', 'rece', 'review', 'revcnt', 'revAve','reviewSeller','revcntSeller','revAveSeller'));

    }
    public function getUserData(Request $request)
    {
        if(isset(Auth::guard('webUser')->user()->id))
        {
            $data = webUser::find(Auth::guard('webUser')->user()->id);            
            return response()->json($data);
        }
        
    }
    public function add_enquiry(Request $request)
    {
        // dd($request->all());
        $data = new Cpr_ad_enquiry();
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->subject = $request->subject;
        $data->message = $request->message;
        $data->ad_id = $request->ad_id;
        if(isset(Auth::guard('webUser')->user()->id))
        {
            $data->user_id = Auth::guard('webUser')->user()->id;
        }
        $data->save();
        $own = Cpr_Add_post::find($request->ad_id);
        $msg = "One Buyer name: ".$request->name." interested in Your Ad!";
        $user = webUser::find($own->user_id);
        Cpr_user_notification::insert(['user_id'=>$own->user_id,'sender_id'=>$data->user_id,'ad_id'=>$data->ad_id,'title'=>'Buyer Contacted','notification'=>'One Buyer name: '.$request->name.' interested in Your Ad!!']);

        Mail::to($user->email)->send(new UserNotification($msg));
        return redirect()->back()->with('success','Seller will contact you soon. Please check in your account under resposes.');
        
    }
    public function addwishList($id,$adId)
    {
        $ex = Cpr_wishlist::where('ad_id',$adId)->where('user_id',$id)->first();
        if(isset($ex))
        {
            return redirect()->back()->with('error','Already Exist In Your WishList!!');
        }
        else
        {
            $data = new Cpr_wishlist();
            $data->ad_id = $adId;
            $data->user_id = $id;
            $data->save();
            return redirect()->back()->with('success','Ad Successfully Added To Your WishList!!');
        }
        
    }
    public function removeWish(Request $request)
    {
        Cpr_wishlist::whereId($request->id)->delete();
        return response(true);
    }
    public function updateProfile(Request $request,$id)
    {
        $data = webUser::find($id);
        $image =$data->image;
        $logo =$data->companyLogo;
        $cac_certificate =$data->cac_certificate;
        $path = public_path('user');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
        if ($request->hasFile('image')) {
            $rand_val = date('YMDHIS') . rand(11111, 99999);
            $image_file_name = md5($rand_val);
            $file = $request->file('image');
            $fileName =$image_file_name . '.' . $file->getClientOriginalExtension();
            $file->move($path, $fileName);
            $image =$fileName;
        }
        if ($request->hasFile('companyLogo')){

            $file = $request->file('companyLogo');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $fileName);
            $logo =$fileName;
        }  
        if ($request->hasFile('cac_certificate')){

            $file = $request->file('cac_certificate');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $fileName);
            $cac_certificate =$fileName;
        } 

        webUser::whereId($id)->update($request->except('_token','image','companyLogo','location','cac_certificate')+['image'=>$image]+['companyLogo'=>$logo]+['cac_certificate'=>$cac_certificate]);
        return redirect()->back()->with('success','Profile Updated SuccessFully!');
    }
    public function updateProfilepassword(Request $request,$id)
    {
        if(isset($request->password))
        {
            $request->validate([
                'password' => 'required|confirmed',
            ]);
            $data = webUser::find($id);
            $data->password = Hash::make($request->password);
            $data->save();
            return redirect()->back()->with('success','Password Changed SuccessFully!');
        }
        
    }
    public function deleteAdd($id)
    {
        Cpr_Add_filter_value::where('ad_id',$id)->delete();
        Cpr_Add_images::where('ad_id',$id)->delete();
        Cpr_ad_enquiry::where('ad_id',$id)->delete();
        Cpr_ad_event::where('ad_id',$id)->delete();
        Cpr_wishlist::where('ad_id',$id)->delete();
        Cpr_ad_mapped_category::where('ad_id',$id)->delete();
        Cpr_ad_chat::where('ad_id',$id)->delete();
       
        Cpr_Add_post::whereId($id)->delete();
       return redirect()->back()->with('success','Ad Deleted Successfully!');
    }
    public function editAd(Request $request)
    {
        $data = Cpr_Add_post::find($request->id);
        $adimage = Cpr_Add_images::where('ad_id',$request->id)->get();
        $adMapCat =  Cpr_ad_mapped_category::where('ad_id',$request->id)->get();
        $adMapFilter =  Cpr_Add_filter_value::where('ad_id',$request->id)->get();
        return response()->json(['data'=>$data,'adimage'=>$adimage,'adMapCat'=>$adMapCat,'adMapFilter'=>$adMapFilter]);
    }

    public function addreview(Request $request)
    {
        // dd($request->all());

       $data = new Cpr_ad_review();
       $data->ad_id = $request->ad_id;
       $data->user_id = $request->User_id;
       $data->ad_User_id = $request->ad_User_id;
       $data->name = $request->name;
       $data->email = $request->email;
       $data->rating = $request->rating;
       $data->review_title = $request->review;
       $data->review = $request->message;
       $data->save();
       return redirect()->back()->with('review','Review Added Successfully!');
    }
    public function sellerreview(Request $request)
    {       
        Seller_review::create($request->except("_token"));
        
        return redirect()->back()->with('review', 'Review Added Successfully!');
    }
    public function uploadImages(Request $request)
    {
        if ($request->hasFile('files')) {

            $path = public_path('/ad');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            if (session()->has('tempId')) {
                $tempId = session()->get('tempId');
            } else {
                $tempId = "Temp".rand(111111, 999999);
                session()->put('tempId', $tempId);
            }


            foreach ($request->file('files') as $img) {
                $file = $img;
                $fileName = uniqid() . '_' . trim($file->getClientOriginalName());
                $file->move($path, $fileName);
                $image = new Cpr_Add_images();
                $image->ad_id = $tempId;
                $image->image = $fileName;
                $image->save();
            }
            $adimage = Cpr_Add_images::where('ad_id', session()->get('tempId'))->latest('id')->limit(sizeof($request->file('files')))->get();
            return response()->json($adimage);
        }
        
        
    }
    public function setImageOrder(Request $request)
    {
        Cpr_Add_images::whereId($request->id)->update(['image_order'=>$request->val]);
        return true;
    }
    public function deleteTempImages()
    {
        if (session()->has('tempId')) {
            Cpr_Add_images::where('ad_id',session()->get('tempId'))->delete();
        }
        return true;
    }
    public function loadimage()
    {
        $adimage = Cpr_Add_images::where('ad_id', session()->get('tempId'))->latest('id')->first();
        return response()->json($adimage);
    }
    public function removeImage(Request $request)
    {
        Cpr_Add_images::whereId($request->id)->delete();
        return true;
    }
}
