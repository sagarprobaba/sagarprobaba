<?php

namespace App\Http\Controllers;

use App\Models\Cpr_ad_chat;
use App\Models\Cpr_ad_chat_file;
use App\Models\Cpr_ad_enquiry;
use App\Models\Cpr_ad_event;
use App\Models\Cpr_ad_mapped_category;
use App\Models\Cpr_Add_filter_value;
use App\Models\Cpr_Add_images;
use App\Models\Cpr_Add_post;
use App\Models\Cpr_wishlist;
use App\Models\webUser;
use App\Models\Cpr_ad_category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class userListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $userType = 'v';
        $cat = Cpr_ad_category::where('parent_id', 0)->orderByDesc('id')->get();
        $datas= webUser::where('status',1)->where('account_type','v')->where('source','web')->orderBydesc('id')->paginate(100);
        $tdata= webUser::where('status',1)->where('account_type','v')->where('source','web')->orderBydesc('id')->count();
        $cat = Cpr_ad_category::where('status',1)->orderBy('category_name','Asc')->get();
        return view('gr.userlist',compact('datas','cat','userType','tdata','cat'));
    }
    public function rejectedUser()
    {
        $userType = 'v';
        $cat = Cpr_ad_category::where('parent_id', 0)->orderByDesc('id')->get();
        $datas= webUser::where('status',0)->where('account_type','v')->orderBydesc('id')->paginate(100);
        $tdata= webUser::where('status',0)->where('account_type','v')->orderBydesc('id')->count();
        $cat = Cpr_ad_category::where('status',1)->orderBy('category_name','Asc')->get();
        return view('gr.userlist',compact('datas','cat','userType','cat','tdata'));
    }
    public function api_vendors()
    {
        $userType = 'v';
        $cat = Cpr_ad_category::where('parent_id', 0)->orderByDesc('id')->get();
        $datas= webUser::where('status',1)->where('account_type','v')->where('company_category','!=',null)->where('source','api')->orderBydesc('id')->paginate(100);
        $tdata= webUser::where('status',1)->where('account_type','v')->where('company_category','!=',null)->where('source','api')->orderBydesc('id')->count();
        $cat = Cpr_ad_category::where('status',1)->orderBy('category_name','Asc')->get();
        return view('gr.userlist',compact('datas','cat','userType','tdata','cat'));
    }
    public function api_vendors_without_cat()
    {
        $userType = 'v';
        $cat = Cpr_ad_category::where('parent_id', 0)->orderByDesc('id')->get();
        $datas= webUser::where('status',1)->where('account_type','v')->where('company_category',null)->where('source','api')->orderBydesc('id')->paginate(100);
        $tdata= webUser::where('status',1)->where('account_type','v')->where('company_category',null)->where('source','api')->orderBydesc('id')->count();
        $cat = Cpr_ad_category::where('status',1)->orderBy('category_name','Asc')->get();
        return view('gr.userlist',compact('datas','cat','userType','tdata','cat'));
    }
    public function approveBuyer()
    {
        $userType = 'u';
        $cat = Cpr_ad_category::where('parent_id', 0)->orderByDesc('id')->get();
        $datas= webUser::where('status',1)->where('account_type','u')->orderBydesc('id')->paginate(100);
        $tdata= webUser::where('status',1)->where('account_type','u')->orderBydesc('id')->count();
        $cat = Cpr_ad_category::where('status',1)->orderBy('category_name','Asc')->get();
        return view('gr.userlist',compact('datas','cat','userType','tdata','cat'));
    }
    public function rejectedBuyer()
    {
        $userType = 'u';
        $cat = Cpr_ad_category::where('parent_id', 0)->orderByDesc('id')->get();
        $datas= webUser::where('status',0)->where('account_type','u')->orderBydesc('id')->paginate(100);
        $tdata= webUser::where('status',0)->where('account_type','u')->orderBydesc('id')->count();
        $cat = Cpr_ad_category::where('status',1)->orderBy('category_name','Asc')->get();
        return view('gr.userlist',compact('datas','cat','userType','tdata','cat'));
    }
    public function userUpdate(Request $request)
    {
        $request->validate([
            'phone' => 'required|unique:web_users,id,'.$request->userid,
        ]);

        $data = webUser::find($request->userid);
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

        webUser::whereId($request->userid)->update($request->except('_token', 'image', 'companyLogo', 'cac_certificate','userid') + ['image' => $image] + ['companyLogo' => $logo] + ['cac_certificate' => $cac_certificate]);
        
        return redirect()->back()->with('success','user Updated successfully!');
        
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
    public function user_reject($id)
    {
        webUser::whereId($id)->update(['status'=>0]);
        return redirect()->back()->with('success','user rejected successfully!');
    }
    public function user_approve($id)
    {
        webUser::whereId($id)->update(['status'=>1]);
        return redirect()->back()->with('success','user Approved successfully!');
    }
    public function editUser(Request $request)
    {
        $data = webUser::find($request->id);
        return json_encode($data,true);
    }
    public function user_delete($id)
    {
       $data = Cpr_Add_post::where('user_id',$id)->get();
       $adArray = array();
        foreach ($data as $key => $value) {
           array_push($adArray,$value->id);
        }
        Cpr_Add_filter_value::whereIn('ad_id',$adArray)->delete();
        Cpr_Add_images::whereIn('ad_id',$adArray)->delete();
        Cpr_ad_enquiry::whereIn('ad_id',$adArray)->delete();
        Cpr_ad_event::whereIn('ad_id',$adArray)->delete();
        Cpr_wishlist::whereIn('ad_id',$adArray)->delete();
        Cpr_ad_mapped_category::whereIn('ad_id',$adArray)->delete();
        Cpr_ad_chat::whereIn('ad_id',$adArray)->delete();
        Cpr_ad_chat_file::whereIn('ad_id',$adArray)->delete();
        Cpr_Add_post::whereIn('id',$adArray)->delete();
        webUser::whereId($id)->delete();
        return redirect()->back()->with('success','user Deleted successfully!');
    }
   
}
