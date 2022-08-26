<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SurveryController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\TopicsController;
use App\Http\Controllers\BooksController;
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

    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::apiResource('/category', CategoryController::class);


Route::post('/register', [AuthController::class, 'register']);
Route::post('/sign-up', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::get('/characters', [CharactersController::class, 'index']);
Route::get('/books', [BooksController::class, 'index']);
Route::get('/book/{id}', [BooksController::class, 'show']);
