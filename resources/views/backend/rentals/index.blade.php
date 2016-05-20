@extends('layouts.backend')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap.css">
@endsection

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

<div class="box">
    <!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    @can('admin_full_access')<th>Company</th>@endcan
                    <th>Bus</th>
                    <th>Per Hour</th>
                    <th>Per Day</th>
                    <th>Per Week</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($rentals as $item)
                <tr>
                    @can('admin_full_access')<td>{{ $item->company_id }}</td>@endcan
                    <td>{{ $item->bus->bus_number }}</td>
                    <td>${{ $item->per_hour }}</td>
                    <td>${{ $item->per_day }}</td>
                    <td>${{ $item->per_week }}</td>
                    <td>
                        {!! Form::open([
                            'method'=>'POST',
                            'route' => ['admin::rentals.active', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            @if($item->active)
                            {!! Form::submit('Deactivate', ['class' => 'btn btn-warning btn-xs']) !!}
                            @else
                            {!! Form::submit('Activate', ['class' => 'btn btn-success btn-xs']) !!}
                            @endif
                        {!! Form::close() !!} /
                        <a class="btn btn-primary btn-xs" href="{{ url('admin/rentals/' . $item->id . '/edit') }}">
                           Details
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
                    @can('admin_full_access')<th>Company</th>@endcan
                    <th>Bus</th>
                    <th>Per Hour</th>
                    <th>Per Day</th>
                    <th>Per Week</th>
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
