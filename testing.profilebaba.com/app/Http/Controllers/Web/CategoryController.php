<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Setting;
use App\User;
use App\Category;
use App\Vendor;

use Auth;
use Response;
use Mail;
use Validator;
use Redirect;
use DB;
use Image;
use Hash;
use App\Classes\GeniusMailer;
use Laravel\Socialite\Facades\Socialite;

use Softon\Indipay\Facades\Indipay;

class CategoryController extends Controller {

    function category_list(Request $request){
        $slug=$request->slug;
        $cid=$request->cid;
        $name=$request->name;
        $area = urldecode($request->search_title);
        $loc = ($area == '') ? "" : " in ".$area;
        $sname = $slug ?? $name;
        $title = $sname.$loc;
        // echo "slug==".$slug;
        // echo "cid==".$cid;
        // echo "name==".$title; die;

        $category = Category::where('slug', $slug)->first();
        if ($cid) {
            $category = Category::where('id', $cid)->first();
        }
        $cid=$category->id ?? '';

        $setting=new Setting;
        $per_page=$setting->get_setting('category_listing_per_page');

        DB::enableQueryLog();

        $query = Vendor::where(['vendor.email_verification'=>'1', 'vendor.status'=>'1']);

        if($cid != '') {
            $query->join('vendor_categories','vendor_categories.vendor_id','=','vendor.id')
            ->where('vendor_categories.category_id','=',$cid);
        }
        if($area != '') {
            $query->join('vendor_contact_info','vendor_contact_info.vendor_id','=','vendor.id')
            ->where('vendor_contact_info.area','like', "%".$area."%");
        }
        if($name != '') {
            $query->where('vendor.business_name','like', "%".$name."%");
        }
        $category_data = $query->orderby('vendor.business_name','ASC')->groupBy('vendor.id')->paginate($per_page);

        if ($cid) {
            $categories_filter=Category::where('parent_id',$cid)->orderby('title','ASC')->get();
        }else{
            $categories_filter=Category::where('parent_id', 0)->orderby('title','ASC')->take(18)->get();
        }
        // print_r($category_data);die;

        if($request->ajax()){

            $view = view('includes.vendor_list_loop',compact('category_data'))->render();
            $pagination_data = $category_data;
            $pagination_html = view('includes.pagination',compact('pagination_data'))->render();

            return response()->json([
                'data' => $view,
                'pagination_html' => $pagination_html,
                'category_title' => $category->title ?? 'All category',
            ]);

        }else{

            return view('vendor_list',array(
                'category_data'=>$category_data,
                'category_title' => $category->title ?? 'All category',
                'category' => $category,
                'categories_filter' => $categories_filter,
                'title' => $title
            ));

        }

    }

    function all_category(){

        $categories = Category::where('parent_id', 0)->get();
        return view('all_category', array('categories' => $categories));
    }

    function category_filter(Request $request){
        $search_title = $request->title;
        if(strpos($search_title, " in ") != false){
            $title = explode(" in ", $search_title);
        }
        else if(strpos($search_title, " near ") != false){
            $title = explode(" near ", $search_title);
        }
        else{
            $title[0] = $search_title;
        }

        $setting = new Setting;
		$per_page = $setting->get_setting('category_listing_per_page');

		$items = array();

        $category_title = $title[0];
        DB::enableQueryLog();
        $searchQuery=Category::
        when($category_title, function ($query) use ($category_title) {
            return $query->where('title', 'like', '%' . $category_title . '%');
        });

        if(array_key_exists(1, $title) && $title[1] != ""){
            $searchQuery->join('vendor_categories','vendor_categories.category_id','=','category.id')
            ->join('vendor_contact_info','vendor_categories.vendor_id','=','vendor_contact_info.vendor_id')
            ->where('vendor_contact_info.area','like', '%'.$title[1].'%');
        }

        $datas = $searchQuery->orderby('category.title','ASC')->distinct()->paginate($per_page);

        $per_page = ((int)$per_page - $datas->count());
        // dd(DB::getQueryLog());
        // print_r($datas);die;
        foreach ($datas as $data) {
            $name = $data->title;
            if(array_key_exists(1, $title) && $title[1] != ""){
                $name = $data->title." (".$data->area.")";
            }
			$items[] = ['name' => $name, 'cid' => $data->id, 'html_url' => route('vendor_filter_search', ["slug"=>$data->slug, "search_title"=>urlencode($data->area)])];
		}


		if($per_page >= 1){
            //search as business name
    		$searchQuery = Vendor::where(['vendor.status'=>'1'])

            ->when($category_title, function ($query) use ($category_title) {
                return $query->where('vendor.business_name', "like","%" . $category_title . "%");
            });

            if(array_key_exists(1, $title) && $title[1] != ""){
                $searchQuery->join('vendor_contact_info', 'vendor_contact_info.vendor_id', '=', 'vendor.id')
                ->where('vendor_contact_info.area','like', '%'.$title[1].'%');
            }
            $categories = $searchQuery->orderby('vendor.business_name','ASC')->groupBy('vendor.id')->paginate($per_page);

            foreach ($categories as $category) {

                $business = $category->business_name;
                $name = $business;
                if(array_key_exists(1, $title) && $title[1] != ""){
                    $name = $business." (".$category->area.")";
                }
    			$items[] = ['name' => $name, 'userid' => $category->id, 'title' => $search_title, 'html_url' => route('vendor.details', $category->slug)];
    		}

            //search in both category and location
            $searchQuery = Vendor::where(['vendor.status'=>'1'])

            ->when($category_title, function ($query) use ($category_title) {
                return $query->join('vendor_contact_info', 'vendor_contact_info.vendor_id', '=', 'vendor.id')
                ->where('vendor_contact_info.area','like', '%'.$category_title.'%');;
            });

            $categories = $searchQuery->orderby('vendor.business_name','ASC')->groupBy('vendor.id')->paginate($per_page);
            // print_r($categories);die;
            foreach ($categories as $category) {

                $business = $category->business_name;
                $name = $business." (".$category->area.")";
    			$items[] = ['name' => $name, 'userid' => $category->id, 'title' => $search_title, 'html_url' => route('vendor.details', $category->slug)];
    		}
		}
        // print_r($items);die;
        $tempArr = array_unique(array_column($items, 'userid'));
        $items = array_intersect_key($items, $tempArr);
        $tempArr = array_unique(array_column($items, 'name'));
        $items = array_intersect_key($items, $tempArr);

		return response()->json(['items' => $items]);
    }

    function vendor_details(Vendor $user){
        // print_r($user);die;

        if (request()->admin!='admin') {
            $user = Vendor::where('vendor.slug',$user->slug)->where(['vendor.status'=>'1'])->first();
        }
        if (!$user) {
            $user = Vendor::where('slug',$user->slug)->where(['vendor.status'=>'1'])->first();
        }
        // print_r($user);die;

        return view('vendor_details', array('user' => $user));
    }

    function vendor_review_submit(Request $request) {

        $records = $request->all();
        $records['ip'] = $request->ip();

        if (\App\VendorRating::create($records)) {
            return 1;
        }
    }


}
