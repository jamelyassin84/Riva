<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyerInvoiceSetings extends Model
{
    use HasFactory;

    protected $fillable = [
        'custom_fields',
        'default_payment_method',
        'footer',
    ];
}
