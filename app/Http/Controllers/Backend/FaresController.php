<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Fare;
use App\Trip;
use App\Company;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Auth;

class FaresController extends Controller
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
            $fares = Fare::paginate(15);
        } else {
            $fares = Company::findOrFail($user->company_id)->fares()->paginate(15);
        }
        return view('backend.fares.index', compact('fares'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $companies = Company::lists('name', 'id');
        $trips = Trip::lists('name', 'id');
        return view('backend.fares.create', compact('companies', 'trips'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $fare = Fare::create($data);
        $fare->trips()->attach($data['trip_id']);
        Session::flash('flash_message', 'fare added!');

        return redirect('admin/fares');
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
        $fare = Fare::findOrFail($id);

        return view('backend.fares.show', compact('fare'));
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
        $fare = Fare::findOrFail($id);
        $trips = Trip::lists('name', 'id');
        $trips_selected = $fare->trips->lists('id');
        return view('backend.fares.edit', compact('fare', 'trips', 'companies', 'trips_selected'));
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
        $data = $request->all();
        $fare = Fare::findOrFail($id);
        $fare->update($data);
        $fare->trips()->sync($data['trip_id']);

        Session::flash('flash_message', 'fare updated!');

        return redirect('admin/fares');
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
        fare::destroy($id);

        Session::flash('flash_message', 'fare deleted!');

        return redirect('admin/fares');
    }

}
