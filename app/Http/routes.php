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

Route::group(['middleware' => ['web', 'auth', 'admin'], 'namespace' =>'Backend', 'as' => 'admin::', 'prefix' => 'admin'], function()
{
	Route::get('dashboard', function () {
    	return view('backend.dashboard');
	})->name('dashboard');

	Route::get('reports/tickets/booking', 'ReportsController@ticketsBooking')->name('reports.tickets.booking');

	Route::get('reports/tickets/passengers/{id}', 'ReportsController@passengersList')->name('reports.tickets.passengers');

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

    Route::get('/user/dashboard', 'UsersController@dashboard')->name('users.dashboard')->middleware('auth');

    Route::get('/home', function() {
    	return view('home');
    });

    Route::get('/', 'HomeController@index')->name('home');	

    //Tickets

	Route::get('/tickets/search', 'TicketsController@search')->name('tickets.search');

	Route::get('/tickets/picked', 'TicketsController@picked')->name('tickets.picked');

	Route::get('/tickets/checkout', 'TicketsController@checkout')->name('tickets.checkout');

	Route::post('/tickets/pay', 'TicketsController@pay')->name('tickets.pay');

	Route::get('/tickets/thankyou/{id}', 'TicketsController@thankyou')->name('tickets.thankyou');

	//Rentals

	Route::get('/rentals/search', 'RentalsController@search')->name('rentals.search');

	Route::get('/rentals', 'RentalsController@index')->name('rentals.index');

	Route::get('/rentals/show', 'RentalsController@show')->name('rentals.show');

	Route::get('/rentals/booking', 'RentalsController@booking')->name('rentals.booking');

	Route::post('/rentals/confirm', 'RentalsController@confirm')->name('rentals.confirm');

	Route::get('/rentals/thankyou/{id}', 'RentalsController@thankyou')->name('rentals.thankyou');



});

Route::group(['middleware' => ['web']], function () {
	Route::resource('admin/rents', 'Backend\\RentsController');
});