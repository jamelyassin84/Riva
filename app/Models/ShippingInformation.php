<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'city',
        'country',
        'email',
        'landMark',
        'mobile',
        'name',
        'zipCode',
        'product_id',
        'seller',
    ];
}
