<?php

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
    return view('index');
});

Route::post('url_create','ShorturlsController@create');
Route::get('get_url','ShorturlsController@geturls');
Route::get('get_url1','ShorturlsController@geturls1');

Route::get('{val}','ShorturlsController@show')->name('shorturl.link');