<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Admin;
use App\AdminLog;
use App\Chat;

use DB;
use Hash;
use Route;
use Validator;
use Redirect;
use View;


class HomeController extends Controller{

    var $type= array(
        'title' => 'Admin',
        'titles' => 'Admins',
        'route_pr' => 'admin.',
    );

    function __construct(){
        View::share('type', $this->type);
    }

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginate = $request->paginate ?? 20;

        $datas = Admin::paginate($paginate);
        return view('admin.admin.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request_data = $request->all();

        $Admin = new Admin;

		if ($request->hasFile('photo')) {
			if ($request->file('photo')->isValid()) {
				$fileName=$request->file('photo')->getClientOriginalName();
				$fileName =time()."_".$fileName;
				//upload
				$request->file('photo')->move('uploads/admin/photo', $fileName);

				//column name
				$request_data['profile_pic']=$fileName;
			}
		}
		if($request->password!=''){
			$hashed_password=Hash::make($request->password);
			$request_data['password']=$hashed_password;
		}else{
			unset($request_data['password']);
		}

        $Admin->fill($request_data);

        if ($Admin->save()){

            return redirect()->route($this->type['route_pr']."index")->with('message',SAVED_SUCCESSFULLY);

        }
        return back()->with('error',SOMETHING_WENT_WRONG);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $Admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $Admin)
    {
        // dd($Admin);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $Admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $Admin)
    {
        $data = $Admin;
        return view('admin.admin.edit',compact('data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $Admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        $request_data = $request->all();

		if ($request->hasFile('photo')) {
			if ($request->file('photo')->isValid()) {
				$fileName=$request->file('photo')->getClientOriginalName();
				$fileName =time()."_".$fileName;
				//upload
				$request->file('photo')->move('uploads/admin/photo', $fileName);

				//column name
				$request_data['profile_pic']=$fileName;
			}
		}
		if($request->password!=''){
			$hashed_password=Hash::make($request->password);
			$request_data['password']=$hashed_password;
		}else{
			unset($request_data['password']);
		}

        $admin->fill($request_data);

        if ($admin->save()){
            return redirect()->route($this->type['route_pr']."index")->with('message',UPDATED_SUCCESSFULLY);
        }
        return back()->with('error',SOMETHING_WENT_WRONG);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $Admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $Admin)
    {
        if ($Admin->delete()) {
            return redirect()->route($this->type['route_pr']."index")->with('message',DELETED_SUCCESSFULLY);
        }

        return back()->with('error',SOMETHING_WENT_WRONG);
    }

	function login(){
		return view('admin.index');
	}

	function login_save(request $request){

		$username=$request->username;
		$password=$request->password;

		$this->validate($request, [
			'username' => 'required',
			'password'=>'required',
		]);

		$results = Admin::where('username', $username)->first();

		if($results){

			if (Hash::check($password,$results->password)){

				$request->session()->put('is_admin_logged', 'yes');
				$request->session()->put('id',$results->id);
				return Redirect::route('admin_home')->with('message', 'Success!');
			}else{

				return Redirect::route('admin')->with('message', 'Invalid Password!');
			}

		}else{
			return Redirect::route('admin')->with('message', 'Invalid Username/Password !');
		}
	}

    public function saveToken(Request $request)
    {   
        $admin = Admin::find(session('id'));
        $admin['device_key'] = $request->fcm_token;
        $admin->save();
        return response()->json(['token saved successfully.']);
    }

	function logout(request $request){
		$request->session()->forget('is_admin_logged');
		return \Redirect::route('admin')->with('message', 'Successfully Logged Out!');
	}

	function home(request $request){
		return view('admin.home');
	}

	function profile(request $request){
		$aid=$request->session()->get('id');

		$admin=Admin::find($aid);

		return view('admin.profile',array('admin'=>$admin));
	}

	public function profile_update(Request $request, $aid)
	{
		$this->validate($request, [
			'name' => 'required',
			'email' => 'required',
			'password'=>'sometimes|nullable|min:5'
		]);

		$item = Admin::find($aid);

		if ($request->hasFile('photo')) {
			if ($request->file('photo')->isValid()) {
				$fileName=$request->file('photo')->getClientOriginalName();
				$fileName =time()."_".$fileName;
				//upload
				$request->file('photo')->move('uploads/admin/photo', $fileName);

				//column name
				$item->photo=$fileName;
			}
		}

		// store
		$item->name  = $request->name;
		$item->email = $request->email;
        $item->username = $request->username;

		if($request->password!=''){
			$hashed_password=Hash::make($request->password);
			$item->password=$hashed_password;
		}
		$item->save();

        // redirect
		return Redirect::back()->with('message','Successfully Updated!');
	}


    function admin_query_log($sql){
        $current_url = url()->current();

        $query = str_replace(array('?'), array('\'%s\''), $sql['query']);
        $query = vsprintf($query, $sql['bindings']);

        $admin_log = new AdminLog;

        $admin_log->admin_id = session('aid') ?? 1;
        $admin_log->log = $query;
        $admin_log->url = $current_url;

        $admin_log->save();

    }

    function admin_log($admin_id){
        $admin_logs = AdminLog::where('admin_id', $admin_id)->paginate(20);
        return view('admin.admin.admin_logs',array('admin_logs'=>$admin_logs));
    }
    function admin_log_delete($id){
        AdminLog::where('id', $id)->delete();
        return redirect()->back()->with('message',DELETED_SUCCESSFULLY);
    }

    public function assign_query(Request $request) {
        
        $chat = Chat::find($request->chat_id);
        return route('admin.assignChat.assign',$request->chat_id);
        
    }

}
