<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentsRequest;
use App\Http\Requests\UpdateCommentsRequest;
use App\Http\Resources\CommentResource;

class CommentsController extends Controller
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

    // Get book id
    public function getId($param)
    {
        $lastItem = explode('/', $param);
        return end($lastItem);
    }

    // find book id
    public function checkPostID($postid)
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get(env('EXTERNAL_API') . 'books');
        $response = $request->getBody()->getContents();

        // Decode JSON    
        $er =  json_decode($response, true);

        foreach ($er as $key => $csm) {
            $er[$key]['id'] = self::getId($er[$key]['url']);
        }

        return array_search($postid, array_column($er, 'id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCommentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentsRequest $request)
    {


        $data = $request->validated();

        // Check if book exist
        if (self::checkPostID($data['postid'])) {
            $data['ip'] = \Request::ip();

            $comment = Comment::create($data);

            return new CommentResource($comment);
        } else {
            return response([
                'error' => 'The book id does not exist'
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comments  $comments
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommentsRequest  $request
     * @param  \App\Models\Comments  $comments
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentsRequest $request, Comment $comments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comments  $comments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comments)
    {
        //
    }
}
