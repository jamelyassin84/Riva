<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImages;
use App\Models\Variant;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $product = [
            'user_id' => 2,
            'name' => 'Nike PRECISION IV',
            'url' => url('uploads/products/nike1.jpeg'),
            'slug' => Str::slug('Nike PRECISION IV'),
            'currency' => 'AED',
            'price' => 74,
            'discounted_price' => 72,
            'brief_description' => 'Unisex Basketball Shoes',
            'description' => 'A pair of black basketball sports shoes, has mid-top styling, lace-up detail Lightweight knit material with a low-cut collar provides a secure, supportive fit while maintain ankle mobility. A multi-directional outsole pattern with rubber wrapped up the sides helps you grip the court.',
            'quantity' => 0,
            'is_sold_out' => false,
            'is_temporary_unavailable' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $product = Product::create($product);
        $images = [
            'uploads/products/nike2.jpeg',
            'uploads/products/nike3.jpeg',
            'uploads/products/nike4.jpeg',
        ];

        foreach ($images as $url) {
            $productImages =  [
                'product_id' => $product->id,
                'url' => url($url),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            ProductImages::create($productImages);
        }

        $names = ['Size', 'Color'];
        $values = [
            ["36 US", "37 US", "38 US", "39 US", "40 US"],
            ["Yellow & Black", "White & Black"]
        ];

        for ($i = 0; $i < 2; $i++) {
            foreach ($values[$i] as $variant) {
                Variant::create([
                    'product_id' => $product->id,
                    'name' => $names[$i],
                    'value' => $variant,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }

        $product = [
            'user_id' => 2,
            'name' => 'Adidas Basketball Shoes',
            'url' => url('uploads/products/shoe1.jpeg'),
            'slug' => Str::slug('Adidas Basketball Shoes'),
            'currency' => 'AED',
            'price' => 174,
            'discounted_price' => 250,
            'brief_description' => 'Unisex Casual Shoes',
            'description' => 'A pair of white basketball casual shoes, has mid-top styling, lace-up detail Lightweight knit material with a low-cut collar provides a secure, supportive fit while maintain ankle mobility. A multi-directional outsole pattern with rubber wrapped up the sides helps you grip the court.',
            'quantity' => 0,
            'is_sold_out' => false,
            'is_temporary_unavailable' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $product = Product::create($product);
        $images = [
            'uploads/products/shoe2.jpeg',
            'uploads/products/shoe3.jpeg',
            'uploads/products/shoe4.jpeg',
        ];

        foreach ($images as $url) {
            $productImages =  [
                'product_id' => $product->id,
                'url' => url($url),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            ProductImages::create($productImages);
        }

        for ($i = 0; $i < 2; $i++) {
            foreach ($values[$i] as $variant) {
                Variant::create([
                    'product_id' => $product->id,
                    'name' => $names[$i],
                    'value' => $variant,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
