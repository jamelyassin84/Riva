<?php

namespace App\Http\Controllers;

use App\Models\BuyerInformation;
use App\Http\Requests\StoreBuyerInformationRequest;
use App\Http\Requests\UpdateBuyerInformationRequest;

class BuyerInformationController extends Controller
{
    public function index()
    {
        //
    }

    public function store(StoreBuyerInformationRequest $request)
    {
        //
    }

    public function show(BuyerInformation $buyerInformation)
    {
        //
    }

    public function update(UpdateBuyerInformationRequest $request, BuyerInformation $buyerInformation)
    {
        //
    }

    public function destroy(BuyerInformation $buyerInformation)
    {
        //
    }
}
