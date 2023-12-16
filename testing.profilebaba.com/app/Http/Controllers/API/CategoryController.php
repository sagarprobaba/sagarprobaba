<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\SMSController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Validator;
use Session;
use Hash;

use App\Category;
use Illuminate\Contracts\Session\Session as SessionSession;

class CategoryController extends BaseController
{

    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }

    public function category_list() {
        $parent = Category::where(['show_in_mobile'=>'1', 'status'=>'1', 'parent_id'=>'0'])->with('child',function ($query) {
            $query->where(['status'=>'1']);
        })->orderby('priority','ASC')->get();
        $response = array();
        foreach($parent as $i=>$val){
            $response[$i]['id'] = $val->id;
            $response[$i]['title'] = $val->title;
            $response[$i]['slug'] = $val->slug;
            $response[$i]['icon'] = env('APP_URL')."/uploads/category/".$val->mobile_icon;
            $sub = $val->child;
            foreach($sub as $s){
                $s['mobile_icon'] = env('APP_URL')."/uploads/category/".$s->mobile_icon;
            }
            $response[$i]['sub-catgeories'] = $sub;
        }
        if($response){
            return $this->sendResponse($response, 'Catgeories Found!!');
        }
        else{
            return $this->sendError('Error.', ['error'=>'Something went wrong, Try Again!!']);
        }
    }

    public function get_category_list() {
        $response = Category::select('id','title')->where(['status'=>'1'])->orderby('title','ASC')->get();
        // $response = array();
        // foreach($parent as $i=>$val){
        //     $response[$i]['id'] = $val->id;
        //     $response[$i]['title'] = $val->title;
        //     // $response[$i]['icon'] = env('APP_URL')."/uploads/category/".$val->mobile_icon;
        //     // $response[$i]['sub-catgeories'] = $val->child;
        // }
        if($response){
            return $this->sendResponse($response, 'Catgeories Found!!');
        }
        else{
            return $this->sendError('Error.', ['error'=>'Something went wrong, Try Again!!']);
        }
    }

    public function get_subcategory($id) {
        $parent = Category::where(['status'=>'1', 'parent_id'=>$id])->orderby('title','ASC')->get();
        $response = array();
        foreach($parent as $i=>$val){
            $response[$i]['id'] = $val->id;
            $response[$i]['title'] = $val->title;
            $response[$i]['icon'] = env('APP_URL')."/uploads/category/".$val->mobile_icon;
        }
		
		//echo '<pre>'; print_r($response); die;
        return $this->sendResponse($response, 'Sub-Catgeories Found!!');
    }
}