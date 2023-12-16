<?php

namespace App\Http\Controllers;

use App\Models\Cpr_footer_category;
use Illuminate\Http\Request;

class subFooterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cat = Cpr_footer_category::where('parent_id',0)->orderByDesc('id')->get();
        $data = Cpr_footer_category::where('parent_id','!=',0)->orderByDesc('id')->get();

        return view('gr.subFooter',compact('data','cat'));
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
        $data = new Cpr_footer_category();
        $data->name = $request->name;
        $data->link = $request->link;
        $data->status = $request->status;
        $data->parent_id = $request->parent_id;
        $data->save();
        return redirect(route('subFooter.index'))->with('success','subFooter Category Created Successfully!');
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
        $cat = Cpr_footer_category::where('parent_id',0)->orderByDesc('id')->get();
        $data = Cpr_footer_category::where('parent_id','!=',0)->orderByDesc('id')->get();
      
        $item = Cpr_footer_category::find($id);
        return view('gr.subFooter',compact('data','cat','item'));
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
        $data = Cpr_footer_category::find($id);
        $data->name = $request->name;
        $data->link = $request->link;
        $data->status = $request->status;
        $data->parent_id = $request->parent_id;
        $data->save();
        return redirect(route('subFooter.index'))->with('success','subFooter Category Updated Successfully!');
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
    public function subFooter_disable($id)
    {
       
        Cpr_footer_category::whereId($id)->update(['status'=>0]);
        return redirect(route('subFooter.index'))->with('success','subFooter Disabled successfully!');
    }
    public function subFooter_enable($id)
    {
        Cpr_footer_category::whereId($id)->update(['status'=>1]);
        return redirect(route('subFooter.index'))->with('success','subFooter Enaabled successfully!');
    }
    public function subFooter_delete($id)
    {
        
        Cpr_footer_category::whereId($id)->delete();
        return redirect(route('subFooter.index'))->with('success','subFooter Deleted successfully!');
    }
}
