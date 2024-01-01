<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\CharactersController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
<<<<<<< HEAD
    Route::get('/profile', [ProfileController::class, 'index']);
=======
>>>>>>> e64e500b3cbfe4a8adf3d7191c1074c7c38af76b

    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::apiResource('/category', CategoryController::class);


Route::post('/register', [AuthController::class, 'register']);
Route::post('/sign-up', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
<<<<<<< HEAD
Route::post('/sto', [ItemController::class, 'store2']);
Route::get('/topic', [TopicsController::class, 'index']);
Route::get('/topic/{id}/category', [TopicsController::class, 'listCategory']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/trending', [TopicsController::class, 'topTrending']);
Route::get('/categories/trending', [CategoryController::class, 'topTrending']);
Route::get('/followed/topics', [TopicsController::class, 'followed']);
Route::get('/followed/categories', [CategoryController::class, 'followed']);
=======


Route::get('/characters', [CharactersController::class, 'index']);
Route::get('/books', [BooksController::class, 'index']);
Route::get('/book/{id}', [BooksController::class, 'show']);
Route::post('/comment', [CommentsController::class, 'store']);
>>>>>>> e64e500b3cbfe4a8adf3d7191c1074c7c38af76b
