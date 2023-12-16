<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\companyLowerTable;
use App\Models\CompanyVerification;
use Illuminate\Http\Request;

class CompanyVerificationController extends Controller
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
        return view('gr.companyVerification',compact('brand'));


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
       $data =  CompanyVerification::create($request->except('_token'));       
       companyLowerTable::where('Uperid', 0)->where('userId',auth()->user()->id)->update(array('Uperid' => $data->brandName));
       return redirect(route('companyForm.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompanyVerification  $companyVerification
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyVerification $companyVerification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompanyVerification  $companyVerification
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyVerification $companyVerification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompanyVerification  $companyVerification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompanyVerification $companyVerification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompanyVerification  $companyVerification
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyVerification $companyVerification)
    {
        //
    }
}
