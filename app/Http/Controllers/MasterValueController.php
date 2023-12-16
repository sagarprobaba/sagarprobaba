<?php

namespace App\Http\Controllers;

use App\Models\Master;
use App\Models\MasterValue;
use Illuminate\Http\Request;

class MasterValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = MasterValue::orderby('id','desc')->get();
        $master = Master::where('status',1)->orderby('id','desc')->get();
        return view('gr.mastervalues',compact('data','master'));
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
        
        $MasterValue = explode(',',$request->MasterValue);
        $loop = sizeof($MasterValue);
        for($i=0;$i<$loop;$i++) {
            $data = new MasterValue();
            $data->MasterHead = $request->MasterHead;
         
        
            $data->MasterValue = $MasterValue[$i];

            $data->created_by = auth()->user()->id;
            if ($request->hasFile('MasterValueIcon')) {
                $imgname = $request->file('MasterValueIcon');
                $filename = $MasterValue[$i].rand(111, 999).date('Ymdhis').'.'.$imgname->extension();
                $imgname->storeAs('document', $filename, 'public');
             
                $data['MasterValueIcon']=$filename;
            }
            $data->save();
        }
        return redirect(route('MasterValue.index'))->with('success','Master Values Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterValue  $masterValue
     * @return \Illuminate\Http\Response
     */
    public function show(MasterValue $masterValue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterValue  $masterValue
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterValue $masterValue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterValue  $masterValue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterValue $masterValue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterValue  $masterValue
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterValue $masterValue)
    {
        //
    }

    public function masterValue_desable($id)
    {
        $data =  MasterValue::find($id);

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
        return redirect(route('MasterValue.index'))->with('success','MasterValue '.$msg.'Successfully!');
    }
    public function masterValue_delete($id)
    {
        MasterValue::whereId($id)->delete();
        return redirect(route('MasterValue.index'))->with('success','MasterValue Deleted Successfully!');
    }
    public function editmastervalue(Request $request)
    {
        $data = MasterValue::find($request->id);
        return json_encode($data,true);
    }
}
