<?php

namespace App\Http\Controllers;

use App\Models\ShippingInformation;
use App\Http\Requests\UpdateShippingInformationRequest;
use Illuminate\Http\Request;

class ShippingInformationController extends Controller
{

    public function store(Request $request)
    {
        $data = $request->all();

        $data['product_id'] =  $data['product']['id'];

        $data['seller'] =  $data['product']['user_id'];

        return $request->user()->checkout($data['product']['product_name']);

        return ShippingInformation::create($data);
    }

    public function show(Request $shippingInformation)
    {
        //
    }

    public function update(UpdateShippingInformationRequest $request, ShippingInformation $shippingInformation)
    {
        //
    }
}
