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
	//Dashboard
	Route::get('dashboard', 'DashboardController@dashboard')->name('dashboard');
	Route::get('/', 'DashboardController@admin')->name('site.admin');

	//Bus
	Route::resource('buses', 'BusesController');
	Route::post('buses/{id}/photo', 'BusesController@addPhoto')->name('buses.addPhoto');
	
	//Company
	Route::resource('companies', 'CompaniesController');

	//Trip
	Route::resource('trips', 'TripsController');
	Route::post('trips/{id}/active', 'TripsController@active')->name('trips.active');

	//Rental
	Route::resource('rentals', 'RentalsController');
	Route::post('rentals/{id}/active', 'RentalsController@active')->name('rentals.active');

	//Stop
	Route::resource('stations', 'StationsController');

	//Ticket
	Route::get('tickets/bookings', 'TicketsController@bookings')->name('tickets.bookings');
	Route::get('tickets/sales', 'TicketsController@sales')->name('tickets.sales');
	Route::get('tickets/{id}', 'TicketsController@show')->name('tickets.show');

	//Rent
	Route::get('rents', 'RentsController@index')->name('rents.bookings');

	//Settings
	Route::group(['prefix' => 'settings', 'as' => 'settings.'], function() {
		Route::get('/profile', 'SettingsController@profile')->name('profile');
		Route::post('/profile', 'SettingsController@update')->name('update');
		Route::get('/template', 'SettingsController@template')->name('template');
		Route::get('/format', 'SettingsController@template')->name('format');
		Route::get('/policy', 'SettingsController@policy')->name('policy');
		Route::post('/policy', 'SettingsController@policyUpload')->name('policy.upload');
		Route::get('/site', 'SettingsController@siteSetting')->name('site');
		Route::post('/site', 'SettingsController@siteSettingUpload')->name('site.upload');
		Route::get('/payment', 'SettingsController@payment')->name('site.payment');
		Route::post('/payment', 'SettingsController@paymentUpload')->name('site.payment.upload');
    });
	
});

Route::group(['middleware' => 'web'], function () {

    Route::auth();

    Route::get('/', 'HomeController@index')->name('home');	
    Route::post('/search/booking', 'HomeController@bookingSearch')->name('search.booking');

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

    Route::get('/policy', function(){
    	$policy = App\Metas::byKey('site_policy')->first()->value;
		return view('share.policy', compact('policy'));
    })->name('site.policy');

});
