<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Ticket;
use App\Trip;
use App\Company;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class TicketsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $tickets = Ticket::paginate(15);

        return view('backend.tickets.index', compact('tickets'));
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
        return view('backend.tickets.create', compact('companies', 'trips'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $ticket = Ticket::create($data);
        $ticket->trips()->attach($data['trip_id']);
        Session::flash('flash_message', 'Ticket added!');

        return redirect('admin/tickets');
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
        $ticket = Ticket::findOrFail($id);

        return view('backend.tickets.show', compact('ticket'));
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
        $ticket = Ticket::findOrFail($id);
        $trips = Trip::lists('name', 'id');
        $trips_selected = $ticket->trips;
        return view('backend.tickets.edit', compact('ticket', 'trips', 'companies', 'trips_selected'));
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
        $ticket = Ticket::findOrFail($id);
        $ticket->update($data);
        $ticket->trips()->sync($data['trip_id']);

        Session::flash('flash_message', 'Ticket updated!');

        return redirect('admin/tickets');
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
        Ticket::destroy($id);

        Session::flash('flash_message', 'Ticket deleted!');

        return redirect('admin/tickets');
    }

}
