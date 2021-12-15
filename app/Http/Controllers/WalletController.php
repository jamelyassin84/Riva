<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Http\Requests\StoreWalletRequest;
use App\Http\Requests\UpdateWalletRequest;

class WalletController extends Controller
{
    public function store(StoreWalletRequest $request)
    {
        //
    }

    public function show(Wallet $wallet)
    {
        //
    }

    public function update(UpdateWalletRequest $request, Wallet $wallet)
    {
        //
    }

    public function destroy(Wallet $wallet)
    {
        //
    }
}
