<?php

namespace App\Http\Controllers;

use App\Models\Cpr_ad_filter;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Cpr_ad_filter::orderByDesc('id')->get();
        return view('gr.filter',compact('data'));
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
        $data = new Cpr_ad_filter();
        $data->filter_name = $request->filter_name;
        $data->alias = $request->alias;
        $data->type = $request->type;
        $data->description = $request->description;
        $data->status = $request->status;
        $data->save();
        return redirect(route('Filter.index'))->with('success','Filter Created successfully!');
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
        $item = Cpr_ad_filter::find($id);
        $data = Cpr_ad_filter::orderByDesc('id')->get();
        return view('gr.filter',compact('data','item'));

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
        $data = Cpr_ad_filter::find($id);
        $data->filter_name = $request->filter_name;
        $data->alias = $request->alias;
        $data->type = $request->type;
        $data->description = $request->description;
        $data->status = $request->status;
        $data->save();
        return redirect(route('Filter.index'))->with('success','Filter Created successfully!');
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
    public function Filter_desable($id)
    {
        Cpr_ad_filter::whereId($id)->update(['status'=>0]);
        return redirect(route('Filter.index'))->with('success','Filter Disabled successfully!');
    }
    public function Filter_enable($id)
    {
        Cpr_ad_filter::whereId($id)->update(['status'=>1]);
        return redirect(route('Filter.index'))->with('success','Filter Enable successfully!');
    }
    public function Filter_delete($id)
    {
        Cpr_ad_filter::whereId($id)->delete();
        return redirect(route('Filter.index'))->with('success','Filter Deleted successfully!');
    }
}
