<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'country',
        'state',
        'city',
        'address_line',
        'zip_code',
    ];
}
