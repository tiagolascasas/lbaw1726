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

// Authentication


Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('register', 'Auth\RegisterController@register');


Route::get('/', function () {
    return redirect('home');
});

// Home
Route::get('home', 'HomeController@show');

// Create Auction
Route::get('create', 'CreateAuctionController@show');

// Auction Item Page
Route::get('auction/{id}', 'AuctionController@show');
