<?php

namespace App\Http\Controllers;

use App\Models\Characters;
use App\Http\Requests\StoreCharactersRequest;
use App\Http\Requests\UpdateCharactersRequest;
use Illuminate\Support\Facades\Http;

class CharactersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getId($param)
    {
        $lastItem = explode('/', $param);
        return end($lastItem);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response =
            Http::get('https://anapioficeandfire.com/api/books');

        $er =  json_decode($response, true);

        return $er;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCharactersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCharactersRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Characters  $characters
     * @return \Illuminate\Http\Response
     */
    public function show(Characters $characters)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCharactersRequest  $request
     * @param  \App\Models\Characters  $characters
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCharactersRequest $request, Characters $characters)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Characters  $characters
     * @return \Illuminate\Http\Response
     */
    public function destroy(Characters $characters)
    {
        //
    }
}
