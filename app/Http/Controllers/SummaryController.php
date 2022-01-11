<?php

namespace App\Http\Controllers;

use App\Models\Summary;
use App\Http\Requests\UpdateSummaryRequest;
use App\Models\Buyer;
use App\Models\BuyerInformation;
use App\Models\User;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class SummaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only('show');
    }

    public function index()
    {
    }

    public static function store_payment($data, $user)
    {
        $client = new Client();
        $body = [
            "hide_shipping" => false,
            "framed" => false,
            "framed" => false,
            'profile_id' => env('ProfileID'),
            'tran_type' => 'sale',
            'tran_class' => 'ecom',
            'cart_description' => $data['product']['description'],
            'cart_id' => strval($data['product']['user_id']),
            'cart_currency' => $data['product']['currency'],
            'cart_amount' => $data['product']['price'],
            'callback' => env('FrontRedirectAddress'),
            'return' => env('FrontRedirectAddress'),
        ];
        if (count($data['card_token']) !== 0) {
            $body['card_details'] = [
                'pan' => !isset($data['card_token']['number']) ? env('Card1') : $data['card_token']['number'],
                'expiry_month' => !isset($data['card_token']['number']) ? 1 : $data['card_token']['number'],
                'expiry_year' => !isset($data['card_token']['number']) ? 2023 : $data['card_token']['number'],
                'cvv' => !isset($data['card_token']['number']) ? '123' : $data['card_token']['number']
            ];
        }
        $body['customer_details'] = [
            'name' => $user->name,
            'email' =>  $user->email,
            'phone' => $user->phone,
            'city' => $data['city'],
            'state' => 'DU',
            'country' => $data['country'],
            'ip' => request()->ip()
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

        return json_decode($response->getBody());
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
        $data = $request->all();
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
                'country' => $data['country'],
                'city' => $data['city'],
                'address' => $data['address'],
                'landmark' => $data['landMark'],
                'zip_code' => $data['zipCode'],
            ]);
        }
        $payment = self::store_payment($data, $user);
        $summary = [
            'buyer_id' => $user->id,
            'seller_id' => $data['product']['user_id'],
            'product_id' =>  $data['product']['id'],
            'amount' =>  $data['product']['price'],
            'quantity' =>  $data['product']['quantity'],
            'reference_number' => $payment->tran_ref
        ];
        $summary = Summary::create($summary);
        return [
            'summary' => $summary,
            'payment' => $payment,
            'buyer' => $buyer,
            'user' => $user,
            'user_data' => $data,
        ];
    }

    public function show(Request $request)
    {
        $user = $request->user();
        return Summary::where('seller_id', $user->id)
            ->with('product')
            ->get();
    }

    public function update(UpdateSummaryRequest $request, Summary $summary)
    {
    }

    public function destroy(Summary $summary)
    {
        //
    }
}
