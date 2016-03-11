@extends('layouts.backend')

@section('title') Station Homepage @endsection @section('heading') Station @endsection

@section('breadcrumb')

    <li><a href="/home">Home</a></li>
    <li><a href="/admin/stations">Station</a></li>
    <li><a href="/admin/stations/%{{$station->id}}">Show</a></li>

@endsection

@section('content')

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>Company Id</th><th>Name</th><th>Address</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $station->id }}</td> <td> {{ $station->company_id }} </td><td> {{ $station->name }} </td><td> {{ $station->address }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection