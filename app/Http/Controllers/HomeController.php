<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\City;
use App\Transaction;
use App\Http\Controllers\TicketsController;
use Illuminate\Http\Request;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = $this->cityNames();
        return view('frontend.home', compact('cities'));
    }

    public function cityNames()
    {
        $city_list = City::all();
        $cities = [];
        foreach ( $city_list as $city ) {
            $cities[$city->id] = $city->city . ', ' . $city->state;
        }
        return $cities;
    }

    /**
     * find booking thru booking no
     *
     * @return redirect
     * @author me
     **/
    public function bookingSearch(Request $request)
    {
        if (Transaction::byBookingNo($request->booking_no)->count() == 0)
        {
            Session::flash('danger', 'No booking found!');
            return redirect()->back()->with(['booking' => true]);
        } else {
            return redirect()->route('tickets.thankyou', $request->booking_no);
        }
    }

}
