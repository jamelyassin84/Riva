<?php

namespace App\Http\Controllers;

use App\Models\ShippingInformation;
use App\Http\Requests\UpdateShippingInformationRequest;
use App\Models\Buyers;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\StripeClient;

class ShippingInformationController extends Controller
{

    protected StripeClient $stripe;

    public function stripeProcess()
    {

        // return  $stripe->accounts->create(['type' => 'express']);
    }

    public function store(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));


        return $stripe->accountLinks->create(
            [
                'account' => env('RIVE_STRIPE_ACCOUNT_ID'),
                'refresh_url' =>  env('STRIPE_REFRESH_URL'),
                'return_url' =>  env('STRIPE_RETURN_URL'),
                'type' => 'account_onboarding',
            ]
        );



        // $data = $request->all();

        // $address = [
        //     'city' => $data['city'],
        //     'line1' => $data['address'],
        //     'line2' => $data['landMark'],
        //     'postal_code' => $data['zipCode'],
        //     'state' => $data['city'],
        // ];


        // if ($data['product']['discounted_price']  > 2) {
        // }



        // $buyer = Buyers::where('phone', $data['mobile'])->first();

        // $token =  $this->stripe->tokens->create(['card' => $data['card_token']]);

        // return $this->stripe->accounts->create([
        //     'country' => 'AE',
        //     'type' => 'express',
        //     'email' =>  $data['email'],
        // ]);

        // if (empty($buyer)) {

        //     return $this->stripe->accounts->create([
        //         'country' => 'AE',
        //         'type' => 'express',
        //         'email' =>  $data['email'],
        //     ]);

        // $buyer =  $this->stripe->customers->create([
        //     'description' => $data['name'],
        //     'email' => $data['email'],
        //     'name' => $data['name'],
        //     'phone' => $data['mobile'],
        //     'shipping' => [
        //         'address' => $address,
        //         'name' => $data['name'],
        //         'phone' => $data['mobile'],
        //     ],
        //     'address' =>  $address,
        // ]);
        // Buyers::save_buyer($buyer, $data);
        // }

        // $buyer = Buyers::where('phone', $data['mobile'])->first();

        // $charge = $this->stripe->charges->create([
        //     'amount' => 2000,
        //     'currency' => $data['product']['currency'],
        //     'source' =>  $token,
        //     'description' => 'Charge for ' . $data['product']['product_name'],
        // ]);

        // if ($charge['status'] !== 'succeeded') {
        //     return 'Error';
        // }

        // return 'Saved';
    }



    public function show(Request $shippingInformation)
    {
        //
    }

    public function update(UpdateShippingInformationRequest $request, ShippingInformation $shippingInformation)
    {
        //
    }
}
