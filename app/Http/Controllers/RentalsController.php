<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rental;
use App\Bus;
use App\City;
use App\Rent;
use App\User;
use App\Transaction;
use App\Http\Requests;

use Auth;

class RentalsController extends Controller
{

	/**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function search(Request $request)
    {
    	$data = $request->all();
        $rentals = Rental::whereHas('bus', function ($query) use ($request) {
		    $query->where('seats', '>=', $request->passengers);
		})->paginate(15);
        return view('frontend.rentals.search', compact('rentals', 'data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // $rentals = Auth::user()->isAdmin() ? Rental::all() : Auth::user()->company->rentals;
        $rentals = Rental::paginate(15);
        return view('frontend.rentals.search', compact('rentals'));
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show(Request $request)
    {
    	$data = $request->all();
        $rental = Rental::findOrFail($request->id);
        $day = (strtotime($request->end) - strtotime($request->start))/60/60/24;
        $total = $rental->per_day * $day;
        $total = number_format((float)$total, 2, '.', '');
        $location = City::findOrFail($request->location)->getCityName();
        return view('frontend.rentals.detailed', compact('rental', 'total', 'data', 'location'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function booking(Request $request)
    {
        $data = $request->all();
        $rental = Rental::findOrFail($request->id);
        $day = (strtotime($request->end) - strtotime($request->start))/60/60/24;
        $total = $rental->per_day * $day;
        $total = number_format((float)$total, 2, '.', '');
        $location = City::findOrFail($request->location)->getCityName();
        return view('frontend.rentals.contact-us', compact('rental', 'total', 'data', 'location'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function confirm(Request $request)
    {
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
        $transaction = Transaction::create([
            'quantity'              => 0,
            'confirmation_number'   => random('distinct', 8),
            'description'           => "rental",
            ]);
        $rent = Rent::create([
            'user_id'               => $user->id,
            'rental_id'             => $request->id,
            'transaction_id'        => $transaction->id
            ]);
        return redirect()->route('rentals.thankyou', $rent->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function thankyou($id)
    {
        $rent = Rent::findOrFail($id);

        return view('frontend.rentals.thankyou', compact('rent'));
    }
}
