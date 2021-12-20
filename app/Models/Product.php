<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
        'slug',
        'image-url'
    ];

    public static function getImageUrl($request)
    {
        $path = '';
        $index = 0;
        $files = $request->file('photos');
        $urls = [];
        if ($request->hasFile('photos')) {
            foreach ($files as $file) {
                if ($index === 0) {
                    self::moveImageToProductsFolder($file);
                    $path =  array_push($urls, self::moveImageToProductsFolder($file));
                } else {
                    array_push($urls, url()->current() . self::moveImageToProductsFolder($file));
                }
                $index += 1;
            }
        }
        return [
            'image-url' => url()->current() . $path,
            'urls' => $urls
        ];
    }

    static function moveImageToProductsFolder($file)
    {
        return Storage::put('products',  $file);
    }
}
