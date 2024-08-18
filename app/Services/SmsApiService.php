<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SmsApiService
{
    public function api_curl_sms_service_data($number = '', $value = '')
    {
        $user_name = Auth::user()->name;
        $message = "You Have a New Task for $value, Create By $user_name . Please Check Your Portal Thanks.";
        $msg = rawurlencode($message);
        $phone = $number;
        $contacts = substr($phone, -11);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://portal.metrotel.com.bd/smsapi?api_key=C200244065561bc0522457.35758066&type=text&contacts=' . $contacts . '&senderid=8809612117722&msg=' . $msg . '&label=transactional',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        curl_close($curl);
       return $response;
    }
}
