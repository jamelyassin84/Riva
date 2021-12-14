<?php

namespace App\Http\Controllers;

use App\Models\ShippingInformation;
use App\Http\Requests\StoreShippingInformationRequest;
use App\Http\Requests\UpdateShippingInformationRequest;

class ShippingInformationController extends Controller
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
     * @param  \App\Http\Requests\StoreShippingInformationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShippingInformationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShippingInformation  $shippingInformation
     * @return \Illuminate\Http\Response
     */
    public function show(ShippingInformation $shippingInformation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShippingInformation  $shippingInformation
     * @return \Illuminate\Http\Response
     */
    public function edit(ShippingInformation $shippingInformation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateShippingInformationRequest  $request
     * @param  \App\Models\ShippingInformation  $shippingInformation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShippingInformationRequest $request, ShippingInformation $shippingInformation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShippingInformation  $shippingInformation
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShippingInformation $shippingInformation)
    {
        //
    }
}
