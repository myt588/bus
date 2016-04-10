<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\City;
use App\Trip;
use App\Station;
use App\Ticket;
use App\Transaction;
use App\User;
use App\Fare;
use Illuminate\Http\Request;
use App\Http\Requests\HomeSearchRequest;

use DB;
use Auth;
use Log;

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

    public function search(HomeSearchRequest $request)
    {
        $cities = $this->cityNames();
        $data = $request->all();
        if ($data['options'] == 'round-trip'){
            $temp = $data['leaving_from'];
            $data['leaving_from'] = $data['going_to'];
            $data['going_to'] = $temp;
            if (array_key_exists('date_new', $data)){
                $data['return'] = dateMath($data['return'], $data['date_new']);
                unset($data['date_new']);
            } 
            $date_bit = stringToWeekday($data['return']);
            $date_list = getDateList($data['return']);
        } else {
            if (array_key_exists('date_new', $data)){
                $data['depart'] = dateMath($data['depart'], $data['date_new']);
                unset($data['date_new']);
            } 
            $date_bit = stringToWeekday($data['depart']);
            $date_list = getDateList($data['depart']);
        }
        
        $trips = Trip::where('from', '=', $data['leaving_from'])->where('to', '=', $data['going_to'])
                                                                 // ->where('weekdays', '&', $return)
                                                              // ->where('ticket_left', '>', $request->adults)
                                                                 ->get();                                                        
        return view('frontend.tickets.search', compact('trips', 'date_list', 'data', 'cities'));
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

    public function getTicketInfo($data)
    {
        $trip_one = Trip::findOrFail($data['trip_one_id']);
        $trip_one_DS = $trip_one->stations->find($data['trip_one_DS']);
        $trip_one_AS = $trip_one->stations->find($data['trip_one_AS']);
        if (array_key_exists('trip_two_id', $data)){
            $trip_two = Trip::findOrFail($data['trip_two_id']);
            $trip_two_DS = $trip_two->stations->find($data['trip_two_DS']);
            $trip_two_AS = $trip_two->stations->find($data['trip_two_DS']);
            return compact('trip_one', 'trip_one_DS', 'trip_one_AS', 'trip_two', 'trip_two_DS', 'trip_two_AS');
        }
        return compact('trip_one', 'trip_one_DS', 'trip_one_AS');
    }

    public function picked(Request $request)
    {
        $data = $request->all();
        $info = $this->getTicketInfo($data);
        return view('frontend.tickets.detailed', compact('data'), $info);
    }

    public function checkout(Request $request)
    {
        $data = $request->all();
        $info = $this->getTicketInfo($data);
        return view('frontend.tickets.checkout', compact('data'), $info);
    }

    public function pay(Request $request)
    {
        // user is logged in
        // if (Auth::check()){
        //     $user = Auth::user();
        // } else {
        //     if (!is_null(User::where('email', '=', $request->email)->first()) ) {
        //         $user = User::where('email', '=', $request->email)->first();
        //     } else {
        //         $user = User::create([
        //             'name'      => $request->first_name . ' ' . $request->last_name,
        //             'email'     => $request->email,
        //         ]);
        //     }
        // }
        // $user->charge($request->totalPrice * 100, [
        //     'source' => $request->stripeToken
        //     ]);
        // $transaction = Transaction::create([
        //     'quantity'          => Trip::findOrFail($request->trip_one_id)->farePrice(),
        //     'description'       => "tickets price",
        //     ]);
        // $ticket_one = Ticket::create([
        //     'user_id'           => $user->id,
        //     'fare_id'           => Trip::findOrFail($request->trip_one_id)->fares->first()->id,
        //     'transaction_id'    => $transaction->id,
        //     'description'       => 'testo',
        //     ]);
        // if (array_key_exists('trip_two_id', $request->all())){
        //     $ticket_two = Ticket::create([
        //     'user_id'           => $user->id,
        //     'fare_id'           => Trip::findOrFail($request->trip_two_id)->fares->first()->id,
        //     'transaction_id'    => $transaction->id,
        //     'description'       => 'testo',
        //     ]);
        // }
        $ticket_one = Ticket::find(13);
        return view('frontend.tickets.thankyou', compact('ticket_one'));
    }
}
