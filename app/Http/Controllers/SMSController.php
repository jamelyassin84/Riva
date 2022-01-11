<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;
use Twilio\Rest\Client as SMS;

class SMSController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public static function send_sms(Request $request)
    {
        $user = $request->user();
        $data = (object) $request->all();
        $user->phone =  self::resolve_phone_number(971, $data->phone);
        $user->save();
        $seller = Seller::where('user_id', $user->id)->first();
        if (empty($seller)) {
            return response('Seller may have been moved or deleted.', 401);
        }
        $client = new SMS(env('TwilioAccountSID'), env('TwilioAuthToken'));
        $verification_code = self::generate_code();
        $client->messages->create(
            self::resolve_phone_number(971, $data->phone),
            [
                'from' => env('TwilioTrialPhoneNumber'),
                'body' => "Your Rive verification code is:"
                    . $verification_code
            ]
        );
        return self::update_seller_verification_code(
            $seller->id,
            $verification_code,
            $user,
        );
    }

    static function resolve_phone_number(int $code, int $phone): string
    {
        return '+' . $code . $phone;
    }

    static function update_seller_verification_code(
        int $id,
        int $verification_code,
        User $user,
    ) {
        $seller = Seller::find($id)->first();
        $seller->verification_code = $verification_code;
        return [
            'seller' => $seller->save(),
            'user' =>   $user,
        ];
    }

    static function generate_code(): int
    {
        $verification_code = [];
        for ($i = 0; $i < 4; $i++) {
            array_push($verification_code,   rand(0, 9));
        }
        return join('', $verification_code);
    }
}
