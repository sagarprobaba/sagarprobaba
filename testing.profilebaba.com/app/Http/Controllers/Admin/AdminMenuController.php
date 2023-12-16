<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\AdminMenu;
use Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {          
        $menuData = AdminMenu::where("status",'1')->get();
        return view('admin.admin_menu.index', array('menuData' => $menuData));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admin_menu.create');
    }

    public function store(Request $request)
    {
        $menudata = $request->all();
        $menudata['created_by'] = session('id');
        AdminMenu::create($menudata);
        return Redirect::route('admin_menu')->with('message', 'Successfully Created!');
        
    }

    public function edit($id) {
        $item = AdminMenu::find($id);
        return view('admin.admin_menu.edit', array('item' => $item));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $menudata = AdminMenu::find($id);
        $menudata['name'] = $request['name'];
        $menudata['parent_id'] = $request['parent_id'];
        $menudata['status'] = $request['status'];
        $menudata['url'] = $request['url'];
        if($menudata->save()){
            return Redirect::route('admin_menu')->with('message', 'Successfully Updated!');
        }
    }

    public function destroy($id) {
        AdminMenu::Destroy($id);
        return \Redirect::route('admin_menu')->with('message', 'Successfully Deleted!');
    }
    
}
