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
        // $product['slug'] = join("-", explode(' ', $product['product_name']));
        Product::create($request->all());
        return response('Created', 200);
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
}
