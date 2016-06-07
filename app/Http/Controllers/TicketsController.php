<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trip;
use App\Station;
use App\Ticket;
use App\Transaction;
use App\User;
use App\Company;
use App\Http\Requests;

use Auth;
use Log;
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
        if (count($request->trip_id) > 0){ 
            //When search for the 2nd trip of the round trip 
            $date_list = $this->dateHandler($data, 'return');
            $trips = Trip::search($data['to'], $data['from'], stringToWeekday($data['return']));
        } else { 
            //When search for the 1st trip
            $date_list = $this->dateHandler($data, 'depart');
            $trips = Trip::search($data['from'], $data['to'], stringToWeekday($data['depart']));
        }
        // Handle filters
        if ($request->has('filter'))
        {
            $min = $request->has('min') ? $request->min : 0;
            $max = $request->has('max') ? $request->max : 1000;
            $startTime = $request->has('startTime') ? $request->startTime : '6:00 AM';
            $endTime = $request->has('endTime') ? $request->endTime : '10:00 PM';
            $companyNames = $request->has('companyName') ? $request->companyName : ['all'];
            $trips = $trips->priceFilter($min, $max)->departFilter($startTime, $endTime)->companyFilter($companyNames);
        } 
        // Add Paginator
        $trips = $trips->paginate(10);
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
            if (array_has($data, 'return')) {
                $data['return'] = dateMath($data['return'], $data['date_new']);
            }
            unset($data['date_new']);
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
        $info = $this->getInfo($data);
        session()->put('info', $info);
        session()->put('searchTerms', $data);
        return view('frontend.tickets.detailed', compact('data', 'info'));
    }

    /**
     * Checkout View
     *
     * @return View
     * @author Me
     **/
    public function checkout(Request $request)
    {
        $data = session()->get('searchTerms');
        $info = session()->get('info');
        $adults = $request->adults;
        $kids = $request->kids;
        $fares = $this->fareMath($kids, $adults, $info);
        session()->put('fares', $fares);
        return view('frontend.tickets.checkout', compact('data', 'info', 'kids', 'adults', 'fares'));
    }

    /**
     * calculate the fare for trip
     *
     * @return Array $fares
     * @author ME
     **/
    public function fareMath($kids, $adults, $info)
    {
        foreach($info as $i => $item)
        {
            $fares[$i] = $item['trip']->fee * ($kids[$i] + $adults[$i]);
        }
        return $fares;
    }

    /**
     * Get Ticket Info 
     *
     * @return Compact Data
     * @author Me
     **/
    public function getInfo($data)
    {
        $info = [];
        foreach ($data['trip_id'] as $i => $id)
        {
            $trip = Trip::findOrFail($id);
            $ds = $trip->stations->find($data['trip_DS'][$i]);
            $as = $trip->stations->find($data['trip_AS'][$i]);
            $info[$i] = ['trip' => $trip, 'ds' => $ds, 'as' => $as];
        }
        return $info;
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
        $data = session()->pull('searchTerms');
        $info = session()->pull('info');
        $fares = session()->pull('fares');
        $user = User::getUserOrCreateAnonymous($request->first_name, $request->last_name, $request->email, $request->phone);
        $total = count($fares) == 1 ? $fares[0] : $fares[0] + $fares[1];
        $invoice = $this->createInvoice($user, $total, $request->stripeToken);
        $transaction = null;
        foreach($info as $i => $item)
        {
            $trip = $item['trip'];
            if ($i == 1 && $this->sameCompany($info))
            {
                $transaction->quantity = $total;
                $transaction->save();
            } else {
                $transaction = Transaction::forTicket($user->id, $trip->company->id, $fares[$i], $invoice->id);
            }
            foreach(['kids_', 'adults_'] as $keyword)
            {
                for ($j=0; $j<count($request[$keyword.$i]); $j++)
                {
                    Ticket::create([
                    'user_id'           => $user->id,
                    'trip_id'           => $trip->id,
                    'transaction_id'    => $transaction->id,
                    'description'       => $request[$keyword.$i][$j],
                    'depart_date'       => stringToDate($data[$i == 0 ? 'depart' : 'return']),
                    'depart_station'    => $item['ds']->id,
                    'arrive_station'    => $item['as']->id,
                    ]);
                }
            }
        }
        Mail::send('emails.ticket_confirmation', ['user' => $user, 'transaction' => $transaction], function ($m) use ($user) {
            $m->to($user->email, $user->name)->subject('Your Reminder!');
        });
        return redirect()->route('tickets.thankyou', $transaction->booking_no);
    }

    /**
     * Check if the two trips are from the same company
     *
     * @return Boolean
     * @author ME
     **/
    public function sameCompany($info)
    {
        return $info[0]['trip']->company == $info[1]['trip']->company;
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
     * Get the confirmation page using booking number
     *
     * @return view
     * @author 
     **/
    public function thankyou($booking_no)
    {
        $transactions = Transaction::byBookingNo($booking_no)->get();
        $user = $transactions->first()->user;
        return view('frontend.tickets.thankyou', compact('transactions', 'user'));
    }

    /**
     * Get the invoice page using invoice id
     *
     * @return view
     * @author 
     **/
    public function invoice($invoice_id)
    {
        if (Auth::check())
        {
            $invoice = Auth::user()->findInvoiceOrFail($invoice_id);
        } else {
            $transactions = Transaction::byInvoice($invoice_id);
            if (count($transactions) == 0) {return "not a valid invoice"; }
            else { 
                $invoice = $transactions->first()->user->findInvoiceOrFail($invoice_id);
            }
        }
        return $invoice->view([
            'vendor' => 'TriponBus',
            'product' => 'Bus Ticket'
        ]);
    }

}
