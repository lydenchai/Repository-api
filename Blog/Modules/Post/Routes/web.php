<?php
namespace Modules\Post\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Post\Http\Controllers\PostController;

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

// Route::prefix('post')->group(function() {
//     Route::get('/', 'PostController@index');
// });

Route::get('/', function () {
    return redirect('/post');
});

Route::resource('post', PostController::class);