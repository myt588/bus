<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Trip;
use App\Bus;
use App\Station;
use App\Company;
use App\City;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Auth;

class TripsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->isAdmin())
        {
            $trips = Trip::all();
        } else {
            $trips = Company::findOrFail($user->company_id)->trips;
        }
        return view('backend.trips.index', compact('trips'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $user = Auth::user();
        if ($user->isAdmin())
        {
            $buses = Bus::lists('bus_number', 'id');
            $stations = Station::lists('name', 'id');
            $cities = $this->cityName(City::lists('city', 'state'));
        } else {
            $buses = Company::findOrFail($user->company_id)->buses()->lists('bus_number', 'id');
            $stations = Company::findOrFail($user->company_id)->stations()->lists('name', 'id');
            $cities = $this->cityName(City::lists('city', 'state'));
        }
        $companies = Company::lists('name', 'id');
        return view('backend.trips.create', compact('buses', 'stations', 'companies', 'cities'));
    }

    public function cityName($cities)
    {
        $cityNames = [];
        $i = 1;
        foreach ($cities as $key => $value) {
            $cityNames[$i] = $key . ', ' . $value;
            $i++;
        }
        return $cityNames;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $data['weekdays'] = $this->weekdaysCal($data['weekdays']);
        $trip = Trip::create($data);
        $trip->name = $trip->fromCity->getCityName() . ' to ' . $trip->toCity->getCityName();
        $trip->save();
        if (array_key_exists('stop', $data)) {
            for ($i=0; $i<count($data['stop']); $i++) {
                $departure = $data['departure'][$i] ? 1 : 0;
                $trip->stations()->attach($data['stop'][$i], ['time' => $data['time'][$i], 
                                                              'departure' => $departure]);
            }
        }   
        Session::flash('flash_message', 'Trip added!');

        return redirect('admin/trips');
    }

    public function weekdaysCal($weekdays) 
    {
        $sum = 0;
        foreach ($weekdays as $weekday) {
            $sum += constant($weekday);
        }
        return $sum;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        $trip = Trip::findOrFail($id);

        return view('backend.trips.show', compact('trip'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $trip = Trip::findOrFail($id);
        $user = Auth::user();
        if ($user->isAdmin())
        {
            $buses = Bus::lists('bus_number', 'id');
            $stations = Station::lists('name', 'id');
        } else {
            $buses = Company::findOrFail($user->company_id)->buses()->lists('bus_number', 'id');
            $stations = Company::findOrFail($user->company_id)->stations()->lists('name', 'id');
        }
        $companies = Company::lists('name', 'id');
        $stop = [];
        $time = [];
        $departure = [];
        foreach ($trip->stations as $item) {
            array_push($stop, $item->id);
            array_push($time, $item->pivot->time);
            array_push($departure, $item->pivot->departure);
        }
        return view('backend.trips.edit', compact('buses', 'stations', 'companies', 'trip', 'stop', 'time', 'departure'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        
        $trip = Trip::findOrFail($id);
        $data = $request->all();
        $trip->update($data);
        $trip->buses()->sync([$data['bus_id']]);
        $stops = [];
        if (array_key_exists('stop', $data)) {
            for ($i=0; $i<count($data['stop']); $i++) {
                $stops[$data['stop'][$i]] = ['time' => $data['time'][$i]];
            }
            $trip->stations()->sync($stops);
        } 
        Session::flash('flash_message', 'Trip updated!');

        return redirect('admin/trips');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        Trip::destroy($id);

        Session::flash('flash_message', 'Trip deleted!');

        return redirect('admin/trips');
    }

}
