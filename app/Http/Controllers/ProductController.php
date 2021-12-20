<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function store(Request $request)
    {
        $product = $request->all();
        $product['slug'] = $this->toSlug($product['product_name'])
            . '-' . $this->toSlug($product['brief_description']);
        return Product::create($product);
    }

    public function show($id)
    {
        Product::where('user_id', $id)->get();
    }

    public function update(Request $request,  $id)
    {
        $product = Product::where('id', $id)->first();

        $product->fill($request)->save();
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return  response('Deleted', 200);
    }

    public static function toSlug($word)
    {
        return join('-', explode(' ', $word));
    }
}
