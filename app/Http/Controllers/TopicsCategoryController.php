<?php

namespace App\Http\Controllers;

use App\Models\TopicsCategory;
use App\Http\Requests\StoreTopicsCategoryRequest;
use App\Http\Requests\UpdateTopicsCategoryRequest;

class TopicsCategoryController extends Controller
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
     * @param  \App\Http\Requests\StoreTopicsCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTopicsCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TopicsCategory  $topicsCategory
     * @return \Illuminate\Http\Response
     */
    public function show(TopicsCategory $topicsCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTopicsCategoryRequest  $request
     * @param  \App\Models\TopicsCategory  $topicsCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTopicsCategoryRequest $request, TopicsCategory $topicsCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TopicsCategory  $topicsCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(TopicsCategory $topicsCategory)
    {
        //
    }
}
