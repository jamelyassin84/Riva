<?php

namespace App\Http\Controllers;

use App\Models\CardInfo;
use App\Http\Requests\StoreCardInfoRequest;
use App\Http\Requests\UpdateCardInfoRequest;

class CardInfoController extends Controller
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
     * @param  \App\Http\Requests\StoreCardInfoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCardInfoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CardInfo  $cardInfo
     * @return \Illuminate\Http\Response
     */
    public function show(CardInfo $cardInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CardInfo  $cardInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(CardInfo $cardInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCardInfoRequest  $request
     * @param  \App\Models\CardInfo  $cardInfo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCardInfoRequest $request, CardInfo $cardInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CardInfo  $cardInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(CardInfo $cardInfo)
    {
        //
    }
}
