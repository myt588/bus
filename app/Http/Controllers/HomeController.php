<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\City;
use App\Trip;
use Illuminate\Http\Request;

use DB;

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
        $city_list = City::all();
        $cities = [];
        foreach ( $city_list as $city ) {
            $cities[$city->id] = $city->city . ', ' . $city->state;
        }
        return view('frontend.home', compact('cities'));
    }

    public function search(Request $request)
    {
        // dd($request->all());
        $date_from = stringToWeekday($request->date_from);
        // dd($date_from);
        if ($request->optionsRadios == 'round-trip'){
            dd('roundtrip');
        } else {
            $trips = Trip::where('from', '=', $request->leaving_from)->where('to', '=', $request->going_to)
                                                                     // ->where('weekdays', '&', $date_from)
                                                                  // ->where('ticket_left', '>', $request->adults)
                                                                     ->get();
            // dd($trips);
            $date = date('Y-m-d', time());
        }
        return view('frontend.tickets.search', compact('trips', 'date'));
    }
}
