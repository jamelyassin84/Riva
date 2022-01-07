<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Models\ProductImages;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('show');
    }

    public function index()
    {
        return Product::all();
    }

    public function store(StoreProductRequest $request)
    {
        $product = $request->all();

        $product['slug'] = Str::slug($product['product_name'] . '-' . $product['brief_description'], '-');

        $process = Product::getImageUrl($request);

        $product['url'] =  $process['url'];

        $product = Product::create($product);

        foreach ($process['urls'] as $url) {
            ProductImages::create([
                'product_id' =>  $product->id,
                'url' => $url,
            ]);
        }

        return $request->user();
    }

    public function show($id)
    {
        $product = Product::where('user_id', $id)
            ->with('photos')
            ->with('variants')
            ->get();

        if (sizeof($product) === 0) {
            $product = Product::where('slug', $id)
                ->with('photos')
                ->with('variants')
                ->first();

            if (empty($product)) {
                $product = Product::where('user_id', $id)
                    ->with('photos')
                    ->with('variants')
                    ->get();
            }
        }

        return $product;
    }

    public function update(Request $request,  $id)
    {
        $product = Product::where('id', $id)->first();

        return $product->fill($request)->save();
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return  response('Deleted', 200);
    }
}
