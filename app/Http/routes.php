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

	//Settings
	// Route::get('settings/profile', 'SettingsController@profile')->name('settings.profile');
	// Route::post('settings/profile', 'SettingsController@update')->name('settings.update');
	// Route::get('settings/template', 'SettingsController@template')->name('settings.template');
	// Route::get('settings/format', 'SettingsController@template')->name('settings.format');
	// Route::get('settings/policy', 'SettingsController@policy')->name('settings.policy');
	// Route::post('settings/policy', 'SettingsController@policyUpload')->name('settings.policy.upload');
});

Route::get('policy', function(){
		$policy = auth()->user()->company->policy;
		return view('share.policy', compact('policy'));
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
    Route::group(['prefix' => 'tickets', 'as' => 'tickets.'], function() {
		Route::get('/search', 'TicketsController@search')->name('search');
		Route::get('/picked', 'TicketsController@picked')->name('picked');
		Route::get('/checkout', 'TicketsController@checkout')->name('checkout');
		Route::post('/pay', 'TicketsController@pay')->name('pay');
		Route::get('/thankyou/{id}', 'TicketsController@thankyou')->name('thankyou');
		Route::get('/{id}/invoice', function ($id) {
			$v_id = App\Transaction::findOrFail($id)->invoice_id;
		    $invoice = Auth::user()->findInvoiceOrFail($v_id);
		    return $invoice->view([
		        'vendor' => 'TriponBus',
		        'product' => 'Bus Ticket'
		    ]);
		})->name('invoice');
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

});

Route::group(['middleware' => ['web']], function () {
	Route::resource('admin/rents', 'Backend\\RentsController');
});