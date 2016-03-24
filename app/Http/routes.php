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

    Route::get('/', 'HomeController@index');	
    	
	Route::post('/tickets/search', 'HomeController@search');

	Route::get('/tickets/search', function(){
		$trips = App\Trip::all();

		 // dd($trips);
		// dd($trips->first()->stations->first()->pivot);
		// $date = date('Y-m-d', time());
		// dd($date);
		return view('frontend.tickets.search', compact('trips'));
	});

	Route::post('/tickets/picked', function(){
		dd(Request::all());
	});

	Route::get('/tickets/detailed', function(){
		return view('frontend.tickets.detailed');
	});

	Route::get('/tickets/booking', function(){
		return view('frontend.tickets.booking');
	});

	Route::get('/tickets/confirmed', function(){
		return view('frontend.tickets.thankyou');
	});

});
