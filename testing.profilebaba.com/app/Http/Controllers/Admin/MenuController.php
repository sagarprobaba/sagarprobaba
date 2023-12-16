<?php

namespace App\Http\Controllers\Admin;

use App\Menu;
use App\AdminMenu;
use Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {          
        $menuData = Menu::where("created_by",1)->get();
        return view('admin.menu.index',array('menuData' => $menuData));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function linkadd(request $request)
    {
        $serid = $request->serid;
        switch ($serid) {
            case "3":
                $table = 'cmspages';
                $profix = '';
                break;
             default:
                $table = '';
                $profix = '';
        }

        $items = \DB::table($table)->get();
        //echo $items;
        $output='';
        foreach($items as $item){
            $output.="<option value='".$profix."".$item->slug."'>".$item->title."</option>";            
        }
        return $output;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.menu.create');
    }

    public function store(Request $request)
    {
        $menudata = $request->all();
        Menu::create($menudata);
        return Redirect::route('menu')->with('message', 'Successfully Created!');
        
    }

    public function edit($id) {
        $item = Menu::find($id);
        return view('admin.menu.edit', array('item' => $item));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $menudata = Menu::find($id);
        $menudata['name'] = $request['name'];
        $menudata['href'] = $request['href'];
        $menudata['position'] = $request['position'];
        $menudata['need_login'] = $request['need_login'];
        if($menudata->save()){
            return Redirect::route('menu')->with('message', 'Successfully Updated!');
        }
    }

    public function destroy($id) {
        Menu::Destroy($id);
        return \Redirect::route('menu')->with('message', 'Successfully Deleted!');
    }
    
}
