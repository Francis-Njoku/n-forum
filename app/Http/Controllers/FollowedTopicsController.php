<?php

namespace App\Http\Controllers;

use App\Models\FollowedTopics;
use App\Http\Requests\StoreFollowedTopicsRequest;
use App\Http\Requests\UpdateFollowedTopicsRequest;

class FollowedTopicsController extends Controller
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
     * @param  \App\Http\Requests\StoreFollowedTopicsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFollowedTopicsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FollowedTopics  $followedTopics
     * @return \Illuminate\Http\Response
     */
    public function show(FollowedTopics $followedTopics)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFollowedTopicsRequest  $request
     * @param  \App\Models\FollowedTopics  $followedTopics
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFollowedTopicsRequest $request, FollowedTopics $followedTopics)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FollowedTopics  $followedTopics
     * @return \Illuminate\Http\Response
     */
    public function destroy(FollowedTopics $followedTopics)
    {
        //
    }
}
