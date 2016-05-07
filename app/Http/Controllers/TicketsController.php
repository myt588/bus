<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Trip;
use App\Station;
use App\Ticket;
use App\Transaction;
use App\User;
use App\Fare;
use App\Http\Requests;

use DB;
use Auth;
use Log;

use App\Http\Requests\HomeSearchRequest;
use App\Http\Requests\TicketCheckoutRequest;

class TicketsController extends Controller
{
    public function search(HomeSearchRequest $request)
    {
        $cities = $this->cityNames();
        $data = $request->all();
        if (array_key_exists('trip_one_id', $data)){
            if (array_key_exists('date_new', $data)){
                $data['return'] = dateMath($data['return'], $data['date_new']);
                unset($data['date_new']);
            } 
            $date_bit = stringToWeekday($data['return']);
            $date_list = getDateList($data['return']);
            $trips = $this->searchTrip($data['going_to'], $data['leaving_from'], $data['return']);
        } else {
            if (array_key_exists('date_new', $data)){
                $data['depart'] = dateMath($data['depart'], $data['date_new']);
                unset($data['date_new']);
            } 
            $date_bit = stringToWeekday($data['depart']);
            $date_list = getDateList($data['depart']); 
            $trips = $this->searchTrip($data['leaving_from'], $data['going_to'], $data['depart']);
        }                                                     
        return view('frontend.tickets.search', compact('trips', 'date_list', 'data', 'cities'));
    }

    public function searchTrip($from, $to, $weekdays)
    {
        $trips = Trip::where('from', '=', $from)
                     ->where('to', '=', $to)
                     ->where('weekdays', '&', $weekdays)
                  // ->where('ticket_left', '>', $request->adults)
                     ->get();
        return $trips;
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

    public function pay(TicketCheckoutRequest $request)
    {
         // dd($request->all());
        //user is logged in
        $data = $request->all();
        if (Auth::check()){
            $user = Auth::user();
        } else {
            if (!is_null(User::where('email', '=', $request->email)->first()) ) {
                $user = User::where('email', '=', $request->email)->first();
            } else {
                $user = User::create([
                    'first_name'    => $request->first_name,
                    'last_name'     => $request->last_name,
                    'email'         => $request->email,
                ]);
            }
        }
        $user->charge($request->totalPrice * 100, [
            'source' => $request->stripeToken
            ]);
        $transaction = Transaction::create([
            'company_id'            => Trip::findOrFail($request->trip_one_id)->company->id,
            'quantity'              => $request->totalPrice,
            'confirmation_number'   => random('distinct', 8),
            'description'           => "tickets price",
            ]);
        $amount_depart = $request->adults_depart + $request->kids_depart + 1;
        $this->createTicket($request->adults_depart,
                            $user->id, 
                            $request->trip_one_id, 
                            $transaction->id, 
                            $data, 
                            $request->depart,
                            $request->trip_one_DS, 
                            $request->trip_one_AS, 
                            'adults_depart');
        $this->createTicket($request->kids_depart, 
                            $user->id, 
                            $request->trip_one_id, 
                            $transaction->id, 
                            $data, 
                            $request->depart,
                            $request->trip_one_DS, 
                            $request->trip_one_AS, 
                            'kids_depart');
        if (array_key_exists('trip_two_id', $data)){
            $this->createTicket(
                            $request->adults_return,
                            $user->id, 
                            $request->trip_two_id, 
                            $transaction->id, 
                            $data, 
                            $request->return,
                            $request->trip_two_DS, 
                            $request->trip_two_AS, 
                            'adults_return');
            $this->createTicket(
                            $request->kids_return,
                            $user->id, 
                            $request->trip_two_id, 
                            $transaction->id, 
                            $data, 
                            $request->return,
                            $request->trip_two_DS, 
                            $request->trip_two_AS, 
                            'kids_return');
        }
        return redirect()->route('tickets.thankyou', $transaction->id);
    }

    public function createTicket($amount, $user_id, $trip_id, $transaction_id, $data, $depart_date, $depart_station, $arrive_station, $name)
    {
        for ($i = 1 ; $i < $amount + 1 ; $i ++)
        {
            Ticket::create([
                'user_id'           => $user_id,
                'trip_id'           => $trip_id,
                'transaction_id'    => $transaction_id,
                'description'       => $data[$name . '_' . $i],
                'depart_date'       => stringToDate($depart_date),
                'depart_station'    => $depart_station,
                'arrive_station'    => $arrive_station,
                ]);
        }
    }

    public function thankyou($id)
    {
        $transaction = Transaction::findOrFail($id);
        $tickets = $transaction->tickets;
        return view('frontend.tickets.thankyou', compact('transaction', 'tickets'));
    }
}
