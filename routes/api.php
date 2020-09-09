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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::get('/posts', 'PostController@getAllPosts')->name('api.allPosts');

Route::get('/comments/{post}', 'CommentController@index')->name('api.comment.index');
Route::post('/comments/{post}', 'CommentController@store')->name('api.comment.store');
Route::get('/comments/{comment}/report','CommentController@report')->name('api.comment.report');


Route::middleware('auth:api')->group(function() {
   Route::post('/posts', 'PostController@store')->name('api.post.store');
   Route::put('/posts/{post}/edit', 'PostController@update')->name('api.post.update');
   Route::get('/posts/mine', 'HomeController@getAllPostForAuthUser')->name('api.allPosts.owner');
   Route::delete('/posts/{post}', 'PostController@destroy')->name('api.post.destroy')->middleware('owner.post');
});

