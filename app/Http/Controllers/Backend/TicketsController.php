<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Ticket;
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
        return view('backend.tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['user_id' => 'required', 'fare_id' => 'required', ]);

        Ticket::create($request->all());

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
        $ticket = Ticket::findOrFail($id);

        return view('backend.tickets.edit', compact('ticket'));
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
        $this->validate($request, ['user_id' => 'required', 'fare_id' => 'required', ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->update($request->all());

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
