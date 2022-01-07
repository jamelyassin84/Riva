<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'password',
        'country',
        'application_fee_amount',
        'avatar',
    ];

    protected $hidden = [
        'password',
    ];
}
