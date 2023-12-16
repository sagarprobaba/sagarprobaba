<?php

namespace App\Http\Controllers;

use App\Models\addressLowerTable;
use App\Models\AddressVerification;
use App\Models\Brand;
use Illuminate\Http\Request;

class addressVerifyrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $brand = Brand::where('status',1)->orderBy('id',"desc")->get();
        return view('gr.addressVerification',compact('brand'));
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
        $data = new AddressVerification();
        $data->brandName = $request->brandName;
        $data->candidateName = $request->candidateName;
        $data->checkId = $request->checkId;
        $data->completeAddress = $request->completeAddress;
        $data->periodOfStay = $request->periodOfStay;
        $data->documentProofAttached = $request->documentProofAttached;
        $data->respondentName = $request->respondentName;
        $data->respondentContactDetails = $request->respondentContactDetails;
        $data->respondentSignature = $request->respondentSignature;
        $data->additionalComment = $request->additionalComment;
        $data->dateOfVisit = $request->dateOfVisit;
        if(isset($request->a1))
        {
            $data->a1 = $request->a1;
        }
        if(isset($request->a2))
        {
            $data->a2 = $request->a2;
        }
        if(isset($request->a3))
        {
            $data->a3 = $request->a3;
        }
        if(isset($request->a4))
        {
            $data->a4 = $request->a4;
        }
        if(isset($request->a5))
        {
            $data->a5 = $request->a5;
        }
        if(isset($request->a6))
        {
            $data->a6 = $request->a6;
        }
        if(isset($request->a7))
        {
            $data->a7 = $request->a7;
        }
        if(isset($request->a8))
        {
            $data->a8 = $request->a8;
        }
        if(isset($request->a9))
        {
            $data->a9 = $request->a9;
        }
        if(isset($request->a10))
        {
            $data->a10 = $request->a10;
        }
        $data->save();
        addressLowerTable::where('Uperid', 0)->where('userId',auth()->user()->id)->update(array('Uperid' => $data->brandName));
        return redirect(route('address.index'));
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
