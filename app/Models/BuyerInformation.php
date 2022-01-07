<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyerInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'buyer_id',
        'country',
        'city',
        'address',
        'landmark',
        'zip_code',
    ];
}
