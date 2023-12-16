<?php

namespace App\Http\Controllers\Admin;

use App\Permission;
use Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {          
        $menuData = Permission::get();
        $val = [];
        $i=0;
        foreach($menuData as $data){
            $val[$data->role->name][$i] = $data->menu;
            $i++;
        }
        return view('admin.permission.index',array('data'=>$val));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permission.create');
    }

    public function store(Request $request)
    {
        $menudata['role_id'] = $request->role_id;
        $menudata['menu_id'] = session('id');
        foreach($request->menu_id as $menu) {
            $menudata['menu_id'] = $menu;
            Permission::create($menudata);
        }
        return Redirect::route('permission')->with('message', 'Successfully Created!');
        
    }

    public function destroy($id) {
        Permission::Destroy($id);
        return \Redirect::route('permission')->with('message', 'Successfully Deleted!');
    }
    
}
