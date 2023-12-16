<?php

namespace App\Http\Controllers;

use App\Models\Cpr_ad_category;
use App\Models\Cpr_ad_category_mapped_filter;
use App\Models\Cpr_ad_filter;
use App\Models\Api_cat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Cpr_ad_category::where('parent_id', 0)->orderByDesc('id')->get();
        $parent = 0;
        return view('gr.category', compact('data', 'parent'));
    }
    
    public function search_category(Request $request)
    {
        //
        $keyword = $request->keyword;
        $data = Cpr_ad_category::where('category_name', 'like', "%{$request->keyword}%")->orderByDesc('id')->get();
        $parent = 0;
        return view('gr.category', compact('data', 'parent','keyword'));
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
        
        $data = new Cpr_ad_category();
        $data->parent_id = $request->parent_id;
        $data->category_name = $request->category_name;
        $data->description = $request->description;
        $string = preg_replace('/[^A-Za-z0-9\-]/', ' ', $request->category_name);
        $slug = Str::slug($string, '-');
        $data->category_slug = $slug;
        $data->meta_keywords = $slug;
        
        if ($request->hasFile('icon')) {
            $path = public_path('public/category/icon');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file = $request->file('icon');
            $fileName = uniqid() . '_' . trim($file->getClientOriginalName());          
            $file->move($path, $fileName);
            $data->icon = $fileName;
        }
        if ($request->hasFile('banner')) {
            $path = public_path('public/category/banner');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file = $request->file('banner');
            $fileName = uniqid() . '_' . trim($file->getClientOriginalName());          
            $file->move($path, $fileName);
            $data->banner = $fileName;
        }
        $data->save();

        if(isset($request->filter_ids))
        {
            
            foreach($request->filter_ids as $value)
            {
        
                if($value != null)
                {
                    $fil = new Cpr_ad_category_mapped_filter();
                    $fil->category_id = $data->id;
                    $fil->filter_id = $value;
                    $fil->save();
                }
            }
        }
        return redirect(url('ad-category/'.$request->parent_id))->with('success','Category Created Successfully!');
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
        // dd($request->all());
        $data = Cpr_ad_category::find($id);
        $data->parent_id = $request->parent_id;
        $data->category_name = $request->category_name;
        $data->description = $request->description;        
        $string = preg_replace('/[^A-Za-z0-9\-]/', ' ', $request->category_name);
        $slug = Str::slug($string, '-');
        $data->meta_keywords = $slug;
        $data->category_slug = $slug;

        if ($request->hasFile('icon')) {
            $path = public_path('public/category/icon');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file = $request->file('icon');
            $fileName = uniqid() . '_' . trim($file->getClientOriginalName());          
            $file->move($path, $fileName);
            $data->icon = $fileName;
        }
        if ($request->hasFile('banner')) {
            $path = public_path('public/category/banner');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file = $request->file('banner');
            $fileName = uniqid() . '_' . trim($file->getClientOriginalName());          
            $file->move($path, $fileName);
            $data->banner = $fileName;
        }
        $data->save();

        if(isset($request->filter_ids))
        {
            Cpr_ad_category_mapped_filter::where('category_id',$id)->delete();
            foreach($request->filter_ids as $value)
            {
                if($value != null)
                {
                    $fil = new Cpr_ad_category_mapped_filter();
                    $fil->category_id = $data->id;
                    $fil->filter_id = $value;
                    $fil->save();
                }
                
            }
        }
        if(isset($request->back))
        {
            return redirect(url('adCatReport'))->with('success','Category Updated Successfully!');
        }
        return redirect(url('ad-category/'.$request->parent_id))->with('success','Category Updated Successfully!');
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
    public function lowerCat($id)
    {
        $data = Cpr_ad_category::where('parent_id', $id)->orderByDesc('id')->get();
        $parent = $id;
        $parentParent = Cpr_ad_category::find($id);
        $ppp ='';
        $pppp ='';
        if(isset($parentParent))
        {
          if($parentParent->parent_id != 0)
            {
                $ppp = Cpr_ad_category::find($parentParent->parent_id);
                if($ppp->parent_id != 0)
                {
                    $pppp = Cpr_ad_category::find($ppp->parent_id);
                }
            }  
        }
        
        return view('gr.category', compact('data', 'parent','ppp','pppp','parentParent'));
    }
    public function setHome(Request $request)
    {
       $old = Cpr_ad_category::find($request->id);
        if($old->home == 0)
        {
        Cpr_ad_category::where('id',$request->id)->update(['home'=>1]);
            
        }
        else
        {
        Cpr_ad_category::where('id',$request->id)->update(['home'=>0]);
        }
        return true;
    }
    public function createCategary($id)
    {
        $parent = $id;
        $filter = Cpr_ad_filter::orderByDesc('id')->get();
        return view('gr.createCategory', compact('parent', 'filter'));
    }
    public function Category_desable($id,$parent_id)
    {
        Cpr_ad_category::whereId($id)->update(['status'=>0]);
        return redirect(url('ad-category/'.$parent_id))->with('success','Category Desabled Successfully!');
    }
    public function Category_enable($id,$parent_id)
    {
        Cpr_ad_category::whereId($id)->update(['status'=>1]);
        return redirect(url('ad-category/'.$parent_id))->with('success','Category Enabled Successfully!');

    }
    public function category_delete($id,$parent_id)
    {
        Cpr_ad_category::where('parent_id',$id)->delete();
        Cpr_ad_category::whereId($id)->delete();
        return redirect(url('ad-category/'.$parent_id))->with('success','Category Delete Successfully!');
    }
    public function category_edit($id,$parent_id)
    {
        $parent = $parent_id;
        $item = Cpr_ad_category::find($id);
        $selectFile = Cpr_ad_category_mapped_filter::where('category_id',$id)->get();
        $filter = Cpr_ad_filter::orderByDesc('id')->get();
        return view('gr.createCategory', compact('parent', 'filter','item','selectFile'));
    }
    public function service_category_edit($id,$parent_id)
    {
        $parent = $parent_id;
        $back = 'report';
        $item = Cpr_ad_category::find($id);
        $selectFile = Cpr_ad_category_mapped_filter::where('category_id',$id)->get();
        $filter = Cpr_ad_filter::orderByDesc('id')->get();
        return view('gr.createCategory', compact('parent', 'filter','item','selectFile','back'));
    }
    public function apicat()
    {
        $cat = Api_cat::paginate(100);
        $pcat = Cpr_ad_category::where('status',1)->orderBy('category_name','asc')->get();
        return view('gr.apicatreport', compact('cat', 'pcat'));
    }
    public function viewSub(Request $request)
    {
        $data = Cpr_ad_category_mapped_filter::where('category_id',$request->id)->get();
        return response()->json([
            'data' => Cpr_ad_category_mapped_filter::join('cpr_ad_filters','cpr_ad_filters.id','cpr_ad_category_mapped_filters.filter_id')->where('category_id',$request->id)->get()
        ]);
    }
    public function cat_short(Request $request)
    {
        Cpr_ad_category::where('id',$request->id)->update(['sort'=>$request->val]);
        
        return true;
    }
    public function mapCategory(Request $request)
    {
        if($request->mcat == 0)
        {
            Api_cat::where('id',$request->id)->update(['map_cat_id'=>null,'status'=>0]);
        }
        else
        {
            Api_cat::where('id',$request->id)->update(['map_cat_id'=>$request->mcat,'status'=>1]);
            
        }
        
        return true;
    }

}
