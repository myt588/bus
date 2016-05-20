<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Bus;
use App\Company;
use App\Photo;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests\BusRequest;
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
    public function store(BusRequest $request)
    {
        $data = $request->all();
        $this->validate($request, [
            'bus_number'        => 'required|unique:buses,bus_number',
            ]);
        $bus = Bus::create($data);
        Session::flash('success', 'Bus added! And You may add some photo to it!');
        return redirect()->route('admin::admin.buses.edit', $bus->id);
    }

    /**
     * add photo to the bus
     *
     * @return void
     * @author 
     **/
    public function addPhoto($id, Request $request)
    {
        $this->validate($request, [
            'photo' => 'required|mimes:jpg,jpeg,png,bmp'
        ]);
        $bus = Bus::findOrFail($id);
        $photo = Photo::fromForm($request->file('photo'), $id, get_class($bus));
        $photo->save();
        return 'done';
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
    public function update($id, BusRequest $request)
    {
        
        $bus = Bus::findOrFail($id);
        $data = $request->all();
        $bus->update($data);
        Session::flash('success', 'Bus updated!');
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
        // there is linked item
        if (Bus::findOrFail($id)->getLinkedItems())
        {
            Session::flash('danger', 'There is a trip/rental linked with this bus. Please unlink thoese connections by choosing another bus for that trip/rental first before deleting this bus record!');
            return redirect()->back();
        }
        Bus::destroy($id);
        Session::flash('success', 'Bus deleted!');
        return redirect('admin/buses');
    }


}
