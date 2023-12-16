<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $comp = Company::where('status',1)->get();
        $data = Branch::orderby('id','desc')->get();
        $state = DB::table('states')->where('country_id',101)->select('name','id')->get();
        $city = DB::table('cities')->where('country_id',101)->select('name','id')->get();
        return view('gr.branch',compact('data','city','state','comp'));
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
        if(isset($request->Branchid))
        {
            $data =  Branch::find($request->Branchid);
            $msg = 'Branch Updated Successfully';
        }
        else
        {
            $data  = new Branch();
            $msg = 'Branch Created Successfully';

        }
        $data->CompanyName = $request->CompanyName;
        $data->BranchName = $request->BranchName;
        $data->BranchEmail  = $request->BranchEmail;
        $data->BranchPhone = $request->BranchPhone;
        $data->BranchAddress = $request->BranchAddress;
        $data->Country = $request->Country;
        $data->State = $request->State;
        $data->City = $request->City;
        $data->created_by = auth()->user()->id;       
        $data->save();
        return redirect(route('Branch.index'))->with('success','Branch Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        //
    }

    public function branch_desable($id)
    {
        $data =  Branch::find($id);

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
        return redirect(route('Branch.index'))->with('success','Branch '.$msg.' Successfully!');
    }

    public function branch_delete($id)
    {
        Branch::whereId($id)->delete();
        return redirect(route('Branch.index'))->with('success','Branch Deleted Successfully!');
    }
    public function editbranch(Request $request)
    {
        $data = Branch::find($request->id);
        return json_encode($data,true);
    }
}
