<?php

namespace App\Http\Controllers;

use App\Imports\VerifyDocument;
use App\Models\AddressVerification;
use App\Models\Brand;
use App\Models\Verification;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use function GuzzleHttp\Promise\all;

class VerificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Verification::orderBy('id','DESC')->get();
        $brand = Brand::where('status',1)->orderBy('id',"desc")->get();
        return view('gr.addressForm',compact('data','brand'));
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
        // dd($request->all());
        Session()->put('brandid', $request->brandId);
        Session()->put('verificationType', $request->verificationType);
        if($request->hasFile('file')){            
            $imgname = $request->file('file');
                $filename = $request->verificationType.date('Ymdhis').'.'.$imgname->extension();
                $imgname->storeAs('document/uploads/', $filename, 'public');
                $data['file']=$filename;
        }

        Excel::import(new VerifyDocument,$request->file('file')->store('temp'));
        
        session()->forget('brandid');
        session()->forget('verificationType');

        return redirect(route('Uploads.index'))->with('success','File Uploaded Successfully!');
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
}
