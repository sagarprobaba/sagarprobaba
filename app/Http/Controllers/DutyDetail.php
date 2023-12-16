<?php

namespace App\Http\Controllers;

use App\Models\AddressVerification;
use App\Models\Brand;
use App\Models\CompanyVerification;
use App\Models\Employee;
use App\Models\EmployeeVerification;
use App\Models\FreelancerAttendance;
use App\Models\Verification;
use Illuminate\Http\Request;

class DutyDetail extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
    public function verifyDetail($id,$type)
    {
        $brand = Brand::where('status',1)->orderBy('id',"desc")->get();
       if($type == "aV")
       {
        
        $item = AddressVerification::find($id);
        return view('gr.addressVerification',compact('brand','item'));
       }
       if($type == "cV")
       {
        $item = CompanyVerification::find($id);
        return view('gr.companyVerification',compact('brand','item'));
       }
       if($type == "eV")
       {
        $item = EmployeeVerification::find($id);
        return view('gr.employeeVerification',compact('brand','item'));
       }
       if($type == "sV")
       {
      
       }
       
       
    }
    public function DutyDetailshow($id,$date)
    {
        
        $todate = $date;

        $data = Employee::whereId($id)->select('id','EmployeeName','EmployeePhone','photo')->first();
       
            $attend = FreelancerAttendance::where('freelancerId',$data->id)->whereDate('date',$todate)->first();
            if($attend)
            {
                $data->attandence = "On Duty";
                $data->time =  $attend->time;
                $data->date =  $attend->date;
                $data->address =  $attend->address;
            }
            else{
                $data->attandence = "Off Duty";
                $data->time =  "";
                $data->date =  "";
                $data->address =  "";
            }
            $verify = Verification::where('asignId',$data->id)->whereDate('assignDate',$todate)->count('id');
            $complete = Verification::where('asignId',$data->id)->whereDate('assignDate',$todate)->whereDate('completeDate',$todate)->count('id');
            
                $data->totalAssignDuty =$verify;       
                $data->totalcompleteDuty =$complete;
                $data->due =$verify-$complete;
            
            $dates = Verification::where('asignId',$data->id)->whereDate('assignDate',$todate)->whereDate('completeDate',$todate)->max('id');
            if($dates)
            {
                $dates = Verification::whereid($dates)->first();
                $data->acceptDate =$dates->assignDate;
                $data->completeDate =$dates->completeDate;
            }
            else
            {
                $data->acceptDate ="";
                $data->completeDate ="";
            }

            $duties = Verification::where('asignId',$data->id)->whereDate('assignDate',$todate)->whereDate('completeDate',$todate)->get();

        return view('gr.dutyDetails',compact('data','duties'));
    }
    
}
