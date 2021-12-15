<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Summary extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
    ];

    public function  products()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
