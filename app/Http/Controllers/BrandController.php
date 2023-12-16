<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\MasterValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Brand::orderBy('id', 'DESC')->get();
        // dd($data);
        $state = DB::table('states')->where('country_id', 101)->select('name', 'id')->get();
        $city = DB::table('cities')->where('country_id', 101)->select('name', 'id')->get();
        $indus = MasterValue::where('MasterHead',15)->where('status',1)->orderBy('id', 'DESC')->get();
        $seg = MasterValue::where('MasterHead',16)->where('status',1)->orderBy('id', 'DESC')->get();
        return view('gr.brand', compact('state', 'city', 'data','indus','seg'));
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
        if (isset($request->brandid)) {
            $data= Brand::find($request->brandid);
            $cancelCheque = $data->cancelCheque;
            $photo =  $data->photo;
        } else {
            $cancelCheque = "";
            $photo = "";
        }
        
        if ($request->hasFile('cancelCheque')) {
            $imgname = $request->file('cancelCheque');
            $filename = $request->brandPhone . rand(11, 99) . date('Ymdhis') . '.' . $imgname->extension();
            $imgname->storeAs('document/brand', $filename, 'public');
            $cancelCheque = $filename;
        }
        if ($request->hasFile('photo')) {
            $imgname = $request->file('photo');
            $filename = $request->brandPhone . rand(11, 99) . date('Ymdhis') . '.' . $imgname->extension();
            $imgname->storeAs('document/brand', $filename, 'public');
            $photo = $filename;
        }
        if (isset($request->brandid)) {
            Brand::whereId($request->brandid)->update($request->except('_token', 'photo', 'cancelCheque', 'brandid') + ['cancelCheque' => $cancelCheque] + ['photo' => $photo]);
        } else {
            Brand::create($request->except('_token', 'photo', 'cancelCheque', 'brandid') + ['cancelCheque' => $cancelCheque] + ['photo' => $photo]);
        }

        return redirect(route('Brand.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //
    }
    public function brand_desable($id)
    {
        $data =  Brand::find($id);

        if ($data->status == 1) {
            $data->status = 0;
            $msg = 'Desabled';
        } else {
            $data->status = 1;
            $msg = 'Enabled';
        }
        $data->save();
        return redirect(route('Brand.index'))->with('success', 'brand ' . $msg . ' Successfully!');
    }
    public function brand_delete($id)
    {
        Brand::whereId($id)->delete();
        return redirect(route('Brand.index'))->with('success', 'brand Deleted Successfully!');
    }
    public function editbrand(Request $request)
    {
        $data = Brand::find($request->id);
        return json_encode($data, true);
    }
}
