<?php

namespace App\Http\Controllers;

use App\Models\Cpr_ad_filter;
use App\Models\cpr_ad_filter_values;
use Illuminate\Http\Request;

class FilterValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $filter = Cpr_ad_filter::orderByDesc('id')->get();
        $data = cpr_ad_filter_values::join('cpr_ad_filters','cpr_ad_filters.id','=','cpr_ad_filter_values.filter_id')
        ->select('cpr_ad_filter_values.*','cpr_ad_filters.filter_name')
        ->orderByDesc('cpr_ad_filter_values.id')->get();
        return view('gr.filterValue',compact('data','filter'));
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
        $filter_value = explode(',',$request->filter_value);
        foreach($filter_value as $key=>$val)
        {
            $data = new cpr_ad_filter_values();
            $data->filter_id = $request->filter_id;
            $data->filter_value = $val;
            $data->status = $request->status;
            $data->save();
        }
        return redirect(route('FilterValue.index'))->with('success','FilterValue Created successfully!');
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
        $filter = Cpr_ad_filter::orderByDesc('id')->get();
       $data = cpr_ad_filter_values::join('cpr_ad_filters','cpr_ad_filters.id','=','cpr_ad_filter_values.filter_id')
        ->select('cpr_ad_filter_values.*','cpr_ad_filters.filter_name')
        ->orderByDesc('cpr_ad_filter_values.id')->get();
        $item = cpr_ad_filter_values::find($id);
        return view('gr.filterValue',compact('data','filter','item'));

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
        // $data = new cpr_ad_filter_values();
        $data = cpr_ad_filter_values::find($id);
        $data->filter_id = $request->filter_id;
        $data->filter_value = $request->filter_value;
        $data->status = $request->status;
        $data->save();
        return redirect(route('FilterValue.index'))->with('success','FilterValue Updated successfully!');
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
    public function FilterValue_desable($id)
    {
        cpr_ad_filter_values::whereId($id)->update(['status'=>0]);
        return redirect(route('FilterValue.index'))->with('success','FilterValue Disabled successfully!');
    }
    public function Filtervalue_enable($id)
    {
        cpr_ad_filter_values::whereId($id)->update(['status'=>1]);
        return redirect(route('FilterValue.index'))->with('success','FilterValue Enaabled successfully!');
    }
    public function Filtervalue_delete($id)
    {
        cpr_ad_filter_values::whereId($id)->delete();
        return redirect(route('FilterValue.index'))->with('success','FilterValue Deleted successfully!');
    }
}
