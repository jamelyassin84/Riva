<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;
use Stripe;


class StripePayoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function pay_out(Request $request)
    {
        $user = $request->user();

        $stripe = new \Stripe\StripeClient(env('STRIPE_TEST_SECRET_KEY'));

        $seller = Seller::where('user_id', $user->id)->first();

        if ($seller->stripe_id !== null) {
            $stripe->accounts->retrieve(
                $seller->stripe_id,
                []
            );

            return $transfer = \Stripe\Transfer::create([
                "amount" => $request->amount,
                "currency" => "aed",
                "destination" => $seller->stripe_id,
            ]);
        } else {

            $stripe_account = $stripe->accounts->create([
                'type' => 'express',
                'business_profile' => [
                    'name' => $user->name,
                    'support_phone' => $user->phone,
                ],
                'type' => 'express',
            ]);

            // TODO
            // Check if has account links
            $payment = $stripe->accountLinks->create(
                [
                    'account' => $stripe_account->id,
                    'refresh_url' => 'https://www.facebook.com/jamel.bayoneta/',
                    'return_url' => 'https://www.facebook.com/jamel.bayoneta/',
                    'type' => 'account_onboarding',
                ]
            );

            $transfer = \Stripe\Transfer::create([
                "amount"  => $stripe_account->id,
                "currency" => "aed",
                "destination" => "{{CONNECTED_STRIPE_ACCOUNT_ID}}",
            ]);

            return $transfer;
        }
    }
}
