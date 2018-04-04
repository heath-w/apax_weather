<?php

use Illuminate\Http\Request;
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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/error', function () {
    return view('error');
});

Auth::routes();

Route::get('/home', ['middleware' => 'auth', 'uses' => 'UserLocationController@index'])->name('home');

Route::post('/search', ['middleware' => 'auth', 'uses' => 'SearchController@search'])->name('search');

Route::resource('userLocations', 'UserLocationController');





