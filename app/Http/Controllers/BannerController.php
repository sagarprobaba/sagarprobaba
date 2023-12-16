<?php

namespace App\Http\Controllers;

use App\Models\Cpr_banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Cpr_banner::orderByDesc('id')->get();
        return view('gr.banner_list',compact('data'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('gr.banner_create');
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
        $banner = '';
        if ($request->hasFile('banner')) {
            $path = public_path('/banner');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file = $request->file('banner');
            $fileName = uniqid() . '_' . trim($file->getClientOriginalName());          
            $file->move($path, $fileName);
            $banner = $fileName;
        }
        Cpr_banner::create($request->except('_token','banner')+['banner'=>$banner]);
        return redirect(route('Banner.index'))->with('success','Banner created SuccessFully!');
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
        $item = Cpr_banner::find($id);
        return view('gr.banner_create',compact('item'));
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
        $item = Cpr_banner::find($id);
        $banner = $item->banner;

        if ($request->hasFile('banner')) {
            $path = public_path('/banner');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file = $request->file('banner');
            $fileName = uniqid() . '_' . trim($file->getClientOriginalName());          
            $file->move($path, $fileName);
            $banner = $fileName;
        }
        Cpr_banner::whereId($id)->update($request->except('_token','_method','banner')+['banner'=>$banner]);
        return redirect(route('Banner.index'))->with('success','Banner Updated SuccessFully!');
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
    public function banner_disable($id)
    {
        Cpr_banner::whereId($id)->update(['status'=>0]);
        return redirect(route('Banner.index'))->with('success','Banner Disabled successfully!');
    }
    public function banner_enable($id)
    {
        Cpr_banner::whereId($id)->update(['status'=>1]);
        return redirect(route('Banner.index'))->with('success','Banner Enaabled successfully!');
    }
    public function banner_delete($id)
    {
        Cpr_banner::whereId($id)->delete();
        return redirect(route('Banner.index'))->with('success','Banner Deleted successfully!');
    }
}
