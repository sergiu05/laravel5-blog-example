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

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => 'store', 'as' => 'store::'], function() {
	Route::get('/', 'StoreController@index')->name('index');
	Route::get('/browse', 'StoreController@browse')->name('browse');
	Route::get('/details/{id}', 'StoreController@show')->name('show')->where('id', '[0-9]+');
});

Route::group(['prefix' => 'admin', 'as' => 'admin::'], function() {
	Route::resource('albums', 'StoreManagerController');
});

# authentication routes
Route::get('auth/login', 'Auth\AuthController@getLogin')->name('login');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout')->name('logout');

# registration routes
Route::get('auth/register', 'Auth\AuthController@getRegister')->name('register');
Route::post('auth/register', 'Auth\AuthController@postRegister');
