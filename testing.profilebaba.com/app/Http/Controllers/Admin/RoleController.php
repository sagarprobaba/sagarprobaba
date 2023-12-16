<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {          
        $data = Role::where("created_by",1)->get();
        return view('admin.role.index',array('data' => $data));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.create');
    }

    public function store(Request $request)
    {
        $Roledata = $request->all();
        Role::create($Roledata);
        return Redirect::route('role')->with('message', 'Successfully Created!');
        
    }

    public function edit($id) {
        $item = Role::find($id);
        return view('admin.role.edit', array('item' => $item));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $Roledata = Role::find($id);
        $Roledata['name'] = $request['name'];
        if($Roledata->save()){
            return Redirect::route('role')->with('message', 'Successfully Updated!');
        }
    }

    public function destroy($id) {
        Role::Destroy($id);
        return \Redirect::route('role')->with('message', 'Successfully Deleted!');
    }
    
}
