<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('/dvds/search', 'DvdController@search');
Route::get('/dvds/create', 'DvdController@create');

Route::get('/dvds', 'DvdController@results');
Route::post('/dvds', 'DvdController@addDvd');

Route::get('/dvds/{id}', 'DvdController@detail');
Route::post('/dvds/{id}/reviews', 'DvdController@addReview');

Route::get('/genres/{genre_name}/dvds', 'DvdController@dvdGenre');
