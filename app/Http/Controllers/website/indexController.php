<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Cpr_ad_category;
use App\Models\Cpr_ad_category_mapped_filter;
use App\Models\Cpr_ad_event;
use App\Models\cpr_ad_filter_values;
use App\Models\Cpr_ad_mapped_category;
use App\Models\Cpr_Add_images;
use App\Models\Cpr_Add_post;
use App\Models\Payment;
use App\Models\Cpr_contact_msg;
use App\Models\Cpr_subscription;
use App\Models\webUser;
use App\Models\Api_cat;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class indexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $deal = Cpr_Add_post::orderByDesc('id')->limit(10)->get();
        $feature = Cpr_ad_event::join('cpr__add_posts', 'cpr_ad_events.ad_id', 'cpr__add_posts.id')->where('cpr_ad_events.event', 'f')->orderByDesc('cpr__add_posts.id')->limit(9)->get();
        $collection = Cpr_ad_event::join('cpr__add_posts', 'cpr_ad_events.ad_id', 'cpr__add_posts.id')->where('cpr_ad_events.event', 'c')->orderByDesc('cpr__add_posts.id')->limit(6)->get();
        $Electric = Cpr_ad_event::join('cpr__add_posts', 'cpr_ad_events.ad_id', 'cpr__add_posts.id')->where('cpr_ad_events.event', 'e')->orderByDesc('cpr__add_posts.id')->limit(6)->get();
        return view('web.index', compact('deal', 'feature', 'collection', 'Electric'));
    }
    public function allcat()
    {
        //
        
        $cats = Cpr_ad_category::where('parent_id', 0)->orderByDesc('id')->get();
        return view('web.allcat', compact('cats'));
    }
    public function subcat($slug)
    {
        //
        $data = Cpr_ad_category::where('category_slug',$slug)->first();
        $cats = Cpr_ad_category::where('parent_id',$data->id)->orderByDesc('id')->get();
        return view('web.allcat', compact('cats'));
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
    public function search(Request $request)
    {
        // $request->dd();
        //         "category" => "equipment-tools"
        //   "char" => "abbcd"
        $filter1 = [];
        $cat = '';
        if (isset($request->category)) {
            $cat = Cpr_ad_category::where('category_slug', $request->category)->first();
            $f1 = $cat->id;
            $filter1 = Cpr_ad_category_mapped_filter::join('cpr_ad_filters', 'cpr_ad_filters.id', 'cpr_ad_category_mapped_filters.filter_id')->where('category_id', $f1)->get();
            foreach ($filter1 as $key => $value) {
                $fil = cpr_ad_filter_values::where('filter_id', $value->filter_id)->get();
                $filter1[$key]->filter_value = $fil;
            }
            
            $apicat = Api_cat::where('map_cat_id',$cat->id)->pluck('api_cat')->toArray();
        
            $apiads = Cpr_Add_post::whereIn('api_cat',$apicat)->pluck('id')->toArray();
        
            $webads = Cpr_ad_mapped_category::where('category_id',$cat->id)->pluck('ad_id')->toArray();
        
            $allad = array_merge($apiads,$webads);
        
            $data  = Cpr_Add_post::whereIn('id',array_unique($allad))->where('title','like',"%{$request->char}%")->where('status',1)->get();
            
            // $data = Cpr_ad_mapped_category::join('cpr__add_posts', 'cpr__add_posts.id', 'cpr_ad_mapped_categories.ad_id')
            //     ->where('cpr_ad_mapped_categories.category_id', $cat->id)
            //     ->Where('cpr__add_posts.title', 'like', "%{$request->char}%")
            //     ->where('cpr__add_posts.status', 1)
            //     ->orderByDesc('cpr__add_posts.id')
            //     ->get();
            $catlist = Cpr_ad_category::where('parent_id', $cat->id)->orderByDesc('id')->get();
            $cnt = $data->count();
        } else {
            $data = Cpr_Add_post::Where('title', 'like', "%{$request->char}%")
                ->orderByDesc('id')
                ->get();

            $cnt = $data->count();

            $catlist = Cpr_ad_category::orderByDesc('id')->get();
        }

        foreach ($data as $key => $value) {
            $pic = Cpr_Add_images::where('ad_id', $value->id)->orderBy('image_order','ASC')->first();
            $data[$key]->adimage = $pic?->image;
            $use = webUser::find($value->user_id);
            $data[$key]->companyLogo = $use->companyLogo;
            $data[$key]->image = $use->image;
            $data[$key]->companyName = $use->companyName;
            $data[$key]->firstName = $use->firstName;
            $data[$key]->lastName = $use->lastName;
            $data[$key]->phone = $use->phone;
        }

        return view('web.adlist', compact('cat', 'data', 'cnt', 'filter1', 'catlist'));
    }
    public function autocompleteSearch(Request $request)
    {
        //   $query = $request->get('query');
        if (isset($request->val)) {
            $filterResult = Cpr_Add_post::where('title', 'LIKE', "%{$request->val}%")->select("title", "id")->limit(30)->orderBy('title', 'Asc')->get();
            return response()->json(['data' => $filterResult]);
        }
    }
    public function payment(Request $request)
    {
        $cbs = Cpr_subscription::find($request->plan);
        
        
        $plan_date = Carbon::now();
        $plan_exp_date = Carbon::now()->addDays($cbs->validity_days);
        webUser::whereId(Auth::guard('webUser')->user()->id)->update(['plan' => $cbs->id, 'plan_date' => $plan_date, 'plan_exp_date' => $plan_exp_date]);
        $amount = $cbs->price;
        if($amount == 0)
        {
            return redirect()->back()->with('success','Plan Updated Successfully!');
        }
        $paln = $cbs->name;
        
        $user =  webUser::find(Auth::guard('webUser')->user()->id);
        return view('web.payment',compact('plan','amount','user'));
    }
    public function paymentVerify(Request $request)
    {
        
        $curl = curl_init();

        $secKey = "sk_test_52a91e74aeb51dd19b60b6042b669e828f2d5784";

        curl_setopt_array($curl, array(

            CURLOPT_URL => "https://api.paystack.co/transaction/verify/$request->reference",

            CURLOPT_RETURNTRANSFER => true,

            CURLOPT_ENCODING => "",

            CURLOPT_MAXREDIRS => 10,

            CURLOPT_SSL_VERIFYHOST => 0,

            CURLOPT_SSL_VERIFYPEER => 0,

            CURLOPT_TIMEOUT => 30,

            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

            CURLOPT_CUSTOMREQUEST => "GET",

            CURLOPT_HTTPHEADER => array(

                "Authorization: Bearer $secKey",

                "Cache-Control: no-cache",

            ),

        ));


        $response = curl_exec($curl);
        
        $data = [json_decode($response)];
        
        if($data[0]->status == true)
        {
            Payment::insert(['user_id'=>Auth::guard('webUser')->user()->id,'transaction_id'=>$data[0]->data->id,'amount'=>$data[0]->data->amount/100]);
            $planDate = Carbon::today();
            if($request->plan == 'Boost')
            {
                $exdate = Carbon::now()->addDays(15);
                 webUser::whereId(Auth::guard('webUser')->user()->id)->update(['plan'=>$request->plan,'boost_plan_date'=>$planDate,'plan_exp_date'=>$exdate]);
            }
            else
            {
                $exdate = Carbon::now()->addDays(30);
                webUser::whereId(Auth::guard('webUser')->user()->id)->update(['plan'=>$request->plan,'premium_plan_date'=>$planDate,'plan_exp_date'=>$exdate]);
            }            
            
        }
        $err = curl_error($curl);


        curl_close($curl);

        return [json_decode($response)];
    }
    public function contactMsg(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
        ]);
        Cpr_contact_msg::create($request->except('_token'));
        return redirect()->back()->with('success','Message send successfully!');
    }
}
