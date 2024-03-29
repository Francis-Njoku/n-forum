<?php


use App\Http\Controllers\BooksController;
use App\Http\Controllers\CharactersController;
use App\Http\Controllers\TopicsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/books', [BooksController::class, 'getBooks']);

Route::get('/handle', [BooksController::class, 'handle']);

Route::get('/characters', [CharactersController::class, 'index']);


Route::get('/topic/{id}/category', [TopicsController::class, 'listCategory']);
