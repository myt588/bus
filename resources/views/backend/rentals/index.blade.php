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
                    <th>One Day</th>
                    <th>Three Days</th>
                    <th>One Week</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($rentals as $item)
                <tr>
                    @can('admin_full_access')<td>{{ $item->company_id }}</td>@endcan
                    <td>{{ $item->bus->bus_number }}</td>
                    <td>${{ $item->one_day }}</td>
                    <td>${{ $item->three_days }}</td>
                    <td>${{ $item->one_week }}</td>
                    <td>
                        <a class="btn btn-info btn-xs" href="{{ url('admin/rentals/' . $item->id) }}">
                           Details
                        </a> /
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
                    @can('admin_full_access')<th>Company</th>@endcan
                    <th>Bus</th>
                    <th>One Day</th>
                    <th>Three Days</th>
                    <th>One Week</th>
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
