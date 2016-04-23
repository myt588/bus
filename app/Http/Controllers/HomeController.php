<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\City;
use Illuminate\Http\Request;

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

}
