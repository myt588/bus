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
use App\Http\Requests\StationRequest;

class StationsController extends Controller
{

    function __construct()
    {
        $this->user = auth()->user();
        // $this->middleware('auth', ['only' => ['store', 'destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if ($this->user->isAdmin()) 
        {
            $stations = Station::all();
        } else {
            $stations = $this->user->company->stations;
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
        $city = $this->createOrChooseCity($request->city, $request->state, $request->zipcode);
        $data = $request->all();
        $data['city_id'] = $city->id;
        Station::create($data);
        Session::flash('success', 'Station added!');
        return redirect('admin/stations');
    }

    /**
     * Create a City Model if the city name doesn't exist
     * Else Choose the existed one
     *
     * @param $city, $state, $zipcode
     * @return $city
     * @author 
     **/
    public function createOrChooseCity($city, $state, $zipcode)
    {
        $city_state = City::where('city', '=', $city)
                    ->where('state', '=', $state)
                    ->first();
        if (empty($city_state))
        {
            $data = compact('city', 'state', 'zipcode');
            return City::create($data);
        }
        return $city_state;
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
        $city = $this->createOrChooseCity($request->city, $request->state, $request->zipcode);
        $station = Station::findOrFail($id);
        $data = $request->all();
        $data['city_id'] = $city->id;
        $station->update($data);
        Session::flash('success', 'Station updated!');
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
        if (Station::findOrFail($id)->getLinkedItems())
        {
            Session::flash('danger', 'There is a trip linked with this station. Please unlink thoese connections by choosing another station for that trip first before deleting this record!');
            return redirect()->back();
        }
        Station::destroy($id);
        Session::flash('success', 'Station deleted!');
        return redirect('admin/stations');
    }

}
