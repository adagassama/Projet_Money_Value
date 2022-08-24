<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorecurrenciesRequest;
use App\Http\Requests\UpdatecurrenciesRequest;
use App\Models\currencies;

class CurrenciesController extends Controller
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
     * @param  \App\Http\Requests\StorecurrenciesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorecurrenciesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\currencies  $currencies
     * @return \Illuminate\Http\Response
     */
    public function show(currencies $currencies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\currencies  $currencies
     * @return \Illuminate\Http\Response
     */
    public function edit(currencies $currencies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecurrenciesRequest  $request
     * @param  \App\Models\currencies  $currencies
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatecurrenciesRequest $request, currencies $currencies)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\currencies  $currencies
     * @return \Illuminate\Http\Response
     */
    public function destroy(currencies $currencies)
    {
        //
    }
}
