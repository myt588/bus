@extends('layouts.backend')

@section('title') Rental Homepage @endsection 

@section('heading') 

    Rental 
    <small>
        <a href=" {{ url('admin/rentals/create') }} "class="btn btn-sm  btn-primary iframe">
            Add New Rental
        </a>
    </small>

@endsection

@section('breadcrumb')

    <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/admin/rentals">Rental</a></li>
    <li><a href="/admin/rentals">Index</a></li>

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
                        <th>No.</th><th>Company Id</th><th>Bus Id</th><th>Transaction Id</th><th>Description</th><th>One Day</th><th>Three Days</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                {{-- */$x=0;/* --}}
                @foreach($rentals as $item)
                    {{-- */$x++;/* --}}
                    <tr>
                        <td>{{ $x }}</td>
                        <td><a href="{{ url('admin/rentals', $item->id) }}">{{ $item->company_id }}</a></td><td>{{ $item->bus_id }}</td><td>{{ $item->transaction_id }}</td><td>{{ $item->description }}</td><td>{{ $item->one_day }}</td><td>{{ $item->three_days }}</td>
                        <td>
                            <a class="btn btn-primary btn-xs" href="{{ url('admin/rentals/' . $item->id . '/edit') }}">
                               Update
                            </a> /
                            {!! Form::open([
                                'method'=>'DELETE',
                                'url' => ['admin/rentals', $item->id],
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
                        <th>No.</th><th>Company Id</th><th>Bus Id</th><th>Transaction Id</th><th>Description</th><th>One Day</th><th>Three Days</th><th>Actions</th>
                    </tr>
                </thead>
            </table>
            <div class="pagination"> {!! $rentals->render() !!} </div>
        </div>
    </div>
</section>

@endsection
