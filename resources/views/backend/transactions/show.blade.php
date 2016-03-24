@extends('layouts.backend')

@section('title') Transaction Homepage @endsection @section('heading') Transaction @endsection

@section('breadcrumb')

    <li><a href="/home">Home</a></li>
    <li><a href="/%%routeGroup%%transactions">Transaction</a></li>
    <li><a href="/%%routeGroup%%transactions/%{{$transaction->id}}">Show</a></li>

@endsection

@section('content')

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>User Id</th><th>Source Id</th><th>Credit</th><th>Debit</th><th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $transaction->id }}</td> <td> {{ $transaction->user_id }} </td><td> {{ $transaction->source_id }} </td><td> {{ $transaction->credit }} </td><td> {{ $transaction->debit }} </td><td> {{ $transaction->description }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection