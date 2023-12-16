<?php

namespace App\Http\Controllers\Admin;

use View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\MembershipPlan;
use App\VendorPlan;

use Hash;
use DB;
use Redirect;
use Mail; 

class MembershipPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request) 
    {	
    	$plan=MembershipPlan::all();

    	return view('admin.membership_plan.index',array('items'=>$plan));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	return view('admin.membership_plan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $menudata = $request->all();
        MembershipPlan::create($menudata);

        $plan=MembershipPlan::all();

    	return view('admin.membership_plan.index',array('items'=>$plan));
        
    }

    public function edit($id)
    {
    	$plan=MembershipPlan::find($id);

    	return view('admin.membership_plan.edit',array('item'=>$plan));

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
    	$item = MembershipPlan::find($id);

    	$item->title = $request->title;
    	$item->plan_type = $request->plan_type;
    	$item->area = $request->area;
    	$item->price_per_lead = $request->price_per_lead;
    	$item->total_price = $request->total_price;
        $item->lead = $request->lead;
        $item->min_lead = $request->min_lead;
        $item->description = $request->description;

    	$item->save();

    	$plan=MembershipPlan::all();

    	return view('admin.membership_plan.index',array('items'=>$plan));

    }

    public function destroy($id)
    {
        // DB::enableQueryLog();

    	MembershipPlan::Destroy($id);

        // $sqls = DB::getQueryLog();
        // foreach ($sqls as $sql) {
        //     (new \App\Http\Controllers\Admin\AdminController)->admin_query_log($sql);
        // }

    	$plan=MembershipPlan::all();

    	return view('admin.membership_plan.index',array('items'=>$plan));

    }
}
