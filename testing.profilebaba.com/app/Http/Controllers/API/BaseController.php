<?php


namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

use DB;
use App\VendorLead;

class BaseController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message)
    {
    	$response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, 200,[],JSON_INVALID_UTF8_IGNORE);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    public function checkVendorLead($vendor, $user, $chat_id=0, $call_id=0){
        // print($user);
        // print($vendor);
        // print($call_id);
        DB::enableQueryLog();
        if($chat_id > 0){
            $lead = VendorLead::where(['chat_id'=>$chat_id,'vendor_id'=>$vendor,'vendor_type'=>'vendor'])->whereNotIn('status',['2','3','4'])->get();
            if(count($lead)>0){
                return false;
            }
            else{
                $lead = VendorLead::where(['vendor_id'=>$vendor,'vendor_type'=>'vendor'])->whereNotIn('status',['2','3','4'])->whereNotNull('call_id')->get();
                if($lead){
                    foreach($lead as $l){
                        // print($l->call->user_id);
                        if($user == $l->call->user_id){
                            return false;
                        }
                    }
                }
                return true;
            }
        }
        if($call_id > 0){
            $lead = VendorLead::where(['call_id'=>$call_id,'vendor_id'=>$vendor,'vendor_type'=>'vendor'])->whereNotIn('status',['2','3','4'])->get();
            // print_r(DB::getQueryLog());
            if(count($lead)>0){
                return false;
            }
            else{
                $lead = VendorLead::where(['vendor_id'=>$vendor,'vendor_type'=>'vendor'])->whereNotIn('status',['2','3','4'])->whereNotNull('chat_id')->get();
                if($lead){
                    foreach($lead as $l){
                        // print($l->chat->sender_id);
                        if($l->chat){
                            if($user == $l->chat->sender_id){
                                return false;
                            }
                        }
                    }
                }
                return true;
            }
        }
    }
}
