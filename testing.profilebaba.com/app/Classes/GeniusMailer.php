<?php
/**
 * Created by PhpStorm.
 * User: ShaOn
 * Date: 11/29/2018
 * Time: 12:49 AM
 */

namespace App\Classes;

use App\EmailTemplate;
use PDF;
use Illuminate\Support\Facades\Mail;
use Config;

class GeniusMailer
{

    public function __construct()
    {
        // $gs = Generalsetting::findOrFail(1);
        // Config::set('mail.host', $gs->smtp_host);
        // Config::set('mail.port', $gs->smtp_port);
        // Config::set('mail.encryption', $gs->email_encryption);
        // Config::set('mail.username', $gs->smtp_user);
        // Config::set('mail.password', $gs->smtp_pass);
    }

    public function sendCustomMail(array $mailData)
    {
        $data = [
            'email_body' => $mailData['body']
        ];

        $objDemo = new \stdClass();
        $objDemo->to = $mailData['to'];
        $objDemo->subject = $mailData['subject'];

        try{
            Mail::send('admin.email_templat.mailbody',$data, function ($message) use ($objDemo) {
                $message->to($objDemo->to);
                $message->subject($objDemo->subject);
            });
        }
        catch (\Exception $e){
            die($e->getMessage());
            // return $e->getMessage();
        }
        return true;
    }

    public function sendAutoMail(array $mailData)
    {

        $temp = EmailTemplate::where('email_type','=',$mailData['type'])->first();

        $body = preg_replace("/{url}/", url('/') ,$temp->email_body);
        $body = preg_replace("/{otp}/", $mailData['otp'] ?? '' ,$body);
        $body = preg_replace("/{user_name}/", $mailData['user_name'] ?? '' ,$body);
        $body = preg_replace("/{email}/", $mailData['email'] ?? '' ,$body);
        $body = preg_replace("/{email_verify_link}/", $mailData['email_verify_link'] ?? '' ,$body);

        $body = preg_replace("/{name}/", $mailData['name'] ?? '' ,$body);
        $body = preg_replace("/{email}/", $mailData['email'] ?? '' ,$body);
        $body = preg_replace("/{mobile}/", $mailData['mobile'] ?? '' ,$body);
        $body = preg_replace("/{message}/", $mailData['message'] ?? '' ,$body);

        $data = [
            'email_body' => $body
        ];

        $objDemo = new \stdClass();
        $objDemo->to = $mailData['to'];
        $objDemo->subject = $temp->email_subject;

            Mail::send('admin.email_templat.mailbody',$data, function ($message) use ($objDemo) {
                $message->to($objDemo->to);
                $message->subject($objDemo->subject);
            });
        try{
        }
        catch (\Exception $e){
            //die("Not Sent!");
        }
    }

}