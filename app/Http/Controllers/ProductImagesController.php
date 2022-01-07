<?php

namespace App\Http\Controllers;

use App\Models\ProductImages;
use App\Http\Requests\StoreProductImagesRequest;
use App\Http\Requests\UpdateProductImagesRequest;

class ProductImagesController extends Controller
{
    public function index()
    {
        //
    }
    public function store(StoreProductImagesRequest $request)
    {
        //
    }

    public function show(ProductImages $productImages)
    {
        //
    }

    public function update(UpdateProductImagesRequest $request, ProductImages $productImages)
    {
        //
    }

    public function destroy(ProductImages $productImages)
    {
        //
    }
}
