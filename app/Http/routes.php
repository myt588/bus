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
		$company = Auth::user()->company;
		$trips = $company->tripsBetweenDates('today', 'tomorrow');
		$orders = $company->transactions;
    	return view('backend.dashboard', compact('company', 'trips', 'orders'));
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
	Route::get('tickets/bookings', 'TicketsController@bookings')->name('tickets.bookings');
	Route::get('tickets/sales', 'TicketsController@sales')->name('tickets.sales');
	Route::get('tickets/{id}', 'TicketsController@show')->name('tickets.show');

	//Transactions
	Route::resource('transactions', 'TransactionsController');

	//Rentals
	Route::resource('rentals', 'RentalsController');

	Route::get('settings/profile', 'SettingsController@profile')->name('settings.profile');
	Route::post('settings/profile', 'SettingsController@update')->name('settings.update');
	Route::get('settings/template', 'SettingsController@template')->name('settings.template');
	Route::get('settings/format', 'SettingsController@template')->name('settings.format');
	Route::get('settings/policy', 'SettingsController@template')->name('settings.policy');

});

Route::group(['middleware' => 'web'], function () {

    Route::auth();

    Route::get('/user/booking', 'UsersController@booking')->name('user.booking')->middleware('auth');
    Route::get('/user/profile', 'UsersController@profile')->name('user.profile')->middleware('auth');
    Route::get('/user/setting', 'UsersController@setting')->name('user.setting')->middleware('auth');
    Route::get('/user/edit', 'UsersController@edit')->name('user.edit')->middleware('auth');
    Route::patch('/user/update/', 'UsersController@update')->name('user.update')->middleware('auth');

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