<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;

use DB;
use Image;
use Hash;
use Mail;

use App\Http\Controllers\SMSController;
use App\Classes\GeniusMailer;

class UserController extends Controller
{
	function user_filter(){
		$request = request();

		$name=$request->name;
		$email=$request->email;
		$phone=$request->phone;

		$form = $request->form;
		$to = $request->to;

		return User::

		when($name, function ($query) use ($name) {
			return $query->where('users.name', "like","%" . $name . "%");
		})
		->when($email, function ($query) use ($email) {
			return $query->where('users.email', "like","%" . $email . "%");
		})
		->when($phone, function ($query) use ($phone) {
			return $query->where('users.contact_number', "like","%" . $phone . "%");
		})
		->when($form, function ($query) use ($form,$to) {
			if (!$form) {
				return $query->whereDate('users.created_at', $to);
			}
			if (!$to) {
				return $query->whereDate('users.created_at', $form);
			}
			return $query->whereBetween('users.created_at', [$form,$to]);
		});
	}

	public function index(Request $request)
	{
		$items = $this->user_filter()->orderby('users.id','DESC')->paginate(20);

		$total_users = $items->total();
		$pagination_data = $items;

		if($request->ajax()){

			$view = view('admin.user.user_include',compact('items'))->render();
			$pagination_html = view('includes.pagination',compact('pagination_data'))->render();
			
			return response()->json([
				'total_users' => $total_users,
				'data' => $view,
				'pagination_html' => $pagination_html,
			]);

		}else{
			return view('admin.user.index',array('items'=>$items,'total_users' => $total_users));
		}

	}

	public function create()
	{
		return view('admin.user.create');
	}


	public function store(Request $request)
	{	
		DB::enableQueryLog();

		$item = new User;
		
		$this->validate($request, [
            'name' => 'required',
			'email' => 'required|unique:users,email',
            'password' => 'required',
            'contact_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:users,contact_number',
		]);

        $records = $request->all();

        if ($request->hasFile('profile_photo')) {
			if ($request->file('profile_photo')->isValid()) {

				$fileName=$request->file('profile_photo')->getClientOriginalName();
				$fileName =time()."_".$fileName;

				//upload
				$image = $request->file('profile_photo');
				$directory = base_path('/uploads/users/');
				$imageUrl = $directory.$fileName;

				Image::make($image)->resize(300, 300)->save($imageUrl);
				$records['profile_photo']=$fileName;
			}
		}
		if($request->password!=''){
			$records['password']=Hash::make($request->password);
		}else{
			unset($records['password']);
		}
        $item->fill($records);
		$item->save();

		return \Redirect::route('admin.user.business_location',$item->id)->with('message', 'Added Successfully ! ');
	}

	public function show($id)
	{
	}

	public function edit($id)
	{
		$item = User::find($id);
		$item->password = '';
		// print_r($item);
		return view('admin.user.edit',compact(
			'item'
		));
	}



	public function update(Request $request, $id)
	{	
		
		$item = User::find($id);

		$this->validate($request, [
            'name' => 'required',
            // 'email' => 'required|email|unique:users,email,'.$id.',id',
            // 'father_name' => 'required',
            // 'country' => 'required',
            // 'state' => 'required',
            // 'district' => 'required',
            // 'village' => 'required',
            // 'mother_name' => 'required',
            // 'gender' => 'required',
            // 'blood_group' => 'required',
            // 'profile_photo' => 'required',
            // 'religion' => 'required',
            // 'marital_status' => 'required',
            // 'my_aim' => 'required',
            // 'my_slogen' => 'required',
            // 'highest_ualification' => 'required',
            // 'whatsapp_mumber' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'contact_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:users,contact_number,'.$id.',id',
            // 'landline_number' => 'required',
            // 'current_address' => 'required',
            // 'permanent_address' => 'required',
            // 'describe_your_self' => 'required',
            // 'Designation' => 'required',
            // 'personal_google_location' => 'required',
		]);

		DB::enableQueryLog();

        $records = $request->all();

        if ($request->hasFile('profile_photo')) {
			if ($request->file('profile_photo')->isValid()) {

				$fileName=$request->file('profile_photo')->getClientOriginalName();
				$fileName =time()."_".$fileName;

				//upload
				$image = $request->file('profile_photo');
				$directory = base_path('/uploads/users/');
				$imageUrl = $directory.$fileName;

				Image::make($image)->resize(300, 300)->save($imageUrl);
				$records['profile_photo']=$fileName;
			}
		}
		if($request->password!=''){
			$records['password']=Hash::make($request->password);
		}else{
			unset($records['password']);
		}

        $item->fill($records);
		$item->save();

		$sqls = DB::getQueryLog();
		foreach ($sqls as $sql) {
			(new \App\Http\Controllers\Admin\HomeController)->admin_query_log($sql);
		}

		return \Redirect::route('admin_user_edit',array('user' => $id))->with('message', UPDATED_SUCCESSFULLY);
	}

	public function destroy($id)
	{
		DB::enableQueryLog();

		User::Destroy($id);

		// foreach ($sqls as $sql) {
		// 	(new \App\Http\Controllers\Admin\AdminController)->admin_query_log($sql);
		// }

		return \Redirect::route('admin_user')->with('message', 'Successfully Deleted!');
	}
}
