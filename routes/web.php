<?php

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
    return redirect()->route('index', ['id' => 1]);
})->name('home');

Route::get('/user/{id}', 'UserController@index')->name('index');
Route::get('/user/{id}/comment', 'UserController@commentForm')->name('comment');
Route::post('/user/{id}/comment', 'UserController@saveComment')->name('comment.save');
Route::post('/user/{id}/json-comment', 'UserController@saveJsonComment')->name('jsonComment.save');