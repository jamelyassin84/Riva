<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Buyer;
use App\Models\BuyerInformation;
use App\Models\PreferredVariant;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Summary;
use App\Models\User;
use Illuminate\Http\Request;
use Stripe;

class StoreStripeDataController extends Controller
{


    public static function store(Request  $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_TEST_SECRET_KEY'));

        $data = (object) $request->all();

        $request = Stripe\Checkout\Session::retrieve(
            $data->transaction,
            []
        );

        return self::create_payment_summary($request, $data->transaction);
    }

    static function create_payment_summary($data, $reference_number)
    {
        $data = (object) $data;

        $buyer = [];

        $user = User::where('email', $data->customer_details['email'])->first();

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
            'reference_number' => $reference_number
        ];

        $summary = Summary::create($summary);

        $seller = Seller::where('user_id', $product->user_id)->first();

        $seller->balance += Admin::deduct_app_transaction_fee($data->amount_subtotal / 100);

        $seller->save();

        $seller = User::where('id', $product->user_id)->first();


        $transaction = Summary::where('reference_number', $reference_number)->first();

        $chosen_variants = PreferredVariant::where('summary_id', $summary->id)->get();

        if (count($chosen_variants) === 0) {
            $chosen_variants = self::store_chosen_variants($data->metadata['chosenVariants'], $summary->id);
        }

        $chosen_variants = PreferredVariant::where('summary_id', $summary->id)
            ->with('variant')
            ->get();
        if (!empty($transaction)) {
            return [
                'buyer' => $user,
                'seller' => $seller,
                'product' => $product,
                'payment' => $data,
                'summary' => $transaction,
                'chosen_variants' => $chosen_variants,
            ];
        }

        $admin = Admin::find(1)->first();

        $admin->application_fee_amount += $data->amount_subtotal / 100;

        $admin->save();

        return [
            'buyer' => $user,
            'seller' => $seller,
            'product' => $product,
            'payment' => $data,
            'summary' => $summary,
            'chosen_variants' => $chosen_variants,
        ];
    }

    public static function create_user($data)
    {
        $data->customer_details = (object) $data->customer_details;

        return User::create([
            'type' => 'buyer',
            'name' => $data->customer_details->name || 'N/A',
            'email' =>  $data->customer_details->email,
            'phone' => $data->customer_details->email,
            'payment_method' => $data->payment_method_types[0] || 'N/A',
            'is_logged_in' => false,
            'currency' => $data->currency,
        ]);
    }


    public static function store_chosen_variants($data, $summary_id)
    {
        $data = (object) json_decode($data);

        $variants = [];

        foreach ($data as $variant) {

            $preferred_variant = PreferredVariant::create([
                'summary_id' => $summary_id,
                'variant_id' => $variant->value->id,
            ]);

            array_push($variants, $preferred_variant);
        }

        return $variants;
    }
}
