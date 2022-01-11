<?php

namespace App\Http\Controllers;

use App\Models\Summary;
use App\Http\Requests\UpdateSummaryRequest;
use App\Models\Buyer;
use App\Models\BuyerInformation;
use App\Models\User;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class SummaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function show($id)
    {
        return Summary::where('seller_id', $id)
            ->with('product')
            ->get();
    }
}
