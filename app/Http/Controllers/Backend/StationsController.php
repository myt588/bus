<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Station;
use App\Company;
use App\City;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Auth;
use App\Http\Requests\StationRequest;

class StationsController extends Controller
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
            $stations = Station::all();
        } else {
            $stations = Company::findOrFail($user->company_id)->stations;
        }
        return view('backend.stations.index', compact('stations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $companies = Company::lists('name', 'id');
        return view('backend.stations.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(StationRequest $request)
    {
        $city = City::create($request->all());
        $data = $request->all();
        $data['city_id'] = $city->id;
        Station::create($data);
        Session::flash('flash_message', 'Station added!');

        return redirect('admin/stations');
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
        $station = Station::findOrFail($id);

        return view('backend.stations.show', compact('station'));
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
        $companies = Company::lists('name', 'id');
        $station = Station::findOrFail($id);

        return view('backend.stations.edit', compact('station', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update($id, StationRequest $request)
    {
        
        $station = Station::findOrFail($id);
        $station->update($request->all());

        Session::flash('flash_message', 'Station updated!');

        return redirect('admin/stations');
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
        Station::destroy($id);

        Session::flash('flash_message', 'Station deleted!');

        return redirect('admin/stations');
    }

}
