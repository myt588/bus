@extends('layouts.backend')

@section('title') Company Homepage @endsection @section('heading') Company @endsection

@section('breadcrumb')

    <li><a href="/home">Home</a></li>
    <li><a href="/%%routeGroup%%%%crudName%%">Company</a></li>
    <li><a href="/%%routeGroup%%%%crudName%%/%{{$company->id}}">Show</a></li>

@endsection

@section('content')

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>Name</th><th>Year Founded</th><th>Rate</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $company->id }}</td> <td> {{ $company->name }} </td><td> {{ $company->year_founded }} </td><td> {{ $company->rate }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection