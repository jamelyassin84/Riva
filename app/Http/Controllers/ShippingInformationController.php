<?php

namespace App\Http\Controllers;

use App\Models\ShippingInformation;
use App\Http\Requests\UpdateShippingInformationRequest;
use App\Models\Buyers;
use Illuminate\Http\Request;

class ShippingInformationController extends Controller
{

    public function store(Request $request)
    {
        $data = $request->all();

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $buyer =  $stripe->customers->create(['description' => $data['name']]);

        Buyers::create($buyer);
        $buyer->buyer_id =  $buyer['id'];
        Buyers::create($buyer->invoice_settings);

        $data['product_id'] =  $data['product']['id'];

        $data['seller'] =  $data['product']['user_id'];

        return ShippingInformation::create(json_decode($data));
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
