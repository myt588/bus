@extends('layouts.backend')

@section('title') Ticket Homepage @endsection 

@section('heading') 

    Ticket 
    <small>
        <a href=" {{ url('admin/tickets/create') }} "class="btn btn-sm  btn-primary iframe">
            Add New Ticket
        </a>
    </small>

@endsection

@section('breadcrumb')

    <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/admin/tickets">Ticket</a></li>
    <li><a href="/admin/tickets">Index</a></li>

@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>User Id</th><th>Fare Id</th><th>Transaction Id</th><th>Description</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                {{-- */$x=0;/* --}}
                @foreach($tickets as $item)
                    {{-- */$x++;/* --}}
                    <tr>
                        <td>{{ $x }}</td>
                        <td><a href="{{ url('admin/tickets', $item->id) }}">{{ $item->user_id }}</a></td><td>{{ $item->fare_id }}</td><td>{{ $item->transaction_id }}</td><td>{{ $item->description }}</td>
                        <td>
                            <a class="btn btn-primary btn-xs" href="{{ url('admin/tickets/' . $item->id . '/edit') }}">
                               Update
                            </a> /
                            {!! Form::open([
                                'method'=>'DELETE',
                                'url' => ['admin/tickets', $item->id],
                                'style' => 'display:inline'
                            ]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <thead>
                    <tr>
                        <th>User Id</th><th>Fare Id</th><th>Transaction Id</th><th>Description</th><th>Actions</th>
                    </tr>
                </thead>
            </table>
            <div class="pagination"> {!! $tickets->render() !!} </div>
        </div>
    </div>
</section>

@endsection
