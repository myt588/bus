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
use App\Http\Requests\TripCreateRequest;
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
            $trips = $user->company->trips;
        }
        return view('backend.trips.index', compact('trips'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
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
            $buses = $user->company->buses()->lists('bus_number', 'id');
            $stations = $user->company->stations()->lists('name', 'id');
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
    public function store(TripCreateRequest $request)
    {
        $data = $request->all();
        $data['weekdays'] = $this->weekdaysCal($data['weekdays']);
        $trip = Trip::create($data);
        $trip->name = $trip->fromCity->getCityName() . ' to ' . $trip->toCity->getCityName();
        $trip->start = $trip->depart_at;
        $trip->save();
        $trip->stationHandler($data['depart_stops'], $data['depart_times'], true);
        $trip->stationHandler($data['arrive_stops'], $data['arrive_times'], false);  
        Session::flash('success', 'Trip added!');
        return redirect('admin/trips');
    }

    public function weekdaysCal($weekdays) 
    {
        $sum = 0;
        foreach ($weekdays as $weekday) {
            $sum |= constant($weekday);
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
            $cities = $this->cityName(City::lists('city', 'state'));
        } else {
            $buses = $user->company->buses()->lists('bus_number', 'id');
            $stations = $user->company->stations()->lists('name', 'id');
            $cities = $this->cityName(City::lists('city', 'state'));
        }
        $companies = Company::lists('name', 'id');
        $trip->getStationsPivotData($depart_stops, $arrive_stops);
        return view('backend.trips.edit', 
            compact('buses', 'stations', 'companies', 'cities', 'depart_stops', 'arrive_stops', 'trip'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update($id, TripCreateRequest $request)
    {
        $data = $request->all();
        $data['weekdays'] = $this->weekdaysCal($data['weekdays']);
        $trip = Trip::findOrFail($id);
        $trip->update($data);
        $trip->name = $trip->fromCity->getCityName() . ' to ' . $trip->toCity->getCityName();
        $trip->start = $trip->depart_at;
        $trip->save();
        $trip->stations()->detach();
        $trip->stationHandler($data['depart_stops'], $data['depart_times'], true);
        $trip->stationHandler($data['arrive_stops'], $data['arrive_times'], false);  
        Session::flash('success', 'Trip updated!');
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
        Session::flash('success', 'Trip deleted!');
        return redirect('admin/trips');
    }

    /**
     * Activiate a trip
     *
     * @return view
     * @author me
     **/
    public function active($id)
    {
        if(Trip::findOrFail($id)->setActiveState())
        {
            Session::flash('success', 'Trip is activiated');
        } else {
            Session::flash('danger', 'Trip is deactiviated');
        }
        return back();
    }

}
