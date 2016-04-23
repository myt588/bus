<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function ticketsBooking()
    {
    	$tickets = Ticket::paginate(15);

        return view('backend.tickets.index', compact('tickets'));
    }
}
