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
use App\Http\Requests\RentalSearchRequest;
use App\Http\Requests\RentalCheckoutRequest;

use Auth;
use JavaScript;

class RentalsController extends Controller
{

	/**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function search(RentalSearchRequest $request)
    {
    	$data = $request->all();
        $rentals = Rental::bySeats($request->passengers);
        // Handle filters
        if ($request->has('filter'))
        {
            $min = $request->has('min') ? $request->min : 0;
            $max = $request->has('max') ? $request->max : 1000;
            $companyNames = $request->has('companyName') ? $request->companyName : ['all'];
            $types = $request->has('type') ? $request->type : [];
            $rentals = $rentals->priceFilter($min, $max)->companyFilter($companyNames)->multiTypeFilter($types);
        } 
        $types = [];
        foreach (config('constants.bus_type') as $type)
        {
            $a = clone $rentals;
            $types[$type] = $a->typeFilter($type)->count();
        }
        // paginator
        $rentals = $rentals->paginate(10);
        return view('frontend.rentals.search', compact('rentals', 'data', 'types'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
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
        session()->put('location', $location);
        session()->put('total', $total);
        session()->put('day', $day);
        session()->put('data', $data);
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
    public function confirm(RentalCheckoutRequest $request)
    {
        $data = $request->all();
        $location = session()->get('location');
        $total = session()->get('total');
        $day = session()->get('day');
        $data = session()->get('data');
        $start = $data['start'] . ' ' . $data['start_at'];
        $end = $data['end'] . ' ' . $data['end_at'];
        $user = User::getUserOrCreateAnonymous($request->first_name, $request->last_name, $request->email, $request->phone);
        $rent = Rent::create([
            'user_id'               => $user->id,
            'rental_id'             => $request->id,
            'start'                 => stringToDateTime($start),
            'end'                   => stringToDateTime($end),
            'description'           => $location,
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
