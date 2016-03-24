@extends('layouts.backend')

@section('title') Rental Homepage @endsection @section('heading') Rental @endsection

@section('breadcrumb')

    <li><a href="/home">Home</a></li>
    <li><a href="/%%routeGroup%%rentals">Rental</a></li>
    <li><a href="/%%routeGroup%%rentals/%{{$rental->id}}">Show</a></li>

@endsection

@section('content')

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>Company Id</th><th>Bus Id</th><th>Transaction Id</th><th>Description</th><th>One Day</th><th>Three Days</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $rental->id }}</td> <td> {{ $rental->company_id }} </td><td> {{ $rental->bus_id }} </td><td> {{ $rental->transaction_id }} </td><td> {{ $rental->description }} </td><td> {{ $rental->one_day }} </td><td> {{ $rental->three_days }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection