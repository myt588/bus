@extends('layouts.backend')

@section('title') Ticket Homepage @endsection @section('heading') Ticket @endsection

@section('breadcrumb')

    <li><a href="/home">Home</a></li>
    <li><a href="/%%routeGroup%%tickets">Ticket</a></li>
    <li><a href="/%%routeGroup%%tickets/%{{$ticket->id}}">Show</a></li>

@endsection

@section('content')

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>User Id</th><th>Fare Id</th><th>Transaction Id</th><th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $ticket->id }}</td> <td> {{ $ticket->user_id }} </td><td> {{ $ticket->fare_id }} </td><td> {{ $ticket->transaction_id }} </td><td> {{ $ticket->description }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection