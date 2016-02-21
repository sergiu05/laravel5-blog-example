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

Route::get('/', 'HomeController@index');

Route::group(['prefix' => 'store', 'as' => 'store::'], function() {
	Route::get('/', 'StoreController@index')->name('index');
	Route::get('/browse', 'StoreController@browse')->name('browse');
	Route::get('/details/{id}', 'StoreController@show')->name('show')->where('id', '[0-9]+');
});
