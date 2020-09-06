<?php

use Illuminate\Support\Facades\Auth;
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


Auth::routes();

Route::get('/', 'PostController@index')->name('home');
Route::get('/posts/{id}', 'PostController@show')->name('post.show')->where('id', '\d+');

Route::middleware('auth')->group(function() {
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    Route::get('/posts/add', 'PostController@create')->name('post.add');
    Route::get('/posts/{post}/edit', 'PostController@edit')->name('post.edit')->middleware('owner.post');
});

