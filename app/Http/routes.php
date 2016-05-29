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
	Route::post('buses/{id}/photo', 'BusesController@addPhoto')->name('buses.addPhoto');
	
	//Company
	Route::resource('companies', 'CompaniesController');

	//Trip
	Route::resource('trips', 'TripsController');
	Route::post('trips/{id}/active', 'TripsController@active')->name('trips.active');

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
	Route::post('rentals/{id}/active', 'RentalsController@active')->name('rentals.active');

	// Settings
	Route::get('settings/profile', 'SettingsController@profile')->name('settings.profile');
	Route::post('settings/profile', 'SettingsController@update')->name('settings.update');
	Route::get('settings/template', 'SettingsController@template')->name('settings.template');
	Route::get('settings/format', 'SettingsController@template')->name('settings.format');
	Route::get('settings/policy', 'SettingsController@policy')->name('settings.policy');
	Route::post('settings/policy', 'SettingsController@policyUpload')->name('settings.policy.upload');
});

Route::group(['middleware' => 'web'], function () {

    Route::auth();

    Route::get('/', 'HomeController@index')->name('home');	

    //User
    Route::group(['prefix' => 'users', 'as' => 'user.', 'middleware' => 'auth'], function() {
		Route::get('/booking', 'UsersController@booking')->name('booking');
	    Route::get('/profile', 'UsersController@profile')->name('profile');
	    Route::get('/setting', 'UsersController@setting')->name('setting');
	    Route::get('/edit', 'UsersController@edit')->name('edit');
	    Route::patch('/update', 'UsersController@update')->name('update');
    });

    //Tickets
    Route::group(['prefix' => 'tickets', 'as' => 'tickets.'], function() {
		Route::get('/search', 'TicketsController@search')->name('search');
		Route::get('/picked', 'TicketsController@picked')->name('picked');
		Route::get('/checkout', 'TicketsController@checkout')->name('checkout');
		Route::post('/pay', 'TicketsController@pay')->name('pay');
		Route::get('/thankyou/{booking_no}', 'TicketsController@thankyou')->name('thankyou');
		Route::get('/{invoice_id}/invoice', 'TicketsController@invoice')->name('invoice');
    });

	//Rentals
	Route::group(['prefix' => 'rentals', 'as' => 'rentals.'], function() {
		Route::get('/search', 'RentalsController@search')->name('search');
		Route::get('/', 'RentalsController@index')->name('index');
		Route::get('/show', 'RentalsController@show')->name('show');
		Route::get('/booking', 'RentalsController@booking')->name('booking');
		Route::post('/confirm', 'RentalsController@confirm')->name('confirm');
		Route::get('/thankyou/{id}', 'RentalsController@thankyou')->name('thankyou');
    });

    Route::get('/{id}/policy', function($id){
    	$policy = App\Company::findOrFail($id)->policy;
		return view('share.policy', compact('policy'));
    })->name('policy');

});
