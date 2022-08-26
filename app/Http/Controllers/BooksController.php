<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Http\Requests\StoreBooksRequest;
use App\Http\Requests\UpdateBooksRequest;
use App\Models\Comments;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class BooksController extends Controller
{
    /**
     * Get id from string.
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
        $client = new \GuzzleHttp\Client();
        $request = $client->get(env('EXTERNAL_API') . 'books');
        $response = $request->getBody()->getContents();

        // Decode JSON    
        $er =  json_decode($response, true);

        // Sort array by date
        $sort_date = array_column($er, 'released');
        array_multisort($sort_date, SORT_DESC, $er);

        // add id to array
        foreach ($er as $key => $csm) {
            $er[$key]['id'] = self::getId($er[$key]['url']);
        }

        // Group comments
        $array2 = DB::table('comments')
            ->select('postid', DB::raw('count(*) as total'))
            ->groupBy('postid')
            ->get();


        $array3 = json_decode($array2, true);

        // Join books with comments
        $combined = array();
        foreach ($er as $arr) {
            $comb = array('id' => $arr['id'], 'authors' => array($arr['authors']), 'name' => $arr['name']);
            foreach ($array3 as $arr2) {
                if ($arr2['postid'] == $arr['id']) {
                    $comb['comments'] = $arr2['total'];

                    break;
                } else {
                    $comb['comments'] = 0;
                }
            }
            $combined[] = $comb;
        }

        return $combined;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBooksRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBooksRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Books  $books
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get HTTP 

        $client = new \GuzzleHttp\Client();
        $request = $client->get(env('EXTERNAL_API') . 'books/' . $id);
        $response = $request->getBody()->getContents();

        // Decode JSON    
        $book =  json_decode($response, true);

        //return $er;


        $getcomm = DB::table('comments')
            ->select('postid', 'id', 'comment', 'status')
            ->where('postid', $id)
            ->get();

        $getcomment = json_decode($getcomm, true);


        if ($getcomment) {
            $comment = $getcomment;
        } else {
            $comment = array("No comments", 400);
        }

        return [
            'book' => $book,
            'comment' => $comment

        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBooksRequest  $request
     * @param  \App\Models\Books  $books
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBooksRequest $request, Books $books)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Books  $books
     * @return \Illuminate\Http\Response
     */
    public function destroy(Books $books)
    {
        //
    }
}
