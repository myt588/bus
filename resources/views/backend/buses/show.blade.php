@extends('layouts.backend')

@section('title') Bus Homepage @endsection @section('heading') Bus @endsection

@section('breadcrumb')

    <li><a href="/home">Home</a></li>
    <li><a href="/admin/buses">Bus</a></li>
    <li><a href="/admin/buses/%{{$bus->id}}">Show</a></li>

@endsection

@section('content')

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>License Plate</th><th>Bus Number</th><th>Vehicle Number</th><th>Model</th><th>Year</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> {{ $bus->license_plate }} </td><td> {{ $bus->bus_number }} </td><td> {{ $bus->vehicle_number }} </td><td> {{ $bus->model }} </td><td> {{ $bus->year }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection