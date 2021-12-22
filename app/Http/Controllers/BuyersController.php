<?php

namespace App\Http\Controllers;

use App\Models\Buyers;
use App\Http\Requests\StoreBuyersRequest;
use App\Http\Requests\UpdateBuyersRequest;

class BuyersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBuyersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBuyersRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buyers  $buyers
     * @return \Illuminate\Http\Response
     */
    public function show(Buyers $buyers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buyers  $buyers
     * @return \Illuminate\Http\Response
     */
    public function edit(Buyers $buyers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBuyersRequest  $request
     * @param  \App\Models\Buyers  $buyers
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBuyersRequest $request, Buyers $buyers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buyers  $buyers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buyers $buyers)
    {
        //
    }
}
