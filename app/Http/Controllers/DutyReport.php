<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\FreelancerAttendance;
use App\Models\Verification;
use Illuminate\Http\Request;

class DutyReport extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $todate = date('Y-m-d');
        $data = Employee::select('id','EmployeeName','EmployeePhone','photo')->get();
        foreach($data as $key => $row)
        {
            $attend = FreelancerAttendance::where('freelancerId',$row->id)->whereDate('date',$todate)->first();
            if($attend)
            {
                $data[$key]->attandence = "On Duty";
                $data[$key]->time =  $attend->time;
                $data[$key]->date =  $attend->date;
                $data[$key]->address =  $attend->address;
            }
            else{
                $data[$key]->attandence = "Off Duty";
                $data[$key]->time =  "";
                $data[$key]->date =  "";
                $data[$key]->address =  "";
            }
            $verify = Verification::where('asignId',$row->id)->whereDate('assignDate',$todate)->count('id');
            $complete = Verification::where('asignId',$row->id)->whereDate('assignDate',$todate)->whereDate('completeDate',$todate)->count('id');
            
                $data[$key]->totalAssignDuty =$verify;       
                $data[$key]->totalcompleteDuty =$complete;
                $data[$key]->due =$verify-$complete;
            
            $dates = Verification::where('asignId',$row->id)->whereDate('assignDate',$todate)->whereDate('completeDate',$todate)->max('id');
            if($dates)
            {
                $dates = Verification::whereid($dates)->first();
                $data[$key]->acceptDate =$dates->assignDate;
                $data[$key]->completeDate =$dates->completeDate;
            }
            else
            {
                $data[$key]->acceptDate ="";
                $data[$key]->completeDate ="";
            }


        }
        $employee = Employee::orderBy('EmployeeName')->get();

        return view('gr.dutyReport',compact('data','employee'));
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
    public function filterReport(Request $request)
    {
       
        if(isset($request->date))
        {
            $todate = $request->date;
        }
        else
        {
            $todate = date('Y-m-d');

        }
        $data = Employee::select('id','EmployeeName','EmployeePhone','photo');
        $freelancer = "";
        if(isset($request->freelancer))
        {
            $freelancer = $request->freelancer;
            $data = $data->whereId($request->freelancer);
        }
        $data = $data->get();
        foreach($data as $key => $row)
        {
            
            $attend = FreelancerAttendance::where('freelancerId',$row->id)->whereDate('date',$todate)->first();
            if($attend)
            {
                $data[$key]->attandence = "On Duty";
                $data[$key]->time =  $attend->time;
                $data[$key]->date =  $attend->date;
                $data[$key]->address =  $attend->address;
            }
            else{
                $data[$key]->attandence = "Off Duty";
                $data[$key]->time =  "";
                $data[$key]->date =  "";
                $data[$key]->address =  "";
            }
            $verify = Verification::where('asignId',$row->id)->whereDate('assignDate',$todate)->count('id');
            $complete = Verification::where('asignId',$row->id)->whereDate('assignDate',$todate)->whereDate('completeDate',$todate)->count('id');
            
                $data[$key]->totalAssignDuty =$verify;       
                $data[$key]->totalcompleteDuty =$complete;
                $data[$key]->due =$verify-$complete;
            
            $dates = Verification::where('asignId',$row->id)->whereDate('assignDate',$todate)->whereDate('completeDate',$todate)->max('id');
            if($dates)
            {
                $dates = Verification::whereid($dates)->first();
                $data[$key]->acceptDate =$dates->assignDate;
                $data[$key]->completeDate =$dates->completeDate;
            }
            else
            {
                $data[$key]->acceptDate ="";
                $data[$key]->completeDate ="";
            }


        }
        
        $employee = Employee::orderBy('EmployeeName')->get();

        return view('gr.dutyReport',compact('data','employee','todate','freelancer'));
    }
}
