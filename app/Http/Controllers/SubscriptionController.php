<?php

namespace App\Http\Controllers;

use App\Models\Cpr_subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    
    public function subscription_list()
    {
        
        $datas = Cpr_subscription::orderByDesc('id')->get();
        return view('gr.subscription_list',compact('datas'));
    }
    
    
    public function subscription_create()
    {
        
        return view('gr.subscription_create');
    }

    public function subscription_store(Request $request)
    {
        Cpr_subscription::create($request->except('_token'));
        return redirect(route('subscription_list'))->with('success','Subscription created SuccessFully!');
    }

    public function subscription_edit($id)
    {
        $item = Cpr_subscription::find($id);
        return view('gr.subscription_create',compact('item'));
    }

    
    public function subscription_update(Request $request, $id)
    {
        Cpr_subscription::whereId($id)->update($request->except('_token','_method'));
        return redirect(route('subscription_list'))->with('success','Subscription Updated SuccessFully!');
    }
    public function subscription_disable($id)
    {
        Cpr_subscription::whereId($id)->update(['status'=>0]);
        return redirect(route('subscription_list'))->with('success','Subscription Disabled successfully!');
    }
    public function subscription_enable($id)
    {
        Cpr_subscription::whereId($id)->update(['status'=>1]);
        return redirect(route('subscription_list'))->with('success','Subscription Enaabled successfully!');
    }
    public function subscription_delete($id)
    {
        Cpr_subscription::whereId($id)->delete();
        return redirect(route('subscription_list'))->with('success','Subscription Deleted successfully!');
    }
    
    public function active_status(Request $request)
    {
        $item = Cpr_subscription::find($request->id);
        $ct = 0;
        if($item->active_status == 1)
        {
            Cpr_subscription::whereId($request->id)->update(['active_status'=>0]);
        }
        else
        {
             $count = Cpr_subscription::where('active_status',1)->count();
             if($count == 3)
             {
                 $ct = 3;
             }
             else
             {
                 Cpr_subscription::whereId($request->id)->update(['active_status'=>1]);
             }
             
        }
        
        return $ct;
    }
    
    
}
