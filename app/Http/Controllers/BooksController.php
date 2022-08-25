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

    /*public function handle(): void
    {
        $this->info('retrieve all languages from ozh/github-colors');
        $languages = Http::get('https://raw.githubusercontent.com/ozh/github-colors/master/colors.json')
            ->collect()
            ->put('VimL', ['color' => null])
            ->put('Arduino', ['color' => null])
            ->put('Eagle', ['color' => null])
            ->put('Nginx', ['color' => null])
            ->map(fn (array $language, string $name): array => array_merge(
                $language,
                [
                    'name' => $name,
                    'enum' => (string) Str::of($name)
                        ->slug('_')
                        ->upper(),
                ]
            ))
            ->map(fn (array $language): array => array_merge($language, [
                'enum' => match ($language['name']) {
                    "C" => 'C_PLUSPLUS',
                    'Objective-C++' => 'OBJECTIVE_C_PLUSPLUS',
                    'C#' => 'C_SHARP',
                    'F#' => 'F_SHARP',
                    'Q#' => 'Q_SHARP',
                    default => $language['enum'],
                },
            ]))
            ->map(fn (array $language): array => Arr::only($language, ['name', 'enum', 'color']))
            ->sortBy('name')
            ->values();
        //
    }**/

    public function getId($param)
    {
        $lastItem = explode('/', $param);
        return end($lastItem);
    }

    public static function getBooks()
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get(env('EXTERNAL_API') . 'books');
        $response = $request->getBody()->getContents();

        $response2 =
            Http::get('https://anapioficeandfire.com/api/books');

        // Decode JSON    
        $er =  json_decode($response, true);

        $sort_date = array_column($er, 'released');
        array_multisort($sort_date, SORT_DESC, $er);

        /*foreach ($er as $e) {

            foreach ($e as $a => $value) {
                print_r([$a . '' . $value]);
            }
        }*/


        /*$flagValue = "1";
        $csmap_data = array_map(function ($arr) use ($flagValue) {
            return $arr[0] + ['flag' => $flagValue];
        }, $er);*/

        /*foreach ($er as $key => $csm) {
            //$csmap_data[$key]['flag'] = 1;
            print_r($er[$key][1]);
        }*/
        /*($a = array(["id" => "1"]);
        array_push($err, $a);*/

        //$er[0]['id'] = '1';






        //return $er[1];

        //echo count($er);
        #$arr = response()->json($response2);

        #$er = json_decode($arr);
        #print_r(count($er));
        //echo '<pre>';
        //print_r($response);
        # exit;

        //$er[0]['id'] = '1';
        //print_r($er[0]["url"]);

        foreach ($er as $key => $csm) {
            $er[$key]['id'] = self::getId($er[$key]['url']);
        }

        /*$post = Comments::query()
            ->joinSub($er, 'books', function ($join) {
                $join->on('comments.postid', '=', 'books.id');
            })->get();*/

        $array2 = DB::table('comments')
            ->select('postid', DB::raw('count(*) as total'))
            ->groupBy('postid')
            ->get();


        $array3 = json_decode($array2, true);

        //return $array2;

        /*$output = array();
        foreach ($array1 as $key => $value) {
            if (!isset($output[$key]))
                $output[$key] = array();
            $output[$key][] = $value;
        }
        foreach ($array2 as $key => $value) {
            if (!isset($output[$key]))
                $output[$key] = array();
            $output[$key][] = $value;
        }
        return $output;


        return $er; */

        //return $array3;

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get(env('EXTERNAL_API') . 'books');
        $response = $request->getBody()->getContents();

        $response2 =
            Http::get('https://anapioficeandfire.com/api/books');

        // Decode JSON    
        $er =  json_decode($response, true);

        $sort_date = array_column($er, 'released');
        array_multisort($sort_date, SORT_DESC, $er);

        foreach ($er as $key => $csm) {
            $er[$key]['id'] = self::getId($er[$key]['url']);
        }

        $array2 = DB::table('comments')
            ->select('postid', DB::raw('count(*) as total'))
            ->groupBy('postid')
            ->get();


        $array3 = json_decode($array2, true);

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
        $response =
            Http::get('https://anapioficeandfire.com/api/books/' . $id);

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
