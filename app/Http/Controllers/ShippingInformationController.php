<?php

namespace App\Http\Controllers;

use App\Models\ShippingInformation;
use App\Http\Requests\StoreShippingInformationRequest;
use App\Http\Requests\UpdateShippingInformationRequest;

class ShippingInformationController extends Controller
{

    public function store(StoreShippingInformationRequest $request)
    {
        //
    }

    public function show(ShippingInformation $shippingInformation)
    {
        //
    }

    public function update(UpdateShippingInformationRequest $request, ShippingInformation $shippingInformation)
    {
        //
    }
}
