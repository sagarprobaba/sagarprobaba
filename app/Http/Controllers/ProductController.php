<?php

namespace App\Http\Controllers;

use App\Models\MasterValue;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Product::orderby('id','desc')->get();
        $proid = Product::max('id');
        if($proid==null)
        {
            $pid = 'P'. str_pad(1,4, '0', STR_PAD_LEFT);
        }
        else
        {
            $pid = 'P'. str_pad($proid+1,4, '0', STR_PAD_LEFT);
        }
        $cat = MasterValue::where('MasterHead',1)->where('status',1)->get();
        return view('gr.product',compact('data','pid','cat'));
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
        $data = new Product();
        $data->PID = $request->PID;
        $data->ProductCategory = $request->ProductCategory;
        $data->ProductName = $request->ProductName;
        $data->ProductSize = $request->ProductSize;
        $data->ProductRate = $request->ProductRate;
        $data->stock = $request->stock;

        $data->created_by = auth()->user()->id;
        if($request->hasFile('ProductImage')){            
            $imgname = $request->file('ProductImage');
                $filename = $request->ProductName.rand(11,99).date('Ymdhis').'.'.$imgname->extension();
                $imgname->storeAs('document', $filename, 'public');
                $data['ProductImage']=$filename;
        }
        $data->save();
            return redirect(route('Product.index'))->with('success','Product Created Successfully');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function product_desable($id)
    {
        $data =  Product::find($id);

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
        return redirect(route('Product.index'))->with('success','Product '.$msg.'Successfully!');
    }
    public function product_delete($id)
    {
        Product::whereId($id)->delete();
        return redirect(route('Product.index'))->with('success','Product Deleted Successfully!');
    }
}


