<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
use URL;
use Mail;

use App\Http\Requests\HomeSearchRequest;
use App\Http\Requests\TicketCheckoutRequest;

class TicketsController extends Controller
{
    /**
     * Search for matching trips 
     *
     * @return View
     * @author Me
     **/
    public function search(HomeSearchRequest $request)
    {
        $data = $request->all();      
        if ($request->has('trip_one_id')){ 
            //When search for the 2nd trip of the round trip 
            $date_list = $this->dateHandler($data, 'return');
            $trips = Trip::search($data['going_to'], $data['leaving_from'], stringToWeekday($data['return']))->paginate(15);
        } else { 
            //When search for the 1st trip
            $date_list = $this->dateHandler($data, 'depart');
            $trips = Trip::search($data['leaving_from'], $data['going_to'], stringToWeekday($data['return']))->paginate(15);
        }                                                     
        return view('frontend.tickets.search', compact('trips', 'date_list', 'data'));
    }

    /**
     * Handling Date
     *
     * @return void
     * @author 
     **/
    public function dateHandler(&$data, $date)       
    {
         if (array_has($data, 'date_new')){
            $data['depart'] = dateMath($data['depart'], $data['date_new']);
            $data['return'] = dateMath($data['return'], $data['date_new']);
            unset($data['date_new']);
            Log::info($data);
        } 
        return getDateList($data[$date]);
    }

    /**
     * Show Detail View
     *
     * @return View
     * @author Me
     **/
    public function picked(Request $request)
    {
        $data = $request->all();
        $info = $this->getTicketInfo($data);
        return view('frontend.tickets.detailed', compact('data'), $info);
    }

    /**
     * Checkout View
     *
     * @return View
     * @author Me
     **/
    public function checkout(Request $request)
    {
        $data = $request->all();
        $info = $this->getTicketInfo($data);
        return view('frontend.tickets.checkout', compact('data'), $info);
    }

    /**
     * Get Ticket Info 
     *
     * @return Compact Data
     * @author Me
     **/
    public function getTicketInfo($data)
    {
        $trip_one = Trip::findOrFail($data['trip_one_id']);
        $trip_one_DS = $trip_one->stations->find($data['trip_one_DS']);
        $trip_one_AS = $trip_one->stations->find($data['trip_one_AS']);
        if (array_has($data, 'trip_two_id')){
            $trip_two = Trip::findOrFail($data['trip_two_id']);
            $trip_two_DS = $trip_two->stations->find($data['trip_two_DS']);
            $trip_two_AS = $trip_two->stations->find($data['trip_two_DS']);
            return compact('trip_one', 'trip_one_DS', 'trip_one_AS', 'trip_two', 'trip_two_DS', 'trip_two_AS');
        }
        return compact('trip_one', 'trip_one_DS', 'trip_one_AS');
    }

    /**
     * Pay Function
     *
     * @return Redirect
     * @author Me
     **/
    public function pay(TicketCheckoutRequest $request)
    {
        //user is logged in
        $data = $request->all();
        $user = $this->getOrCreateAnonymous($request);
        $invoice = $this->createInvoice($user, $request->totalPrice, $request->stripeToken);

        $transaction_one = Transaction::forTicket($company_id, $price, $invoice_id);
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
        // Mail::send('emails.ticket_confirmation', ['user' => $user, 'transaction' => $transaction], function ($m) use ($user) {
        //     $m->to($user->email, $user->name)->subject('Your Reminder!');
        // });
        return redirect()->route('tickets.thankyou', $transaction->id);
    }

    /**
     * Logic for creating proper invoice
     *
     * @return $invoice
     * @author Me
     **/
    public function createInvoice($user, $price, $token)
    {
        // check if the user is a stripe customer
        if (!$user->hasStripeId()) {
            $user->createAsStripeCustomer($token);
        }
        // I modified invoiceFor in the cashier vendor to have it return the invoice
        return $user->invoiceFor('Ticket Fee', $price * 100);
    }

    /**
     * Get the login user or create an anonymous user
     *
     * @return user
     * @author 
     **/
    public function getOrCreateAnonymous(TicketCheckoutRequest $request)
    {
        if (Auth::check()){
            $user = Auth::user();
        } else {
            if (is_null($user = User::getByEmail($request->email)) ) {
                $user = User::create([
                    'first_name'    => $request->first_name,
                    'last_name'     => $request->last_name,
                    'email'         => $request->email,
                ]);
            } 
        }
        return $user;
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
