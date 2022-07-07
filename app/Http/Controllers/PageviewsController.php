<?php

namespace App\Http\Controllers;

use App\Models\Pageviews;
use App\Http\Requests\StorePageviewsRequest;
use App\Http\Requests\UpdatePageviewsRequest;

class PageviewsController extends Controller
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
     * @param  \App\Http\Requests\StorePageviewsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePageviewsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pageviews  $pageviews
     * @return \Illuminate\Http\Response
     */
    public function show(Pageviews $pageviews)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePageviewsRequest  $request
     * @param  \App\Models\Pageviews  $pageviews
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePageviewsRequest $request, Pageviews $pageviews)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pageviews  $pageviews
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pageviews $pageviews)
    {
        //
    }
}
