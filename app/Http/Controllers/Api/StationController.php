<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Station;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class StationController extends ApiController
{
    protected $stations;

    function __construct(Station $stations)
    {
        $this->stations = $stations;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data = $this->stations->paginate(5);
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
            'compnay_id' => $request->input('compnay_id'),
            'name'       => $request->input('name'),
            'time'       => $request->input('time'),
        ];
        $station = $this->stations->fill($data);
        $station->save();
        return $this->push(200, 20000, 'Stop Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $station= $this->stations->findOrFail($id);
        $this->data = $station;
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
        $this->stations->findOrFail($id)->update($request->all());
        return $this->push(200, 20000, 'Stop Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->stations->findOrFail($id)->delete();
        return $this->push(200, 20000, 'Stop Deleted');
    }
}
