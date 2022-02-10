<?php
namespace Modules\Post\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Post\Http\Controllers\PostController;

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

Route::middleware('auth:api')->get('/post', function (Request $request) {
    return $request->user();
});

// Post Public Route
Route::get('/post', [PostController::class,'index']);
Route::get('/post/{id}', [PostController::class ,'show']);

// Post Private Route
Route::post('/createNewPost', [PostController::class ,'createNewPost']);
Route::put('/updatePost/{id}', [PostController::class ,'updatePost']);
Route::delete('/deletePost/{id}', [PostController::class ,'deletePost']);