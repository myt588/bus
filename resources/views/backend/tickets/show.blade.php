@extends('layouts.backend')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap.css">
@endsection

@section('title') Passengers Homepage @endsection @section('heading') Passengers @endsection

@section('breadcrumb')

    <li><a href="/admin/dashboard">Home</a></li>
    <li><a href="">Passengers</a></li>

@endsection

@section('content')
<section class="content">
    <div class="box">
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Trip</th>
                        <th>Transaction</th>
                        <th>Buyer Name</th>
                        <th>Passenger Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($tickets as $item)
                    <tr>
                        <td>{{ $item->trip->name }}</td>
                        <td>{{ $item->transaction_id }}</td>
                        <td><a href="">{{ $item->user->fullName() }}</a></td>
                        <td>{{ $item->description }}</td>
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
            </table>
        </div>
    </div>
</section>

@endsection

@section('js')
<!-- DataTables -->
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
        "iDisplayLength": 25
    });
  });
</script>
@endsection