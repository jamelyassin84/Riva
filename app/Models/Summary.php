<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Summary extends Model
{
    use HasFactory;

    protected $fillable = [
        'buyer_id',
        'seller_id',
        'product_id',
        'amount',
        'quantity',
        'reference_number'
    ];

    public function product()
    {

        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function varieties()
    {
        return $this->hasManyThrough(
            Variant::class,
            PreferredVariant::class,
            'variant_id',
            'summary_id',
            'id',
            'id'
        );
    }
}
