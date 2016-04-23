@extends('layouts.backend')

@section('title') Rent Homepage @endsection @section('heading') Rent @endsection

@section('breadcrumb')

    <li><a href="/home">Home</a></li>
    <li><a href="/%%routeGroup%%rents">Rent</a></li>
    <li><a href="/%%routeGroup%%rents/%{{$rent->id}}">Show</a></li>

@endsection

@section('content')

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>User Id</th><th>Rental Id</th><th>Transaction Id</th><th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $rent->id }}</td> <td> {{ $rent->user_id }} </td><td> {{ $rent->rental_id }} </td><td> {{ $rent->transaction_id }} </td><td> {{ $rent->description }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection