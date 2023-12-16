<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Company;
use App\Models\MasterValue;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Ver_admin_menu;

class staffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $city = DB::table('cities')->where('country_id', 101)->orderBy('name', 'ASC')->get();
        $state = DB::table('states')->where('country_id', 101)->orderBy('name', 'ASC')->get();
        $data = User::where('type','s')->orderby('id','desc')->get();
        $stfid = user::where('type','s')->max('id');
        if($stfid==null)
        {
            $eid = 'EMP'. str_pad(1,3, '0', STR_PAD_LEFT);
        }
        else
        {
            $eid = 'EMP'. str_pad($stfid+1,3, '0', STR_PAD_LEFT);
        }
        $comp = Company::where('status',1)->get();
        $bname = Branch::where('status',1)->orderby('id','desc')->get();
        $dname = MasterValue::where('MasterHead',2)->where('status',1)->get();
        $desig = MasterValue::where('MasterHead',3)->where('status',1)->get();
        $amenus = Ver_admin_menu::where('link','!=',null)->get();
        return view('gr.staff',compact('data','eid','city','state','comp','bname','dname','desig','amenus'));
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
        if(isset($request->staffid))
        {
            $request->validate([
                'email' => 'required|unique:users,email,'.$request->staffid
            ]);
            $data =  User::find($request->staffid);
            $msg = 'User Updated Successfully';
        }
        else
        {
            $request->validate([
                'password'=>'required|confirmed',
                'email' => 'required|unique:users,email,'
            ]);
            $data  = new User();
            $msg = 'User Created Successfully';
            

        }  
        $data->Empid = $request->Empid;
        $data->name = $request->name;
        $data->LastName = $request->LastName;
        $data->email = $request->email;
        $data->MobileNo = $request->MobileNo;
        $data->Gender = $request->Gender;
        $data->Address = $request->Address;
        $data->Country = $request->Country;
        $data->State = $request->State;
        $data->City = $request->City;
        $data->AssignCompany = $request->AssignCompany;
        $data->AssignBranchOffice = $request->AssignBranchOffice;
        $data->AssignDepartment = $request->AssignDepartment;
        $data->AssignDesignation = $request->AssignDesignation;
        if(isset($request->menu))
        {
            $data->menu = implode(",",$request->menu);
        }
        else
        {
            $data->menu = null;
        }
        if(isset($request->delete_access))
        {
            $data->delete_access = 1;
        }
        else
        {
            $data->delete_access = 0;
        }
        
        
        $data->type ='s';
        if(isset($request->password))
        {
            $data->password = Hash::make($request->password);

        }
        $data->created_by = auth()->user()->id;
        if($request->hasFile('profile')){            
            $imgname = $request->file('profile');
                $filename = $request->MobileNo.rand(11,99).date('Ymdhis').'.'.$imgname->extension();
                $imgname->storeAs('document/staff/', $filename, 'public');             
                $data['profile']=$filename;
        }
        $data->save();
        return redirect(route('Staff.index'))->with('success',$msg);

        
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

    public function staff_desable($id)
    {
        $data =  User::find($id);

        if($data->status ==1)
        {
            $data->status = 0;
            $msg = 'Desabled';
        }
        else
        {
            $data->status = 1;
            $msg = 'Enabled';
        }
        $data->save();
        return redirect(route('Staff.index'))->with('success','Staff '.$msg.'Successfully!');
    }
    public function staff_delete($id)
    {
        User::whereId($id)->delete();
        return redirect(route('Staff.index'))->with('success','Staff Deleted Successfully!');
    }
    public function editstaff(Request $request)
    {
        $data = User::find($request->id);
        return json_encode($data,true);
    }
}
