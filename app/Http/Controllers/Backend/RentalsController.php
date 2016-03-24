<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Rental;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class RentalsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $rentals = Rental::paginate(15);

        return view('backend.rentals.index', compact('rentals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.rentals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
        Rental::create($request->all());

        Session::flash('flash_message', 'Rental added!');

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
        $rental = Rental::findOrFail($id);

        return view('backend.rentals.edit', compact('rental'));
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

        Session::flash('flash_message', 'Rental updated!');

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

}
