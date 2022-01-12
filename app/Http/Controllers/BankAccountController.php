<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Http\Requests\UpdateBankAccountRequest;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function show($id)
    {
        return BankAccount::where('seller_id', $id)->first();
    }

    public function store(Request $request)
    {
        $data = (object) $request->all();
        $user = $request->user();
        $data->seller_id = $user->id;
        $bankAccount = BankAccount::where('seller_id', $user->id)->first();
        if (empty($bankAccount)) {
            $bankAccount = BankAccount::create($data);
        }
        return $bankAccount->fill($data)->save();
    }
}
