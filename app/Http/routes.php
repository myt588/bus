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



Route::group(['middleware' => ['web', 'auth', 'admin'], 'namespace' =>'Backend', 'as' => 'admin::', 'prefix' => 'admin'], function()
{
	Route::get('admin', function () {
    	return view('backend.dashboard');
	});

	//Bus
	Route::resource('buses', 'BusesController');
	
	//Company
	Route::resource('companies', 'CompaniesController');

	//Trip
	Route::resource('trips', 'TripsController');

	//Stop
	Route::resource('stations', 'StationsController');

	//Fare
	Route::resource('fares', 'FaresController');

	//Ticket
	Route::resource('tickets', 'TicketsController');

	//Transactions
	Route::resource('transactions', 'TransactionsController');

	//Rentals
	Route::resource('rentals', 'RentalsController');

});

Route::group(['middleware' => 'web'], function () {

    Route::auth();

    Route::get('/home', function() {
    	return view('home');
    });

    Route::get('/', 'HomeController@index')->name('home');	

	Route::get('/tickets/search', 'HomeController@search')->name('tickets.search');

	Route::get('/tickets/picked', 'HomeController@picked')->name('tickets.picked');

	Route::get('/tickets/checkout', 'HomeController@checkout')->name('tickets.checkout');

	Route::post('/tickets/pay', 'HomeController@pay')->name('tickets.pay');

	Route::get('/tickets/confirmed', function(){
		return view('frontend.tickets.thankyou');
	});

});
