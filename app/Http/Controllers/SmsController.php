<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SmsController extends Controller
{
    public function sendTestSms()
    {
        $response = Http::timeout(30)
            ->acceptJson()
            ->post('https://nimbusit.biz/Api/smsapi/SendSms', [

                'UserId' => 'himrishteybiz',

                'Password' => 'vqbj8362VQ',

                'SenderID' => 'HIMRMB',

                'Phno' => '8580858469',

                'Msg' => '24774 is the OTP to login your himrishtey account.',

                'EntityID' => '1701164189692214854',

                'TemplateID' => '1707166088646916717',

                'DlrUrl' => '',

                'FlashMsg' => 0,

                'CampaignName' => 'HimRishtey',
            ]);

        return response()->json([
            'success' => $response->successful(),
            'status' => $response->status(),
            'response' => $response->body(),
        ]);
    }
}
