<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\EmailTemplate;
use Illuminate\Http\Request;

class EmailTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // MAIL_DRIVER=sendmail
    // MAIL_HOST=smtp.gmail.com
    // MAIL_PORT=587
    // MAIL_USERNAME=info@thelila.in
    // MAIL_PASSWORD=Abcd@5434#123
    // MAIL_ENCRYPTION=ssl

    public function index()
    {   
        $email_templates = EmailTemplate::all();
        return view('admin.email_templat.index',compact('email_templates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.email_templat.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'email_type' => 'required',
            'email_subject' => 'required',
            'email_body' => 'required',
        ]);

        $requireded = $request->all();

        $requireded['email_body'] = str_replace(url('/'),'base_url',$request->email_body);

        // Store the EmailTemplate
        $emailTemplate = EmailTemplate::create($requireded);

        if ($emailTemplate) {

            return redirect()->route("email-templates.index")->with('success',SAVED_SUCCESSFULLY);

        }
        return back()->with('error',SOMETHING_WENT_WRONG);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function show(EmailTemplate $emailTemplate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response 
     */
    public function edit(EmailTemplate $emailTemplate)
    {   
        $emailTemplate->email_body = str_replace('base_url',url('/'),$emailTemplate->email_body);
        
        return view('admin.email_templat.edit',compact('emailTemplate'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmailTemplate $emailTemplate)
    {

        // dd($request);
        $this->validate($request, [
            'email_type' => 'required',
            'email_subject' => 'required',
            'email_body' => 'required',
        ]);

        $requireded = $request->all();

        $requireded['email_body'] = str_replace(url('/'),'base_url',$request->email_body);

        // Store the EmailTemplate
        $emailTemplate = $emailTemplate->update($requireded);

        if ($emailTemplate) {
            return redirect()->route("email-templates.index")->with('success',UPDATED_SUCCESSFULLY);
        }
        return back()->with('error',SOMETHING_WENT_WRONG);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmailTemplate $emailTemplate)
    {
        // if ($emailTemplate->delete()) {

        //     return redirect()->route("email-templates.index")->with('success',DELETED_SUCCESSFULLY);

        // }
        
        return back()->with('error',SOMETHING_WENT_WRONG);
    }

}
