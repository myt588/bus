<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Rental;
use App\Company;
use App\Bus;
use App\Http\Requests\RentalRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Auth;

class RentalsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $rentals = Auth::user()->isAdmin() ? Rental::all() : Auth::user()->company->rentals;
        return view('backend.rentals.index', compact('rentals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $companies = Company::lists('name', 'id');
        $buses = Auth::user()->isAdmin() ? Bus::lists('bus_number', 'id') : Auth::user()->company->buses->lists('bus_number', 'id');
        return view('backend.rentals.create', compact('companies', 'buses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(RentalRequest $request)
    {
        Rental::create($request->all());
        Session::flash('success', 'Rental added!');
        return redirect('admin/rentals');
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
        $rental = Rental::findOrFail($id);
        return view('backend.rentals.show', compact('rental'));
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
        $buses = Auth::user()->isAdmin() ? Bus::lists('bus_number', 'id') : Auth::user()->company->buses->lists('bus_number', 'id');
        $rental = Rental::findOrFail($id);
        return view('backend.rentals.edit', compact('rental', 'companies', 'buses'));
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
        $rental = Rental::findOrFail($id);
        $rental->update($request->all());
        Session::flash('success', 'Rental updated!');
        return redirect('admin/rentals');
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
        Rental::destroy($id);

        Session::flash('flash_message', 'Rental deleted!');

        return redirect('admin/rentals');
    }

    /**
     * Activiate a trip
     *
     * @return Redirect
     * @author me
     **/
    public function active($id)
    {
        if(Rental::findOrFail($id)->setActiveState())
        {
            Session::flash('success', 'Rental is activiated');
        } else {
            Session::flash('danger', 'Rental is deactiviated');
        }
        return back();
    }

}
