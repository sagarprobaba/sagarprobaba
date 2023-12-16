<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Cmspages;
use App\Classes\GeniusMailer;

class PageController extends Controller
{ 
    function index(request $request){
	    
		return view('index');
	}
	
	function page(Cmspages  $Cmspages){
  		
		return view('page', array('page'=>$Cmspages));	 
	}
    
    function contact_us_submit(Request $request) {
        
        $this->validate($request, [
            'f_name' => 'required',
            'l_name' => 'required',
			'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'message' => 'required',
        ]);

        $records = $request->all();
        
        //Sending Email To contact_us_submit
        if($request->email){
            $to = $request->email;
            $data = [
                'to' => $to,
                'type' => 'contact_us_submit',
                'name' => $request->f_name .' '.$request->l_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'message' => $request->message,
            ];
            $mailer = new GeniusMailer();
            $mailer->sendAutoMail($data);
        }

        if (\App\Contact::create($records)) {
            echo 1;
        }
    }
}