<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryTrendingResource;
use App\Models\Topics;
use Carbon\Carbon;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CategoryResource::collection(Category::where('categories.status', '1')->paginate(3));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
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

        return CategoryTrendingResource::collection(Category
            ::join('topics_category as tsc', 'tsc.category_id', '=', 'categories.id')
            ->join('topics as ts', 'ts.id', '=', 'tsc.topic_id')
            ->join('topic_comments as tc', 'tc.topic_id', '=', 'tsc.id')
            ->selectRaw('count(tc.topic_id) as counter, categories.name as name, categories.slug as slug, categories.created_at as created_at')
            ->where('categories.status', 1)
            ->where('ts.created_at', '>=', $date)
            ->groupBy('categories.name', 'categories.slug', 'categories.created_at')
            ->get());
    }

    /**
     * Display the Followed topics resource.
     *
     * @param  \App\Models\Category  $categories
     * @return \Illuminate\Http\Response
     */
    public function followed()
    {
        #$date = Carbon::now()->subDays(7);

        return CategoryResource::collection(Category
            ::join('followed_category as fc', 'fc.category_id', '=', 'categories.id')
            ->where('categories.status', 1)
            ->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
