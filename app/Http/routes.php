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

// Route::get('/', function () {
//     return view('index');
// });

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('admin', function () {
    return view('backend.dashboard');
});

Route::group(['middleware' => ['web', 'auth', 'admin'], 'namespace'=>'Backend', 'as' => 'admin::', 'prefix' => 'admin'], function()
{
	//Bus
	Route::resource('buses', 'BusesController');
	
	//Company
	Route::resource('companies', 'CompaniesController');

	//Trip
	Route::resource('trips', 'TripsController');

	//Stop
	Route::resource('stations', 'StationsController');

	//Ticket
	Route::resource('tickets', 'TicketsController');

});

Route::group(['middleware' => 'web'], function () {
	
    Route::auth();

    Route::get('/home', 'HomeController@index');
});
