<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyers extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'balance',
        'created',
        'currency',
        'default_source',
        'delinquent',
        'description',
        'discount',
        'email',
        'id',
        'invoice_prefix',
        'livemode',
        'metadata',
        'name',
        'next_invoice_sequence',
        'object',
        'phone',
        'preferred_locales',
        'shipping',
        'tax_exempt',
    ];
}
