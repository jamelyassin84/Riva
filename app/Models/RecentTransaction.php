<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecentTransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'seller',
        'buyer',
        'currency',
        'price',
        'size_type',
        'sizes',
        'colors',
    ];
}
