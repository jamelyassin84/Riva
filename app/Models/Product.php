<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'product_name',
        'slug',
        'image-url',
        'brief_description',
        'description',
        'currency',
        'price',
        'discounted_price',
        'size_type',
        'sizes',
        'colors',
    ];
}
