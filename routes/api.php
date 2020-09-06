<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/posts', 'PostController@getAllPosts')->name('api.allPosts');

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::middleware('auth:api')->group(function() {
   Route::post('/posts', 'PostController@store')->name('api.post.store');
   Route::put('/posts/{post}/edit', 'PostController@update')->name('api.post.update');
   Route::get('/posts/mine', 'HomeController@getAllPostForAuthUser')->name('api.allPosts.owner');
   Route::delete('/posts/{post}', 'PostController@destroy')->name('api.post.destroy')->middleware('owner.post');
});

