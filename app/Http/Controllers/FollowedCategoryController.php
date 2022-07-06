<?php

namespace App\Http\Controllers;

use App\Models\FollowedCategory;
use App\Http\Requests\StoreFollowedCategoryRequest;
use App\Http\Requests\UpdateFollowedCategoryRequest;

class FollowedCategoryController extends Controller
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
     * @param  \App\Http\Requests\StoreFollowedCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFollowedCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FollowedCategory  $followedCategory
     * @return \Illuminate\Http\Response
     */
    public function show(FollowedCategory $followedCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFollowedCategoryRequest  $request
     * @param  \App\Models\FollowedCategory  $followedCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFollowedCategoryRequest $request, FollowedCategory $followedCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FollowedCategory  $followedCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(FollowedCategory $followedCategory)
    {
        //
    }
}
