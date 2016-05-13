@extends('layouts.backend')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap.css">
@endsection

@section('title') Trip Homepage @endsection 

@section('heading') 

    Trip 
    <small>
        <a href=" {{ url('admin/trips/create') }} "class="btn btn-sm  btn-primary iframe">
            Add New Trip
        </a>
    </small>

@endsection

@section('breadcrumb')

    <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/admin/trips">Trip</a></li>
    <li><a href="/admin/trips">Index</a></li>

@endsection

@section('content')

<div class="box">
    <!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    @can('admin_full_access')<th>Company</th>@endcan
                    <th>From</th>
                    <th>To</th>
                    <th>Price</th>
                    <th>Depart At</th>
                    <th>Arrive At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($trips as $item)
                <tr>
                    @can('admin_full_access')<td> {{ $item->company->name }} </td>@endcan
                    <td>{{ $item->fromCity->getCityName() }}</td>
                    <td>{{ $item->toCity->getCityName() }}</td>
                    <td>${{ $item->price() }}</td>
                    <td>{{ $item->depart_at }}</td>
                    <td>{{ $item->arrive_at }}</td>
                    <td>
                        <a class="btn btn-info btn-xs" href="{{ url('admin/trips/' . $item->id) }}">
                           Details
                        </a> /
                        <a class="btn btn-primary btn-xs" href="{{ url('admin/trips/' . $item->id . '/edit') }}">
                           Update
                        </a> /
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/trips', $item->id],
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
                    @can('admin_full_access')<th>Company</th>@endcan
                    <th>From</th>
                    <th>To</th>
                    <th>Price</th>
                    <th>Depart At</th>
                    <th>Arrive At</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection

@section('js')
<!-- DataTables -->
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
  });
</script>
@endsection
