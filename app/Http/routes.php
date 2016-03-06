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

#homepage route
Route::get('/', 'HomeController@index')->name('home');

#website routes
Route::group(['prefix' => 'store', 'as' => 'store::'], function() {
	Route::get('/', 'StoreController@index')->name('index');
	Route::get('/browse', 'StoreController@browse')->name('browse');
	Route::get('/details/{id}', 'StoreController@show')->name('show')->where('id', '[0-9]+');
});

Route::get('/checkout', 'ShoppingCartController@index')->middleware('auth')->name('checkout');
Route::post('/addtocart/{id}', 'ShoppingCartController@addToCart')->name('addToCart')->where('id', '[0-9]+');
Route::post('/removefromcart/{id}', 'ShoppingCartController@removeFromCart')->name('removeFromCart')->where('id', '[0-9]+');
Route::post('/updatecart/{id}/{qty}', 'ShoppingCartController@updateCart')->name('updateCart')->where('id', '[0-9]+')->where('qty', '[0-9]+');

#dashboard routes
Route::group([
		'prefix' => 'admin', 		
		'middleware' => ['auth', 'admin']
	], function() {

	# admin albums routes	
	Route::get('/', 'StoreManagerController@welcome')->name('dashboard');
	Route::resource('albums', 'StoreManagerController', ['except' => ['show']]);
	
	# admin genres routes
	Route::get('/genres', 'StoreManagerGenreController@index');
	Route::get('/genres/show/{genrename}', 'StoreManagerGenreController@show')->name('admin.genres.show');
	Route::post('/genres', 'StoreManagerGenreController@store');	
	Route::delete('/genres/{genre}', 'StoreManagerGenreController@destroy'); /* route model binding */
	
	#admin artists routes
	Route::resource('artists', 'StoreManagerArtistController');
});

# authentication routes
Route::get('auth/login', 'Auth\AuthController@getLogin')->name('login');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout')->name('logout');

# registration routes
Route::get('auth/register', 'Auth\AuthController@getRegister')->name('register');
Route::post('auth/register', 'Auth\AuthController@postRegister');
