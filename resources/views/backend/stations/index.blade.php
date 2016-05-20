@extends('layouts.backend')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap.css">
@endsection

@section('title') Station Homepage @endsection 

@section('heading') 

    Station 
    <small>
        <a href=" {{ url('admin/stations/create') }} "class="btn btn-sm  btn-primary iframe">
            Add New Station
        </a>
    </small>

@endsection

@section('breadcrumb')

    <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/admin/stations">Station</a></li>
    <li><a href="/admin/stations">Index</a></li>

@endsection

@section('content')

<div class="box">
    <!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    @can('admin_full_access')<th>Company</th>@endcan
                    <th>Name</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Zipcode</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($stations as $item)
                <tr>
                    @can('admin_full_access')<td>{{ App\Company::find($item->company_id)->name  }}</td>@endcan
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->address }}</td>
                    <td>{{ $item->city->city}}</td>
                    <td>{{ $item->city->state}}</td>
                    <td>{{ $item->city->zipcode}}</td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="{{ url('admin/stations/' . $item->id . '/edit') }}">
                           Details
                        </a> /
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/stations', $item->id],
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
                    <th>Name</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Zipcode</th>
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
