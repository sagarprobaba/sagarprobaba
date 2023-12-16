<?php

namespace App\Http\Controllers;

use App\Models\Cpr_page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Cpr_page::orderBydesc('id')->get();
        return view('gr.pages',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('gr.pageCreate');
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
        
        $footer = '';
        if ($request->hasFile('banner')) {
            $path = public_path('/footer');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file = $request->file('banner');
            $fileName = uniqid() . '_' . trim($file->getClientOriginalName());          
            $file->move($path, $fileName);
            $footer = $fileName;
        }
        $string = preg_replace('/[^A-Za-z0-9\-]/', ' ', $request->name);
        $slug = Str::slug($string, '-');
        Cpr_page::create($request->except('_token','image')+['slug'=>$slug]+['image'=>$footer]);
        return redirect(route('Pages.index'))->with('success','Page Created successfully');
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
        $data = Cpr_page::orderBydesc('id')->get();
        $item = Cpr_page::find($id);
        return view('gr.pageCreate',compact('data','item'));

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
        
        $item = Cpr_page::find($id);
        $footer = $item->image;
        if ($request->hasFile('image')) {
            $path = public_path('/footer');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            
            $file = $request->file('image');
             
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();          
            $file->move($path, $fileName);
            $footer=$fileName;
        }
        $string = preg_replace('/[^A-Za-z0-9\-]/', ' ', $request->name);
        $slug = Str::slug($string, '-');

        Cpr_page::whereId($id)->update($request->except('_token','_method','image')+['slug'=>$slug]+['image'=>$footer]);
        return redirect(route('Pages.index'))->with('success','Page Updated successfully');
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
    public function pages_disable($id)
    {
        Cpr_page::whereId($id)->update(['status'=>0]);
        return redirect(route('Pages.index'))->with('success','page Disabled successfully!');
    }
    public function pages_enable($id)
    {
        Cpr_page::whereId($id)->update(['status'=>1]);
        return redirect(route('Pages.index'))->with('success','page Enaabled successfully!');
    }
    public function pages_delete($id)
    {
        Cpr_page::whereId($id)->delete();
        return redirect(route('Pages.index'))->with('success','page Deleted successfully!');
    }
}
