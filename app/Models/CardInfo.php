<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'method',
        'card_number',
        'card_type',
        'name_on_card',
        'expiry',
        'cvv',
    ];
}
