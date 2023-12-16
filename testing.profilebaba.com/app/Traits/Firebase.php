<?php


namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait Firebase
{

    public  function firebaseNotification($fcmNotification){

        $fcmUrl = config('firebase.fcm_url');

        $apiKey = config('firebase.fcm_api_key');

        $dataString = json_encode($fcmNotification);
    
        $headers = [
            'Authorization: key=' . $apiKey,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
      
        curl_setopt($ch, CURLOPT_URL, $fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
               
        $response = curl_exec($ch);
  
        // dd($response);
        // print_r($response);
    }
}