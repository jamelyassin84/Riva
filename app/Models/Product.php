<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'product_name',
        'price',
        'discounted_price',
        'description',
        'currency',
        'currency',
        'slug'
    ];
}
