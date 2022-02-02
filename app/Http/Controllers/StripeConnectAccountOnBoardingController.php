<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;
use Stripe\Exception\ApiErrorException;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class StripeConnectAccountOnBoardingController extends Controller
{
    public function on_board(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_TEST_SECRET_KEY'));

        $data = (object) $request->all();

        $user = $data->user;

        $user = User::where('id', $user)->first();

        $seller = Seller::where('user_id', $user->id)->first();

        if (!$seller->completed_account_onboarding) {

            if (isNull($seller->stripe_id)) {
                try {
                    $account =  $stripe->accounts->create([
                        // 'email' => $user->email,
                        'business_profile' => [
                            'name' => $user->name,
                            'support_phone' => $user->phone,
                        ],
                        'type' => 'express',
                    ]);

                    $seller->update([
                        'stripe_id' => $account->id
                    ]);

                    $seller->fresh();
                } catch (ApiErrorException $error) {
                    return response($error, 500);
                }
            }

            $onboard_link = $stripe->accountLinks->create(
                [
                    'account' => $seller->stripe_id,
                    'refresh_url' => env('FRONT_END_BASE_URL') . $data->amount . '/' . $data->user,
                    'return_url' => env('FRONT_END_BASE_URL') . $data->amount . '/' . $data->user,
                    'type' => 'account_onboarding',
                ]
            );

            return [
                'url' => $onboard_link->url
            ];
        }

        $login_link = $stripe->accounts->createLoginLink($seller->stripe_id);

        return [
            'url' => $login_link->url
        ];
    }

    public function transfer_payment(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_TEST_SECRET_KEY'));

        $data = (object)  $request->all();

        try {
            return \Stripe\Transfer::create([
                "amount"  => $data->amount,
                "currency" => "aed",
                "destination" => $data->stripe_id,
            ]);
        } catch (ApiErrorException $error) {
            return response($error, 500);
        }
    }
}
