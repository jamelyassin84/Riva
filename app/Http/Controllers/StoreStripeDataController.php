<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Buyer;
use App\Models\BuyerInformation;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Summary;
use App\Models\User;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Stripe;

class StoreStripeDataController extends Controller
{


    public static function store(Request  $request)
    {
        $data = (object) $request->all();
        Stripe\Stripe::setApiKey(env('STRIPE_TEST_SECRET_KEY'));

        $request = Stripe\Checkout\Session::retrieve(
            $data->transaction,
            []
        );

        return self::create_payment_summary($request);
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
                'country' => $data->customer_details->country || '',
                'city' => $data->customer_details->city || '',
                'address' => $data->customer_details->street1 || '',
                'landmark' => $data->customer_details->state || '',
                'zip_code' => '',
            ]);
        }

        $product = Product::find($data->metadata['id']);

        $summary = [
            'buyer_id' => $user->id,
            'seller_id' => $product->user_id,
            'product_id' => $product->id,
            'amount' => $data->amount_subtotal / 100,
            'quantity' => 1,
            'reference_number' => $data->tran_ref
        ];
        $seller = Seller::where('user_id', $product->user_id)->first();
        $seller->balance += Admin::deduct_app_transaction_fee($data->amount_subtotal / 100);
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
        $admin->application_fee_amount += $data->amount_subtotal / 100;
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
            'name' => $data->customer_details->name || '',
            'email' =>  $data->customer_details->email || '',
            'phone' => '',
            'country_code' => '',
            'alt_phone' => '',
            'payment_method' => '',
            'is_logged_in' => false,
            'currency' => $data->currency || '',
            'area_code' => $data->customer_details->country || '',
        ]);
    }

    static function  resolve_area_code($code)
    {
        return '+' . substr($code, 0, 3);
    }
}
