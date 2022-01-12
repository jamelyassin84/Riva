<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Http\Requests\StoreSellerRequest;
use App\Http\Requests\UpdateSellerRequest;

class SellerController extends Controller
{
    public function index()
    {
        //
    }

    public function store(StoreSellerRequest $request)
    {
        //
    }

    public function show($id)
    {
        return Seller::where('user_id', $id)->first();
    }

    public function update(UpdateSellerRequest $request, Seller $seller)
    {
        //
    }

    public function destroy(Seller $seller)
    {
        //
    }
}
