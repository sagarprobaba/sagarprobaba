<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\employeeLowerTable;
use App\Models\EmployeeVerification;
use Illuminate\Http\Request;

class EmployeeVerificationController extends Controller
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
        return view('gr.employeeVerification',compact('brand'));
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
        $data = EmployeeVerification::create($request->except('_token'));        
        employeeLowerTable::where('Uperid', 0)->where('userId',auth()->user()->id)->update(array('Uperid' => $data->brandName));

        return redirect(route('employeeForm.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeeVerification  $employeeVerification
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeVerification $employeeVerification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeeVerification  $employeeVerification
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeVerification $employeeVerification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeeVerification  $employeeVerification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeVerification $employeeVerification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeeVerification  $employeeVerification
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeVerification $employeeVerification)
    {
        //
    }
}
