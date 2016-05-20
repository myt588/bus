@extends('layouts.backend')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap.css">
@endsection

@section('title') Bus Homepage @endsection 

@section('heading') 

    Bus 
    <small>
        <a href=" {{ url('admin/buses/create') }} "class="btn btn-sm  btn-primary iframe">
            Add New Bus
        </a>
    </small>

@endsection

@section('breadcrumb')

    <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/admin/buses">Bus</a></li>
    <li><a href="/admin/buses">Index</a></li>

@endsection

@section('content')
<div class="box">
    <!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    @can('admin_full_access')<th>Company</th>@endcan
                    <th>Bus Number</th>
                    <th>License Plate</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Year</th>
                    <th># of Seats</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($buses as $item)
                <tr>
                    @can('admin_full_access')<td>{{ App\Company::find($item->company_id)->name }}@endcan
                    <td>{{ $item->bus_number }}</td>
                    <td>{{ $item->license_plate }}</td>
                    <td>{{ $item->make }}</td>
                    <td>{{ $item->model }}</td>
                    <td>{{ $item->year }}</td>
                    <td>{{ $item->seats }}</td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="{{ url('admin/buses/' . $item->id . '/edit') }}">
                           Details
                        </a> /
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/buses', $item->id],
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
                    <th>Bus Number</th>
                    <th>License Plate</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Year</th>
                    <th># of Seats</th>
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
