<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Ticket;
use App\Trip;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Log;
use Auth;

class TicketsController extends Controller
{

    function __construct()
    {
        $this->user = Auth::user();
        // $this->middleware('auth', ['only' => ['store', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function sales(Request $request)
    {
        if($this->user->isAdmin())
        {
            $trips = Trip::all();
        } else {
            $trips = $this->user->company->trips->all();    
        }
        if ($request->has('start_date') && $request->has('end_date'))
        {
            $start = $request->start_date;
            $end = $request->end_date;
            return view('backend.tickets.sales', compact('trips', 'start', 'end'));
        }
        return view('backend.tickets.sales', compact('trips'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function bookings(Request $request)
    {   
        if ($request->has('start_date') && $request->has('end_date'))
        {
            $start = $request->start_date;
            $end = $request->end_date;
            $date = $start < $end ? $start : $end;
            $dates = $this->tripsBetweenDates($end, $start);
            return view('backend.tickets.bookings', compact('dates', 'date'));
        }
        $today = $this->tripsBetweenDates('today', 'tomorrow');
        $dates = $this->tripsBetweenDates('tomorrow', 'tomorrow + 6 days');
        return view('backend.tickets.bookings', compact('today', 'dates'));
    }

    public function tripsBetweenDates($start, $end)
    {
        $datediff = abs(strtotime($end) - strtotime($start));
        $dayCount = floor($datediff/(60*60*24));
        $dates = collect([]);
        for ($i = 0; $i < $dayCount; $i++)
        {
            if ($this->user->isAdmin())
            {
                $dates->push(Trip::where('weekdays', '&', stringToWeekday($start . '+ ' . $i . ' days'))->get());
            } else {
                $dates->push(Trip::where('weekdays', '&', stringToWeekday($start . '+ ' . $i . ' days'))
                                 ->where('company_id', '=', $this->user->company_id)
                                 ->get());
            }
        }
        return $dates;
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
