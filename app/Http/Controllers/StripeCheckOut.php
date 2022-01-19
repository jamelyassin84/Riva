<?php


namespace App\Http\Controllers;

use Stripe;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StripeCheckOut extends Controller
{
    public function __construct()
    {
        return $this;
    }

    public function check_out(Request  $request)
    {
        $data = (object) $request->all();
        $payment = $this->stripe_check_out($data);
        if (!$payment) {
            return response('Something went wrong', 300);
        }
        return $payment;
    }

    public function stripe_check_out($data)
    {
        $data->product = (object) $data->product;
        Stripe\Stripe::setApiKey(env('STRIPE_TEST_SECRET_KEY'));
        $body = [
            'line_items' => [[
                'price_data' => [
                    'currency' => Str::lower($data->product->currency),
                    'product_data' => [
                        'name' => $data->product->name,
                        'images' => [$data->product->url],
                        'description' =>  $data->product->description,

                    ],
                    'unit_amount' => intval($data->product->price . '00'),
                ],
                'quantity' => 1,

            ]],
            'mode' => 'payment',
            'metadata'  => ['id' => $data->product->id],
            'success_url' => env('FRONT_END_REDIRECT_URL_AFTER_CHECK_OUT'),
            'cancel_url' => env('FRONT_END_REDIRECT_URL_IF_CANCELED') . $data->product->slug,
        ];

        $request = Stripe\Checkout\Session::create($body);

        return $request;
    }
}
