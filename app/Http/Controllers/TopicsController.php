<?php

namespace App\Http\Controllers;

use App\Models\Topics;
use App\Http\Requests\StoreTopicsRequest;
use App\Http\Requests\UpdateTopicsRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\TopicCategoryResource;
use App\Http\Resources\TopicsResource;
use App\Http\Resources\TopicTrendingResource;
use App\Models\Category;
use Carbon\Carbon;

class TopicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TopicsResource::collection(Topics::join('users', 'users.id', '=', 'topics.user_id')
            ->join('profile', 'profile.user_id', '=', 'users.id')
            ->where('topics.status', '1')->paginate(3));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTopicsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTopicsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Topics  $topics
     * @return \Illuminate\Http\Response
     */
    public function show(Topics $topics)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Topics  $topics
     * @return \Illuminate\Http\Response
     */
    public function listCategory($topics)
    {
        return CategoryResource::collection(Category::join('topics_category as tc', 'tc.category_id', '=', 'categories.id')
            ->where('tc.topic_id', $topics)->get());
    }

    /**
     * Display the Top trending topics resource.
     *
     * @param  \App\Models\Topics  $topics
     * @return \Illuminate\Http\Response
     */
    public function topTrending()
    {
        $date = Carbon::now()->subDays(7);

        return TopicTrendingResource::collection(Topics
            ::join('topic_comments as tc', 'tc.topic_id', '=', 'topics.id')
            ->selectRaw('count(tc.topic_id) as counter, topics.title as name, topics.slug as slug, topics.image as image, topics.created_at as created_at')
            ->where('topics.status', 1)
            ->where('topics.created_at', '>=', $date)
            ->groupBy('topics.title', 'topics.slug', 'topics.image', 'topics.created_at')
            ->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTopicsRequest  $request
     * @param  \App\Models\Topics  $topics
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTopicsRequest $request, Topics $topics)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Topics  $topics
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topics $topics)
    {
        //
    }
}
