<?php

namespace App\Http\Controllers\Admin;

use View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

use App\Contact;

class ContactController extends Controller
{
    public function index()
    {
		$enquiries=Contact::orderby('created_at','DESC')->get();
        // ->paginate(1);

        return view('admin.contact.index',array('items'=>$enquiries));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.contact.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {



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
        $contact=Contact::find($id);


        return view('admin.contact.edit',array('item'=>$contact));

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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::enableQueryLog();

		Contact::Destroy($id);

        $sqls = DB::getQueryLog();
        foreach ($sqls as $sql) {
            (new \App\Http\Controllers\Admin\HomeController)->admin_query_log($sql);
        }
        return Redirect::route('admin_contact')->with('message', 'Successfully Deleted!');

    }
}
