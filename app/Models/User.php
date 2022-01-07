<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'type',
        'profile_id',
        'card_number',
        'name',
        'email',
        'country_code',
        'phone',
        'alt_phone',
        'payment_method',
        'is_logged_in',
        'currency',
        'area_code',
        'email_verified_at',
    ];

    protected $hidden = [
        'remember_token',
        'profile_id',
        'card_number',
        'payment_method',
    ];
}
