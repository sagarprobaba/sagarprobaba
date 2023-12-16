<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\MasterValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $state = DB::table('states')->where('country_id',101)->select('name','id')->get();
        $city = DB::table('cities')->where('country_id',101)->select('name','id')->get();
        $desig = MasterValue::where('MasterHead',3)->where('status',1)->get();
        $data= Client::where('type','R')->orderby('id','DESC')->get();
        return view('gr.ricemill',compact('data','city','state','desig'));
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
        $request->validate([
            'CompanyName'=>'Required',
            'CompanyEmail'=>'Required',
            'CompanyPhone'=>'Required',
        ]);
        $data  = new Client();
        $data->CompanyName = $request->CompanyName;
        $data->CompanyEmail  = $request->CompanyEmail;
        $data->CompanyPhone = $request->CompanyPhone;
        $data->CompanyWebsite = $request->CompanyWebsite;
        $data->CompanyAddress = $request->CompanyAddress;
        $data->Country = $request->Country;
        $data->State = $request->State;
        $data->City = $request->City;
        $data->BankName = $request->BankName;
        $data->Branch = $request->Branch;
        $data->IFSC = $request->IFSC;
        $data->AccountHolderName  = $request->AccountHolderName;
        $data->AccountNumber = $request->AccountNumber;        
        $data->TanNumber = $request->TanNumber;
        $data->GSTNumber = $request->GSTNumber;
        $data->PanNumber = $request->PanNumber;
        $data->type = $request->type;
        $data->FirstName = $request->FirstName;
        $data->LastName = $request->LastName;
        $data->EmailID = $request->EmailID;
        $data->MobileNo = $request->MobileNo;
        $data->Gender = $request->Gender;
        $data->Designation = $request->Designation;
        $data->created_by = auth()->user()->id;
        if($request->hasFile('CancelCheque')){            
            $imgname = $request->file('CancelCheque');
                $filename = $request->CompanyName.rand(11,99).date('Ymdhis').'.'.$imgname->extension();
                $imgname->storeAs('document', $filename, 'public');
                $data['CancelCheque']=$filename;
        }
        $data->save();
        if($request->type=="R")
        {
            return redirect(route('Client.index'))->with('success','Client Created Successfully');

        }
        else
        {
            return redirect(url('dealer'))->with('success','Dealer Created Successfully');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
    public function dealer()
    {
        $desig = MasterValue::where('MasterHead',3)->where('status',1)->get();
        $state = DB::table('states')->where('country_id',101)->select('name','id')->get();
        $city = DB::table('cities')->where('country_id',101)->select('name','id')->get();
        $data= Client::where('type','D')->orderby('id','DESC')->get();
        return view('gr.dealer',compact('data','city','state','desig'));
    }

    public function client_desable($id)
    {
        $data =  Client::find($id);

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
        if($data->type=="R")
        {
            return redirect(route('Client.index'))->with('success','Client '.$msg.' Successfully');

        }
        else
        {
            return redirect(url('dealer'))->with('success','Dealer '.$msg.' Successfully');

        }

    }
    public function client_delete($id)
    {
        $data =  Client::find($id);
        $status = $data->type;
        Client::whereId($id)->delete();
        if($status=="R")
        {
            return redirect(route('Client.index'))->with('success','Rice Mill Deleted Successfully!');

        }
        else
        {
            return redirect(url('dealer'))->with('success','Dealer Deleted Successfully!');

        }
    }
}
