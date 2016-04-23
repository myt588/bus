<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Rent;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class RentsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $rents = Rent::paginate(15);

        return view('backend.rents.index', compact('rents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.rents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
        Rent::create($request->all());

        Session::flash('flash_message', 'Rent added!');

        return redirect('admin/rents');
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
        $rent = Rent::findOrFail($id);

        return view('backend.rents.show', compact('rent'));
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
        $rent = Rent::findOrFail($id);

        return view('backend.rents.edit', compact('rent'));
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
        
        $rent = Rent::findOrFail($id);
        $rent->update($request->all());

        Session::flash('flash_message', 'Rent updated!');

        return redirect('admin/rents');
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
        Rent::destroy($id);

        Session::flash('flash_message', 'Rent deleted!');

        return redirect('admin/rents');
    }

}
