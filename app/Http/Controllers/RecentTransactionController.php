<?php

namespace App\Http\Controllers;

use App\Models\RecentTransaction;
use App\Http\Requests\StoreRecentTransactionRequest;
use App\Http\Requests\UpdateRecentTransactionRequest;

class RecentTransactionController extends Controller
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
     * @param  \App\Http\Requests\StoreRecentTransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRecentTransactionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RecentTransaction  $recentTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(RecentTransaction $recentTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RecentTransaction  $recentTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(RecentTransaction $recentTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRecentTransactionRequest  $request
     * @param  \App\Models\RecentTransaction  $recentTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRecentTransactionRequest $request, RecentTransaction $recentTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RecentTransaction  $recentTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(RecentTransaction $recentTransaction)
    {
        //
    }
}
