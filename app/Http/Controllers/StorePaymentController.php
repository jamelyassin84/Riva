<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Buyer;
use App\Models\BuyerInformation;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Summary;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class StorePaymentController extends Controller
{

    public static function store(Request  $request)
    {
        $data = (object) $request->all();

        $client = new Client();
        $body = [
            "profile_id" => env('ProfileID'),
            "tran_ref" => $data->transaction,
        ];
        $response =  $client->request(
            'POST',
            env('PayTabsTransactionsURL'),
            [
                'body' => json_encode($body), 'headers' => [
                    'authorization' => env('PayTabsTestAPIKey'),
                    'content-type' => 'application/json'
                ]
            ]
        );
        $statusCode = $response->getStatusCode();

        if ($statusCode > 200)  return response('Transaction in missing', 401);

        $payment_details = json_decode($response->getBody());
        if ($payment_details->payment_result->response_message !== 'Authorised') return response('Payment Gateway Error', 302);

        return self::create_payment_summary($payment_details);
    }

    static function create_payment_summary($data)
    {
        $data = (object) $data;
        $buyer = [];
        $user = User::where('email', $data->customer_details->email)->first();
        if (empty($user)) $user = self::create_user($data);

        $buyer = Buyer::where('user_id', $user->id)->first();
        if (empty($buyer)) {
            $buyer = Buyer::create(['user_id' => $user->id]);
            BuyerInformation::create([
                'buyer_id' => $user->id,
                'country' => $data->customer_details->country,
                'city' => $data->customer_details->city,
                'address' => $data->customer_details->street1,
                'landmark' => $data->customer_details->state,
                'zip_code' => '',
            ]);
        }

        $product = Product::find($data->cart_id);

        $summary = [
            'buyer_id' => $user->id,
            'seller_id' => $product->user_id,
            'product_id' => $product->id,
            'amount' => $data->cart_amount,
            'quantity' => 1,
            'reference_number' => $data->tran_ref
        ];
        $seller = Seller::where('user_id', $product->user_id)->first();
        $seller->balance += Admin::deduct_app_transaction_fee($data->cart_amount);
        $seller->save();
        $seller = User::where('id', $product->user_id)->first();

        $transaction = Summary::where('reference_number', $data->tran_ref)->first();
        if (!empty($transaction)) {
            return [
                'buyer' => $user,
                'seller' => $seller,
                'product' => $product,
                'payment' => $data,
                'summary' => $transaction,
            ];
        }

        $summary = Summary::create($summary);
        $admin = Admin::find(1)->first();
        $admin->application_fee_amount += $data->cart_amount;
        $admin->save();

        return [
            'buyer' => $user,
            'seller' => $seller,
            'product' => $product,
            'payment' => $data,
            'summary' => $summary,
        ];
    }

    public static function create_user($data)
    {
        $data->customer_details = (object) $data->customer_details;
        return User::create([
            'type' => 'buyer',
            'profile_id' => '',
            'card_number' => '',
            'name' => $data->customer_details->name,
            'email' =>  $data->customer_details->email,
            'phone' => '',
            'country_code' => '',
            'alt_phone' => '',
            'payment_method' => '',
            'is_logged_in' => false,
            'currency' => $data->cart_currency,
            'area_code' => $data->customer_details->country,
        ]);
    }

    static function  resolve_area_code($code)
    {
        return '+' . substr($code, 0, 3);
    }
}
