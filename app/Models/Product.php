<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'image-url',
        'slug',
        'brief_description',
        'description',
        'quantity',
        'currency',
        'price',
        'discounted_price',
        'variants',
        'is_sold_out',
        'user_id'
    ];
}
