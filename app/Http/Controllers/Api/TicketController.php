<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Ticket;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TicketController extends ApiController
{
    protected $tickets;

    function __construct(Ticket $tickets)
    {
        $this->tickets = $tickets;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data = $this->tickets->paginate(5);
        return $this->paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'price'           => $request->input('price'),
            'discount'        => $request->input('discount'),
        ];
        $ticket = $this->tickets->fill($data);
        $ticket->save();
        return $this->push(200, 20000, 'Bus Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tickets= $this->tickets->findOrFail($id);
        $this->data = $tickets;
        return $this->push();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->tickets->findOrFail($id)->update($request->all());
        return $this->push(200, 20000, 'Bus Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->tickets->findOrFail($id)->delete();
        return $this->push(200, 20000, 'Bus Deleted');
    }
}
