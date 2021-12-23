<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Buyers extends Model
{
    use HasFactory;

    protected $fillable = [
        'buyer_id',
        'balance',
        'created',
        'currency',
        'default_source',
        'delinquent',
        'description',
        'discount',
        'email',
        'invoice_prefix',
        'livemode',
        'metadata',
        'name',
        'next_invoice_sequence',
        'object',
        'phone',
        'preferred_locales',
        'tax_exempt',
    ];

    public static function save_buyer($buyer,  $data): void
    {
        $data['product_id'] =  $data['product']['id'];
        $data['seller'] =  $data['product']['user_id'];
        ShippingInformation::create($data);

        $data =  [
            'buyer_id' => $buyer['id'],
            'address' => $buyer['address'],
            'balance' => $buyer['balance'],
            'created' => $buyer['created'],
            'currency' => $data['product']['currency'],
            'default_source' => '',
            'delinquent' => $buyer['delinquent'],
            'description' => $buyer['description'],
            'discount' => '',
            'email' => $buyer['email'],
            'invoice_prefix' => $buyer['invoice_prefix'],
            'livemode' => $buyer['livemode'],
            'metadata' => $buyer['metadata'],
            'name' => $buyer['name'],
            'next_invoice_sequence' => $buyer['next_invoice_sequence'],
            'object' => $buyer['object'],
            'phone' => $buyer['phone'],
            'tax_exempt' => $buyer['tax_exempt'],
            'preferred_locales' => json_encode($buyer['preferred_locales'])
        ];

        self::create($data);
    }

    public static function MakePayment()
    {
    }
}
