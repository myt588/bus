<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Trip;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TripController extends ApiController
{
    protected $tirps;

    function __construct(Trip $trips)
    {
        $this->trips = $trips;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data = $this->trips->paginate(5);
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
            'company_id'        => $request->input('company_id'),
            'from'              => $request->input('from'),
            'to'                => $request->input('to'),
            'rating'            => $request->input('rating'),
            'depart_at'         => $request->input('depart_at'),
            'arrive_at'         => $request->input('arrive_at')
        ];
        $trip = $this->trips->fill($data);
        $trip->save();
        return $this->push(200, 20000, 'Trip Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trip= $this->trips->findOrFail($id);
        $this->data = $trip;
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
        $this->trips->findOrFail($id)->update($request->all());
        return $this->push(200, 20000, 'Trip Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->trips->findOrFail($id)->delete();
        return $this->push(200, 20000, 'Trip Deleted');
    }
}
