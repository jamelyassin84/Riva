<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'avatar',
        'mode',
        'google',
        'facebook',
        'apple',
        'verification_code',
        'balance',
    ];

    protected $hidden = [
        'password',
        'verification_code',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
