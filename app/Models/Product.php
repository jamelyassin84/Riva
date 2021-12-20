<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'brief_description',
        'price',
        'description',
        'discounted_price',
        'currency',
        'variants',
        'is_sold_out',
        'user_id',
        'slug'
    ];

    public function getImageUrl($request)
    {
        $slug = '';

        return $slug;
    }

    public function save_images($request)
    {
        $slug = '';

        return $slug;
    }
}
