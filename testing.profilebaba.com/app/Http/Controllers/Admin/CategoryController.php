<?php
 
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Firebase;

use App\Category;
use Image;
use File;
use Redirect;
use App\Setting;
use App\Admin;

class CategoryController extends Controller
{
    use Firebase;
    /**
     * Display a listing of the resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $setting = new Setting;
		$per_page = $setting->get_setting('category_listing_per_page');

        $title = $request->title;
        $parent = $request->parent;
        
        $items=Category::
        when($title, function ($query) use ($title) {
            return $query->where('title', 'like', '%' . $title . '%');
        })
        ->when($parent, function ($query) use ($parent) {
            return $query->where('parent_id', $parent);
        })
        ->orderby('title','ASC')->distinct()->paginate($per_page);

		return view('admin.category.index',array('items'=>$items));
		
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
			$categories= Category::where('parent_id',0)->orderby('title','ASC')->get();
      
			return view('admin.category.create',array('categories'=>$categories));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
			// dd($request->all());
		$records=$request->all();

        if (!empty($request->file('mobile_icon'))) {

            // $this->validate($request, [

            //     'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',

            // ]);

            $image = $request->file('mobile_icon');

            $input = time().'.'.$image->getClientOriginalExtension();

            $destinationPath = base_path(CATEGORY_IMAGE);

            $image->move($destinationPath, $input);

            $records['mobile_icon'] = $input;

        }
		
		if (!empty($request->file('category_image'))) {

            // $this->validate($request, [

            //     'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',

            // ]);

            $image = $request->file('category_image');

            $input = time().'.'.$image->getClientOriginalExtension();

            $destinationPath = base_path(CATEGORY_IMAGE);

            $image->move($destinationPath, $input);

            $records['category_image'] = $input;

        }
		
		
		$category = Category::create($records);

        $fcmNotification = [
            'to' => Admin::find(1)->token,
            'notification' => ['category_id'=>$category->id, 'created_date'=>$category->created_at],
            'data' => ['message'=>'Category Added']
        ];
        $this->firebaseNotification($fcmNotification);

		return \Redirect::route('admin_category')->with('message', 'Added Successfully ! '); 

		
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
		$item=Category::find($id);
		
        return view('admin.category.edit',array('item'=>$item));
		 
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
        $this->validate($request, [
			'title' => 'required',
 		]); 
		  
		   
		$item = Category::find($id);
 		  
		$item->title = $request->title;
		$item->slug = $request->slug;
		$item->status = $request->status;
		$item->parent_id = $request->parent_id;
        $item->show_in_mobile = $request->show_in_mobile == '' ? '0' : '1';
        
		$item->meta_title = $request->meta_title;
		$item->meta_keyword = $request->meta_keyword;
		$item->meta_desc = $request->meta_description;		
		$item->priority = $request->priority;
		  
		$oldimg = base_path(CATEGORY_IMAGE.$item->category_image);
        
        if (!empty($request->file('category_image'))) {
            if(File::exists($oldimg)) {
                File::delete($oldimg);
            }
            // $this->validate($request, [
            //     'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            // ]);
            $image = $request->file('category_image');
            $input = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = base_path(CATEGORY_IMAGE);
            $image->move($destinationPath, $input);

			$item->category_image = $input;

        }

        $oldimg = base_path(CATEGORY_IMAGE.$item->mobile_icon);
        if (!empty($request->file('mobile_icon'))) {
            if(File::exists($oldimg)) {
                File::delete($oldimg);
            }
            // $this->validate($request, [
            //     'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            // ]);
            $image = $request->file('mobile_icon');
            $input = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = base_path(CATEGORY_IMAGE);
            $image->move($destinationPath, $input);

			$item->mobile_icon = $input;

        }
		
		
        $item->save();

        // $fcmNotification = [
        //     'notification' => ['category_id'=>$item->id, 'created_date'=>$item->created_at],
        //     'data' => ['message'=>'Category Added']
        // ];
        // $this->firebaseNotification($fcmNotification);

            // redirect
        return Redirect::route('admin_category')->with('message', 'Successfully Updated!');
		  
		  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {	
    	$item = Category::find($id);

        $oldimg = base_path(CATEGORY_IMAGE.$item->category_image);

        if(File::exists($oldimg)) {

            File::delete($oldimg);

        }
        Category::Destroy($id);
	   	return Redirect::route('admin_category')->with('message', 'Successfully Deleted!');
    }

    public function category_list(Request $request)
    {	
    	$item = Category::where('title','like','%' . $request->category . '%')->get();
        return $item;
    }
	
	
}
