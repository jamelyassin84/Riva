<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function check_out(Request  $request)
    {
        $data = (object) $request->all();
        $payment = self::store_payment($data);
        if (!$payment) {
            return response('Something went wrong', 300);
        }
        return $payment;
    }

    public static function store_payment($data)
    {
        $data->product = (object) $data->product;
        $client = new Client();
        $body = [
            "hide_shipping" => false,
            "framed" => false,
            "framed" => false,
            'profile_id' => env('ProfileID'),
            'tran_type' => 'sale',
            'tran_class' => 'ecom',
            'cart_description' => $data->product->description,
            'cart_id' => strval($data->product->id),
            'cart_currency' =>  $data->product->currency,
            'cart_amount' => $data->product->price,
            'callback' => url('api/pay-tabs'),
            'return' => env('FrontRedirectAddress'),
        ];
        $response =  $client->request(
            'POST',
            env('PayTabs'),
            [
                'body' => json_encode($body), 'headers' => [
                    'authorization' => env('PayTabsTestAPIKey'),
                    'content-type' => 'application/json'
                ]
            ]
        );
        $statusCode = $response->getStatusCode();
        if ($statusCode > 200) {
            return false;
        }
        return json_decode($response->getBody());
    }

    public function check_buyer_is_previous()
    {
    }
}
