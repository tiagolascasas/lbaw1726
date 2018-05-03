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
Route::get('home', 'HomeController@show')->name('home');

// Create Auction
Route::get('create', 'CreateAuctionController@show')->name('create');
Route::post('create', 'CreateAuctionController@create');

// Auction Item Page
Route::get('auction/{id}', 'AuctionController@show')->name('auction');

// Profile Page
Route::get('profile/{id}', 'ProfileController@show')->name('profile');
Route::post('profile/{id}/edit', 'ProfileController@editUser')->name('profile.edit');

//Contact
Route::get('contact', 'ContactController@show')->name('contact');
Route::post('contact', 'ContactController@message');

//FAQ
Route::get('faq', 'FaqController@show')->name('faq');

//About
Route::get('about', 'AboutController@show')->name('about');

//API
Route::get('api/search', 'API\SearchController@index');

//Search Page
Route::get('search', 'SearchController@show')->name('search');

//Moderator
Route::get('moderator','ModeratorController@show')->name('moderator');
Route::get('moderator/approve/{id}', 'ModeratorController@approve')->name('moderator.approve'); //change to post ajax
Route::get('moderator/remove/{id}', 'ModeratorController@remove')->name('moderator.remove'); //change to post ajax
Route::get('moderator/approve_mod/{id}', 'ModeratorController@approve_mod')->name('moderator.approve_mod'); //change to post ajax
Route::get('moderator/remove_mod/{id}', 'ModeratorController@remove_mod')->name('moderator.remove_mod'); //change to post ajax