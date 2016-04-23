<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Ticket;
use App\Trip;
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
        $trips_sold = $this->tripsBetweenDates('yesterday - 6 days', 'yesterday');
        $trips_today = $this->tripsBetweenDates('today', 'tomorrow');
        $trips_booked = $this->tripsBetweenDates('tomorrow', 'tomorrow + 6 days');
        return view('backend.tickets.index', compact('trips_booked', 'trips_sold', 'trips_today'));
    }


    public function tripsBetweenDates($start, $end)
    {
        $datediff = strtotime($end) - strtotime($start);
        $dayCount = floor($datediff/(60*60*24));
        $trips = collect([]);
        for ($i = 0; $i < $dayCount; $i++)
        {
            $trips->push(Trip::where('weekdays', '&', stringToWeekday($start . '+ ' . $i . ' days'))->get());
        }
        return $trips;
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
    public function show($id, Request $request)
    {
        $trip = Trip::findOrFail($id);
        $tickets = $trip->tickets()->where('depart_date', '=', $request->date)->get();
        return view('backend.tickets.show', compact('tickets'));
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
