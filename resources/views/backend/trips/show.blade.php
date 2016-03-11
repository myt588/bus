@extends('layouts.backend')

@section('title') Trip Homepage @endsection @section('heading') Trip @endsection

@section('breadcrumb')

    <li><a href="/home">Home</a></li>
    <li><a href="/admin/trips">Trip</a></li>
    <li><a href="/admin/trips/%{{$trip->id}}">Show</a></li>

@endsection

@section('content')

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th><th>From</th><th>To</th><th>Rating</th><th>Depart At</th><th>Arrive At</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $trip->id }}</td><td> {{ $trip->from }} </td><td> {{ $trip->to }} </td><td> {{ $trip->rating }} </td><td> {{ $trip->depart_at }} </td><td> {{ $trip->arrive_at }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection