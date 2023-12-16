<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Contracts\Service\Attribute\Required;

class CompanyController extends Controller
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
        $data = Company::orderby('id','desc')->get();
        
        return view('gr.company',compact('data','city','state'));
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
        if(isset($request->Companyid))
        {
            $data =  Company::find($request->Companyid);
            $msg = 'Company Updated Successfully';
            $cc = $data->CancelCheque;
            $mou = $data->mou;
            $gst = $data->gst;
            $pancard = $data->pancard;
            $logo_file = $data->logo_file;
        }
        else
        {
            $data  = new Company();
            $msg = 'Company Created Successfully';

        }
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
        if($request->hasFile('CancelCheque')){ 
            if(!empty($cc)){unlink("storage/app/public/document/company/".$cc);}           
            $imgname = $request->file('CancelCheque');
                $filename = $request->CompanyPhone.rand(11,99).date('Ymdhis').'.'.$imgname->extension();
                $imgname->storeAs('document/company', $filename, 'public');
             
                $data['CancelCheque']=$filename;
        }
        if($request->hasFile('mou')){ 
            if(!empty($mou)){unlink("storage/app/public/document/company/".$mou);}            
            $imgname = $request->file('mou');
                $filename = $request->CompanyPhone.rand(111,999).date('Ymdhis').'.'.$imgname->extension();
                $imgname->storeAs('document/company', $filename, 'public');
             
                $data['mou']=$filename;
        }
        if($request->hasFile('pancard')){ 
            if(!empty($pancard)){ unlink("storage/app/public/document/company/".$pancard);}            
            $imgname = $request->file('pancard');
                $filename = $request->CompanyPhone.rand(1,9).date('Ymdhis').'.'.$imgname->extension();
                $imgname->storeAs('document/company', $filename, 'public');
             
                $data['pancard']=$filename;
        }
        if($request->hasFile('gst')){  
            if(!empty($gst)){unlink("storage/app/public/document/company/".$gst);}          
            $imgname = $request->file('gst');
                $filename = $request->CompanyPhone.rand(1111,9999).date('Ymdhis').'.'.$imgname->extension();
                $imgname->storeAs('document/company', $filename, 'public');
             
                $data['gst']=$filename;
        }
        if($request->hasFile('logo_file')){  

            if(!empty($logo_file)){unlink("storage/app/public/document/company/".$logo_file);} 

            $imgname = $request->file('logo_file');
                $filename = $request->CompanyPhone.rand(11111,99999).date('Ymdhis').'.'.$imgname->extension();
                $imgname->storeAs('document/company', $filename, 'public');             
                $data['logo_file']=$filename;
        }

        $data->save();
        return redirect(route('Company.index'))->with('success',$msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }

    public function company_desable($id)
    {
        $data =  Company::find($id);

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
        return redirect(route('Company.index'))->with('success','Company '.$msg.' Successfully!');
    }
    public function company_delete($id)
    {
        Company::whereId($id)->delete();
        return redirect(route('Company.index'))->with('success','Company Deleted Successfully!');
    }
    public function editcompany(Request $request)
    {
        $data = Company::find($request->id);
        return json_encode($data,true);
    }
}
