<?php

namespace App\Http\Controllers\Admin;

use View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\UserReview;
use Hash;
use DB;
use Redirect;
use Mail; 

class UserReviewController extends Controller
{
	
	var $type='review';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct(){

    	View::share('type', $this->type);
    }

    public function index(Request $request) 
    {	
    	$reviews=UserReview::orderby('id','DESC')->paginate(50);

    	return view('admin.review.index',array('items'=>$reviews));
    }









    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	return view('admin.review.create');
    }






    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
    	$review=UserReview::find($id);

    	return view('admin.review.edit',array('item'=>$review));

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
    		'name' => 'required',
    		'email' => 'required|email',
    	]);
    	DB::enableQueryLog();

    	$item = UserReview::find($id);

    	$item->name = $request->name;
    	$item->email = $request->email;
    	$item->rating = $request->rating;
    	$item->massage = $request->massage;
    	$item->status = $request->status;

    	$item->save();

        $sqls = DB::getQueryLog();
        foreach ($sqls as $sql) {
            (new \App\Http\Controllers\Admin\AdminController)->admin_query_log($sql);
        }

    	return \Redirect::route('admin_review_edit',array('id' => $id))->with('message', 'Successfully Updated!');

    }

    public function destroy($id)
    {
        DB::enableQueryLog();

    	UserReview::Destroy($id);

        $sqls = DB::getQueryLog();
        foreach ($sqls as $sql) {
            (new \App\Http\Controllers\Admin\AdminController)->admin_query_log($sql);
        }

    	return Redirect::back()->with('message','Successfully deleted!');

    }
}
