<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;
use Twilio\Rest\Client as SMS;

class SMSController extends Controller
{
    public static function send_sms(Request $request)
    {
        $data = $request->all();
        $client = new SMS(env('TwilioAccountSID'), env('TwilioAuthToken'));

        $verification_code = self::generate_code();

        return $client->messages->create(
            $data['phone'],
            [
                'from' => env('TwilioTrialPhoneNumber'),
                'body' => "Your Rive verification code is:"
                    . $verification_code
            ]
        );
        self::update_seller_verification_code($data['seller_id'], $verification_code);
    }


    public static function generate_code(): int
    {
        $verification_code = [];
        for ($i = 0; $i < 4; $i++) {
            array_push($verification_code,   rand(0, 9));
        }
        return join('', $verification_code);
    }


    public static function update_seller_verification_code($id, $verification_code): Seller
    {
        $seller = Seller::find($id)->first();
        $seller->verification_code = $verification_code;
        return $seller->save();
    }
}
