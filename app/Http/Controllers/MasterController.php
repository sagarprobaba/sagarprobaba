<?php

namespace App\Http\Controllers;

use App\Models\Master;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Master::all();
        return view('gr.master',compact('data'));
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
        $data = new Master();
        $data->MasterHead = $request->MasterHead;
        $data->created_by = auth()->user()->id;
        if($request->hasFile('MasterIcon')){            
            $imgname = $request->file('MasterIcon');
                $filename = $request->MasterHead.rand(11,99).date('Ymdhis').'.'.$imgname->extension();
                $imgname->storeAs('document', $filename, 'public');
             
                $data['MasterIcon']=$filename;
        }
        $data->save();
        return redirect(route('Master.index'))->with('success','Master Created Successfully!');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master  $master
     * @return \Illuminate\Http\Response
     */
    public function show(Master $master)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Master  $master
     * @return \Illuminate\Http\Response
     */
    public function edit(Master $master)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master  $master
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Master $master)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master  $master
     * @return \Illuminate\Http\Response
     */
    public function destroy(Master $master)
    {
        //
    }

    public function master_desable($id)
    {
        $data =  Master::find($id);

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
        return redirect(route('Master.index'))->with('success','Master '.$msg.'Successfully!');
    }
    public function master_delete($id)
    {
        Master::whereId($id)->delete();
        return redirect(route('Master.index'))->with('success','Master Deleted Successfully!');
    }
}
