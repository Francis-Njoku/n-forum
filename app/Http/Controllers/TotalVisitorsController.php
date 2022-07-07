<?php

namespace App\Http\Controllers;

use App\Models\TotalVisitors;
use App\Http\Requests\StoreTotalVisitorsRequest;
use App\Http\Requests\UpdateTotalVisitorsRequest;

class TotalVisitorsController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTotalVisitorsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTotalVisitorsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TotalVisitors  $totalVisitors
     * @return \Illuminate\Http\Response
     */
    public function show(TotalVisitors $totalVisitors)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTotalVisitorsRequest  $request
     * @param  \App\Models\TotalVisitors  $totalVisitors
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTotalVisitorsRequest $request, TotalVisitors $totalVisitors)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TotalVisitors  $totalVisitors
     * @return \Illuminate\Http\Response
     */
    public function destroy(TotalVisitors $totalVisitors)
    {
        //
    }
}
