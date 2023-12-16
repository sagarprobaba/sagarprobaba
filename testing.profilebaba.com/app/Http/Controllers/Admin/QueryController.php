<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Validator;
use Session;
use Hash;

use App\User;
use App\Vendor;
use App\VendorCategory;
use App\VenderContactInformation;
use App\VendorServiceLocation;
use App\VendorRating;
use App\QueryForVendor;
use App\Traits\Firebase;
use Illuminate\Contracts\Session\Session as SessionSession;

class QueryController extends Controller
{
    use Firebase;
    
    public function index(Request $request) {
        $page = $request->records_per_page ?? 0;
        $per_page = [50,10,20,50,100,150,200,250];
        $page = $per_page[$page];

        if(session('id') == 1){
            $query = $this->query_filter()->orderBy('query_for_vendor.id','desc')->paginate($page);
        }
        else{
            $query = $this->query_filter()->where('query_for_vendor.assigned_to',session('id'))->orderBy('query_for_vendor.id','desc')->paginate($page);
        }
        $total_users = $query->total();

        if($request->ajax()){

			$view = view('admin.query.vendor',compact('query'))->render();
			
			return response()->json([
                'total_users' => $total_users,
				'data' => $view,
			]);

		}else{
            return view('admin.query.index',array('query'=>$query,'total_users' => $total_users));
		}
    }

    public function show_assign($id) {
        $items = QueryForVendor::find($id);
        return view('admin.query.assign',array('query'=>$items));
    }

    public function assign_query(Request $request) {
        $items = QueryForVendor::find($request->query_id);
        $items['assigned_to'] = $request->assigned_to;
        $items['status'] = '1';
        $items->save();

        $data = [
            "to" => $items->assigned->device_key,
            "notification" => [
                "title" => "Assigned a New Query",
                "body" => [
                    "message" => "New Query from ".$items->user->name,
                    "chat" => $items->id,
                    "type" => "query"
                ]
            ]
        ];
        $this->firebaseNotification($data);

        $items = QueryForVendor::get();
        return view('admin.query.index',array('query'=>$items));
    }

    public function query_filter() {
        $request = request();

		$name=$request->name;
		$category=$request->category;
		$count=$request->response_count ?? 0;
        $response = [10000,10,20,50,100,150,200,250];
        $count = $response[$count];

		return QueryForVendor::

		when($name, function ($query) use ($name) {
			return $query->join('users','users.id','query_for_vendor.user_id')->where('users.name', "like","%" . $name . "%");
		})
		->when($category, function ($query) use ($category) {
			return $query->join('category','category.id','query_for_vendor.category_id')->where('category.title', "like","%" . $category . "%");
		})
		->when($count, function ($query) use ($count) {
			return $query->where('query_for_vendor.response_count', "<",$count);
		});
    }
}