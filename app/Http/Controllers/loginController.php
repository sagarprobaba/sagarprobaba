<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    //
    function submitlogin(Request $request)
    {
        $request->all();
        $ldate = date('d F Y, h:i:s A');
        session()->get('login');
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if(Auth::attempt(array('email' => $request->email, 'password' => $request->password))){
            session()->put('login', $ldate);
            return redirect('dashboard');
        }else{
            session()->flash('error', 'Email Or Password Was Incorect.');
            return redirect('/admin');
        }
    }
    public function logout(Request $request) {
        $request->session()->flush();       
        return redirect('admin');       
    }
}
