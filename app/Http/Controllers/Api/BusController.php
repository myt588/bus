<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Bus;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BusController extends ApiController
{
    protected $buses;

    function __construct(Bus $buses)
    {
        $this->buses = $buses;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data = $this->buses->paginate(5);
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
            'license_plate'     => $request->input('license_plate'),
            'bus_number'        => $request->input('bus_number'),
            'vehicle_number'    => $request->input('vehicle_number'),
            'model'             => $request->input('model'),
            'year'              => $request->input('year')
        ];
        $bus = $this->buses->fill($data);
        $bus->save();
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
        $bus= $this->buses->findOrFail($id);
        $this->data = $bus;
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
        $this->buses->findOrFail($id)->update($request->all());
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
        $this->buses->findOrFail($id)->delete();
        return $this->push(200, 20000, 'Bus Deleted');
    }
}
