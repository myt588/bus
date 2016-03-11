@extends('layouts.backend')

@section('title') Ticket Homepage @endsection @section('heading') Ticket @endsection

@section('breadcrumb')

    <li><a href="/home">Home</a></li>
    <li><a href="/%%routeGroup%%%%crudName%%">Ticket</a></li>
    <li><a href="/%%routeGroup%%%%crudName%%/%{{$ticket->id}}">Show</a></li>

@endsection

@section('content')

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>Price</th><th>Discount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $ticket->id }}</td> <td> {{ $ticket->price }} </td><td> {{ $ticket->discount }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection