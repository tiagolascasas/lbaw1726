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

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

Route::get('/', function () {
    return redirect('home');
});

// Home
Route::get('home', 'HomeController@show');

// Create Auction
Route::get('create', 'CreateAuctionController@show')->name('create');
Route::post('create', 'CreateAuctionController@create');

// Auction Item Page
Route::get('auction/{id}', 'AuctionController@show');

// Profile Page
Route::get('profile/{id}', 'ProfileController@show')->name('profile');

//API
Route::get('/api/search', 'API\SearchController@index');

