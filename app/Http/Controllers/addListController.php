<?php

namespace App\Http\Controllers;

use App\Mail\AdApprove;
use App\Mail\UserNotification;
use App\Models\Cpr_ad_category;
use App\Models\Cpr_ad_chat;
use App\Models\Cpr_ad_chat_file;
use App\Models\Cpr_ad_enquiry;
use App\Models\Cpr_ad_event;
use App\Models\Cpr_ad_mapped_category;
use App\Models\Cpr_Add_filter_value;
use App\Models\Cpr_Add_images;
use App\Models\Cpr_Add_post;
use App\Models\Cpr_user_notification;
use App\Models\Cpr_wishlist;
use App\Models\Cpr_auction_enquiry;
use App\Models\Cpr_auction;
use App\Models\User;
use App\Models\Cpr_contact_msg;
use App\Models\Cpr_enquiry_assign;
use App\Models\Cpr_auction_bid;
use App\Models\webUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class addListController extends Controller
{
    //
    public function index()
    {
       $datas = Cpr_Add_post::orderByDesc('id')->where('source','web')->paginate(100);
       $cat = Cpr_ad_category::where('status',1)->orderBy('category_name','Asc')->get();
       return view('gr.adlist',compact('datas','cat'));
    }
    public function adminApiAddlist()
    {
       $datas = Cpr_Add_post::orderByDesc('id')->where('source','api')->paginate(100);
       $cat = Cpr_ad_category::where('status',1)->orderBy('category_name','Asc')->get();
       return view('gr.adlist',compact('datas','cat'));
    }
    public function viewImages(Request $request)
    {
        $data = Cpr_Add_images::where('ad_id',$request->id)->get();
        return response()->json($data);
    }
    

    public function Add_disable($id)
    {
       Cpr_Add_post::whereId($id)->update(['status'=>0]);
       $data = Cpr_Add_post::find($id);
       $msg = "Your Ad has been Rejected!";
        $user = webUser::find($data->user_id);
        Cpr_user_notification::insert(['user_id'=>$data->user_id,'title'=>'Ad Rejected','notification'=>'Your Ad has been Rejected !']);
        Mail::to($user->email)->send(new UserNotification($msg));
       return redirect()->back()->with('success','Ad Disable Successfully!');
    }

    public function Add_enable($id)
    {
        Cpr_Add_post::whereId($id)->update(['status'=>1]);
        $data = Cpr_Add_post::find($id);
        $msg = "Your Ad has been published Successfully!";
        $user = webUser::find($data->user_id);
        Cpr_user_notification::insert(['user_id'=>$data->user_id,'title'=>'Ad Published','notification'=>'Your Ad has been published Successfully!']);
        Mail::to($user->email)->send(new UserNotification($msg));
       return redirect()->back()->with('success','Ad Enable Successfully!');
    }

    public function Add_delete($id)
    {
       Cpr_Add_filter_value::where('ad_id',$id)->delete();
       Cpr_Add_images::where('ad_id',$id)->delete();
       Cpr_ad_enquiry::where('ad_id',$id)->delete();
       Cpr_ad_event::where('ad_id',$id)->delete();
       Cpr_wishlist::where('ad_id',$id)->delete();
       Cpr_ad_mapped_category::where('ad_id',$id)->delete();
       Cpr_ad_chat::where('ad_id',$id)->delete();
       Cpr_ad_chat_file::where('ad_id',$id)->delete();
       Cpr_Add_post::whereId($id)->delete();

       return redirect()->back()->with('success','Ad Deleted Successfully!');
    }
    public function adenquiry()
    {
    //   return Carbon::now()->toDateTimeString();
    //   Cpr_auction::where('auction_time', '>=', Carbon::now('UTC')->toDateTimeString())
    // ->get();
   
        $cate = Cpr_ad_category::where('parent_id',0)->where('status',1)->orderBy('category_name','Asc')->get(['id','category_name']);
        $data = Cpr_ad_enquiry::orderByDesc('id')->get();
        $ven = webUser::where('status',1)->where('account_type','v')->orderBy('firstName','Asc')->get(['id','firstName','lastName']);
        
        return view('gr.adEnquaries',compact('data','cate','ven'));
    }
    public function filtEnquiry(Request $request)
    {
        
        

        $cate = Cpr_ad_category::where('parent_id',0)->where('status',1)->orderBy('category_name','Asc')->get(['id','category_name']);
        $data = Cpr_ad_enquiry::orderByDesc('id');
        $serchSubcategory = '';
        if(isset($request->subcategory))
        {
            $ads = Cpr_ad_mapped_category::where('category_id',$request->subcategory)->pluck('ad_id')->toArray();
            $serchSubcategory = $request->subcategory;
            $data = $data->whereIn('ad_id',$ads);
        }

        $serchcategory = '';
        if(isset($request->category))
        {
            $adsc = Cpr_ad_mapped_category::where('category_id',$request->category)->pluck('ad_id')->toArray();
            $serchcategory = $request->category;
            $data = $data->whereIn('ad_id',$adsc);
        }
        $data = $data->get();
        $ven = webUser::where('status',1)->where('account_type','v')->orderBy('firstName','Asc')->get(['id','firstName','lastName']);
        $subcatelist = Cpr_ad_category::where('parent_id',$request->category)->where('status',1)->orderBy('category_name','Asc')->get(['id','category_name']);
        return view('gr.adEnquaries',compact('data','cate','ven','serchSubcategory','serchcategory','subcatelist'));
    }
    public function assignvendor(Request $request) 
    {
        // dd($request->enqids);
       
        foreach ($request->vendor as $key => $van) {
            Cpr_enquiry_assign::where('web_user_id',$van)->delete();
                foreach (explode(',',$request->enqids) as $key => $enqid) {
                  $new = new  Cpr_enquiry_assign();
                  $new->web_user_id = $van;
                  $new->cpr_ad_enquiry_id = $enqid;
                  $new->save();
                }
        }
        return redirect()->back()->with('success','Enquiry Assigned Successfully!');

    }
    public function enquiry_disable($id)
    {
       Cpr_ad_enquiry::whereId($id)->update(['status'=>0]);
       return redirect()->back()->with('error','Enquiry Disable Successfully!');
    }

    public function enquiry_enable($id)
    {
        Cpr_ad_enquiry::whereId($id)->update(['status'=>1]);
       return redirect()->back()->with('success','Enquiry Enable Successfully!');
    }

    public function enquiry_delete($id)
    {
        Cpr_ad_enquiry::whereId($id)->delete();
       return redirect()->back()->with('error','Enquiry Deleted Successfully!');
    }
    public function setEvent(Request $request)
    {

        if($request->bool == 'true')
        {
            $data = new Cpr_ad_event();
            $data->ad_id = $request->id;
            $data->event = $request->value;
            $data->save();
        }
        else
        {
            Cpr_ad_event::where('ad_id',$request->id)->where('event',$request->value)->delete();
        }

    }
    public function adfilter(Request $request)
    {
        // return $request->all();
        $data = Cpr_Add_post::query();
        $adcat ="";
        if(isset($request->adcat))
        {
            $adcat =$request->adcat;
            $ad = Cpr_ad_mapped_category::where('category_id',$request->adcat)->get()->toArray();
            $adid = array_column($ad,'ad_id');
            $data = $data->whereIn('id',$adid);
        }
        $adtype ="";

        if(isset($request->adtype))
        {
            $adtype =$request->adtype;

            if($request->adtype == "free")
            {
                $data = $data->where('plan','free');

            }
            else
            {
                $data = $data->where('plan','!=','free');
            }
        }
        $adview ="";

        if(isset($request->adview))
        {
            $adview =$request->adview;

            if($request->adview == "Top")
            {
                $data = $data->orderBy('view','Desc');

            }
            else
            {
                $data = $data->orderBy('view','Asc');
            }
        }
        else
        {
            $data = $data->orderByDesc('id');
        }
        $aduser ="";

        if(isset($request->aduser))
        {
            $aduser =$request->aduser;

            if($request->aduser == "Individual")
            {
                $ad = webUser::where('companyName',null)->get()->toArray();               

            }
            else
            {
                $ad = webUser::where('companyName','!=',null)->get()->toArray();
                
            }
            $adid = array_column($ad,'id');
            $data = $data->whereIn('user_id',$adid);
        }
        $adstatus ="";

        if(isset($request->adstatus))
        {
            $adstatus =$request->adstatus;

            if($request->adstatus == "Open")
            {
                $data = $data->where('adstatus','O');

            }
            else
            {
                $data = $data->where('adstatus','C');
            }
        }
        $datas = $data->paginate(100);
        $tdata = $data->count();
       $cat = Cpr_ad_category::where('status',1)->orderBy('category_name','Asc')->get();
       return view('gr.adReport',compact('datas','cat','adstatus','aduser','adview','adtype','adcat','tdata'));
    }
    public function adCatReport()
    {
        $cat = Cpr_ad_category::where('status',1)->orderBy('category_name','Asc')->get();
        return view('gr.adCatReport',compact('cat'));
    }
    public function adReport()
    {
        $datas = Cpr_Add_post::orderByDesc('id')->paginate(100);
        $tdata = Cpr_Add_post::orderByDesc('id')->count();
        $cat = Cpr_ad_category::where('status',1)->orderBy('category_name','Asc')->get();
        return view('gr.adReport',compact('datas','cat','tdata'));
    }
    public function subReport()
    {
        $datas= webUser::where('status',1)->orderBydesc('id')->paginate(100);
        return view('gr.subscriberReport',compact('datas'));
    }
    public function subFilter(Request $request)
    {
        $data = webUser::query();

        $subType = $request->subType;        
        $todate = $request->todate;
        $fromdate = $request->fromdate;
        $subExpire = $request->subExpire;

        if(isset($request->subType))
        {           
            $data = $data->where('plan',$request->subType);
        }
        if(isset($request->todate) && !isset($request->fromdate))
        {
            $data = $data->whereDate('plan_date',$request->todate);
        }
        if(!isset($request->todate) && isset($request->fromdate))
        {
            $data = $data->whereDate('plan_exp_date',$request->fromdate);
        }
        if(isset($request->todate) && isset($request->fromdate))
        {
            $data = $data->whereDate('plan_exp_date',$request->fromdate)->whereDate('plan_date',$request->todate);
        }
        if(isset($request->subExpire))
        {
           $dat =  Carbon::now()->addDays($request->subExpire);
           $data = $data->whereDate('plan_exp_date',$dat);
        }
        $data = $data->orderByDesc('id')->get();
        return view('gr.subscriberReport',compact('data','subType','todate','fromdate','subExpire'));

    }
    public function userReport()
    {
        $data = User::where('type','s')->orderby('id','desc')->get();
        return view('gr.userReport',compact('data'));
    }
    public function SubscriberRep($id)
    {
        $data = webUser::where('plan',$id)->orderby('id','desc')->get();
        return view('gr.subscriberReport',compact('data'));
    }
    public function contactReport()
    {
        $con = Cpr_contact_msg::orderby('id','desc')->get();
        return view('gr.contactReport',compact('con'));
    }
    public function create_auction(Request $request)
    {
        $auc = new Cpr_auction();
        $auc->cpr_ad_category_id = $request->cat;
        $auc->auction_name =  $request->auction_name;
        $auc->Minimum_bid =  $request->Minimum_bid;
        $auc->auction_time =  $request->auction_time;
        $auc->enquiry_count =  $request->enquiry_count;
        $auc->auction_start_time =  $request->auction_start_time;
        $auc->Min_increment_amt =  $request->Min_increment_amt;
        $auc->save();

       $ids = explode(',',$request->enqids);
       foreach ($ids as $key => $value) {
        Cpr_ad_enquiry::where('id',$value)->update(['in_auction' => 1]);   
        $enq = new Cpr_auction_enquiry();
        $enq->cpr_ad_enquiry_id =  $value;
        $enq->cpr_auction_id =  $auc->id;
        $enq->save();
       }
       return redirect()->back()->with('success','Auction Created Successfully!');
    }
    
    public function auctionlist()
    {
        $cate = Cpr_ad_category::where('parent_id',0)->where('status',1)->orderBy('category_name','Asc')->get(['id','category_name']);
       
        $ven = webUser::where('status',1)->where('account_type','v')->orderBy('firstName','Asc')->get(['id','firstName','lastName']);
        $auctions = Cpr_auction::orderByDesc('id')->get();
        
        return view('gr.auctionlist',compact('auctions','cate','ven'));
    }
    
    public function auction_delete($id)
    {
        Cpr_auction::whereId($id)->delete();
        return redirect()->back()->with('success','Auction Deleted Successfully!');
    }
    public function auction_won($id)
    {
        $win = Cpr_auction_bid::where('id',$id)->orderByDesc('bid_amount')->first();
            Cpr_auction_bid::where('id',$win->id)->update(['status'=>1]);
            Cpr_auction::where('id',$win->cpr_auction_id)->update(['status'=>0]);
            $ids = Cpr_auction_enquiry::where('cpr_auction_id',$win->cpr_auction_id)->pluck('cpr_ad_enquiry_id')->toArray();
            Cpr_ad_enquiry::whereIn('id',$ids)->update(['reciever_id' => $win->web_user_id]);
        return redirect()->back()->with('success','Auction Grant Successfully!');
    }
    
    public function getBidderList(Request $request)
    {
        $data = Cpr_auction_bid::where('cpr_auction_id',$request->auction_id)->orderByDesc('id')->get();

        $html = "";
       foreach ($data as $key => $value) 
       {
            $use =  webUser::find($value->web_user_id);
            $value->status == 1 ? $status = 'Won' :$status = 'Pending';
            $user= $use?->firstName.' '.$use->lastName;
            $won = Cpr_auction_bid::where('cpr_auction_id',$request->auction_id)->where('status',1)->first();
            isset($won)? $url = 'javascript:void(0)':$url = url('auction_won/'.$value->id);
            if(isset($won))
            {
                $durl = '';
            }
            else
            {
                $durl = '<li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Enable">
                                                            <a href="'.$url.'" class="text-muted d-inline-block">
                                                                <i class="ri-check-fill fs-16" style="color:green;font-weight: bold;"></i>
                                                            </a>
                            </li>';
            }
            $html .='<tr> 
                    <td>'.++$key.'</td>
                    <td>'.$user.'</td>
                    <td>'.$use?->companyName.'</td>
                    <td>'.$use?->email.'</td>
                    <td>'.$use?->phone.'</td>
                    <td>'.$value->bid_amount.'</td>
                    <td>'.$status.'</td>
                    <td>'.$durl.'</td>
                    </tr>';
                    
            
       }
       return $html;
    }

}
