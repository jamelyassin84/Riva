<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Http\Requests\UpdateBuyerRequest;
use App\Models\BuyerInformation;
use App\Models\Summary;
use App\Models\User;
use Illuminate\Http\Request;

class BuyerController extends Controller
{

    public function index()
    {
    }

    public static function create_user($data)
    {
        return User::create([
            'type' => 'buyer',
            'profile_id' => '',
            'card_number' => !isset($data['card_token']['number']) ? env('Card1') : $data['card_token']['number'],
            'name' =>  $data['name'],
            'email' =>  $data['email'],
            'country_code' => $data['country'],
            'phone' => $data['mobile'],
            'alt_phone' => 0,
            'payment_method' =>  $data['paymentMethod'],
            'is_logged_in' => true,
            'currency' => $data['product']['currency'],
            'area_code' => 'AE',
        ]);
    }

    public function store(Request $request)
    {
        $data = (object) $request->all();
        $user = User::where('email', $data['email'])->first();
        $buyer = [];
        if (empty($user)) {
            $user = self::create_user($data);
        }
        $buyer = Buyer::where('user_id', $user->id)->first();
        if (empty($buyer)) {
            $buyer = Buyer::create(['user_id' => $user->id]);
            BuyerInformation::create([
                'buyer_id' => $user->id,
                'country' => $data->country,
                'city' => $data->city,
                'address' => $data->address,
                'landmark' => $data->landMark,
                'zip_code' => $data->zipCode,
            ]);
        }
        $summary = [
            'buyer_id' => $user->id,
            'seller_id' => $data->product->user_id,
            'product_id' => $data->product->id,
            'amount' =>  $data->product->price,
            'quantity' =>  $data->product->quantity,
            'reference_number' => $data->payment->tran_ref
        ];
        $summary = Summary::create($summary);
        return [
            'summary' => $summary,
            'payment' => $data->payment,
            'buyer' => $buyer,
            'user' => $user,
            'user_data' => $data,
        ];
    }

    public function show(Buyer $buyer)
    {
        //
    }


    public function update(UpdateBuyerRequest $request, Buyer $buyer)
    {
        //
    }

    public function destroy(Buyer $buyer)
    {
        //
    }
}
