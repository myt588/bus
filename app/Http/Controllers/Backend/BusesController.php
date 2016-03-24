<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Bus;
use App\Company;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Auth;

class BusesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->isAdmin())
        {
            $buses = Bus::all();
        } else {
            $buses = Company::findOrFail($user->company_id)->buses;
        }
        return view('backend.buses.index', compact('buses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $companies = Company::lists('name', 'id');
        return view('backend.buses.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
    
        Bus::create($request->all());
        Session::flash('flash_message', 'Bus added!');
        return redirect('admin/buses');
    }

    /**s
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        $bus = Bus::findOrFail($id);
        return view('backend.buses.show', compact('bus'));
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
        $bus = Bus::findOrFail($id);
        $companies = Company::lists('name', 'id');
        return view('backend.buses.edit', compact('bus', 'companies'));
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
        
        $bus = Bus::findOrFail($id);
        
        $bus->update($request->all());

        Session::flash('flash_message', 'Bus updated!');

        return redirect('admin/buses');
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
        Bus::destroy($id);

        Session::flash('flash_message', 'Bus deleted!');

        return redirect('admin/buses');
    }

}
