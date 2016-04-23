@extends('layouts.backend')

@section('title') Rent Homepage @endsection 

@section('heading') 

    Rent 
    <small>
        <a href=" {{ url('admin/rents/create') }} "class="btn btn-sm  btn-primary iframe">
            Add New Rent
        </a>
    </small>

@endsection

@section('breadcrumb')

    <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/admin/rents">Rent</a></li>
    <li><a href="/admin/rents">Index</a></li>

@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>User Id</th><th>Rental Id</th><th>Transaction Id</th><th>Description</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($rents as $item)
                    <tr>
                        <td><a href="{{ url('admin/rents', $item->id) }}">{{ $item->user_id }}</a></td><td>{{ $item->rental_id }}</td><td>{{ $item->transaction_id }}</td><td>{{ $item->description }}</td>
                        <td>
                            <a class="btn btn-info btn-xs" href="{{ url('admin/rents/' . $item->id ) }}">
                               Details
                            </a> /
                            <a class="btn btn-primary btn-xs" href="{{ url('admin/rents/' . $item->id . '/edit') }}">
                               Update
                            </a> /
                            {!! Form::open([
                                'method'=>'DELETE',
                                'url' => ['admin/rents', $item->id],
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
                        <th>User Id</th><th>Rental Id</th><th>Transaction Id</th><th>Description</th><th>Actions</th>
                    </tr>
                </thead>
            </table>
            <div class="pagination"> {!! $rents->render() !!} </div>
        </div>
    </div>
</section>

@endsection
