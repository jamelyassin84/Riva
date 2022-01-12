<?php

namespace App\Http\Controllers;

use App\Models\Summary;

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
