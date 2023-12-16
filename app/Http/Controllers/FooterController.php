<?php

namespace App\Http\Controllers;

use App\Models\Cpr_footer_category;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Cpr_footer_category::where('parent_id',0)->orderByDesc('id')->get();
        return view('gr.footer',compact('data'));
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
        $data->parent_id = 0;
        $data->save();
        return redirect(route('Footer.index'))->with('success','Footer Category Created Successfully!');
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
        $data = Cpr_footer_category::where('parent_id',0)->orderByDesc('id')->get();
        $item = Cpr_footer_category::find($id);
        return view('gr.footer',compact('data','item'));
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
        $data->save();
        return redirect(route('Footer.index'))->with('success','Footer Category Updated Successfully!');
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
    public function Footer_disable($id)
    {
       
        Cpr_footer_category::whereId($id)->update(['status'=>0]);
        return redirect(route('Footer.index'))->with('success','Footer Disabled successfully!');
    }
    public function Footer_enable($id)
    {
        Cpr_footer_category::whereId($id)->update(['status'=>1]);
        return redirect(route('Footer.index'))->with('success','Footer Enaabled successfully!');
    }
    public function Footer_delete($id)
    {
        Cpr_footer_category::where('parent_id',$id)->delete();
        Cpr_footer_category::whereId($id)->delete();
        return redirect(route('Footer.index'))->with('success','Footer Deleted successfully!');
    }
}
