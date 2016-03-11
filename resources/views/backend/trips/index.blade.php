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
<!-- Main content -->
<section class="content">
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>S.No</th>
                        @can('admin_full_access')<th>Company</th>@endcan
                        <th>From</th>
                        <th>To</th>
                        <th>Rating</th>
                        <th>Depart At</th>
                        <th>Arrive At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                {{-- */$x=0;/* --}}
                @foreach($trips as $item)
                    {{-- */$x++;/* --}}
                    <tr>
                        <td><a href="{{ url('admin/trips', $item->id) }}">{{ $x }}</a></td>
                        @can('admin_full_access')<td> {{ App\Company::find($item->company_id)->name }} </td>@endcan
                        <td>{{ App\Station::find($item->from)->name }}</td>
                        <td>{{ App\Station::find($item->to)->name }}</td>
                        <td>{{ $item->rating }}</td>
                        <td>{{ $item->depart_at }}</td>
                        <td>{{ $item->arrive_at }}</td>
                        <td>
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
                        <th>S.No</th>
                        @can('admin_full_access')<th>Company</th>@endcan
                        <th>From</th>
                        <th>To</th>
                        <th>Rating</th>
                        <th>Depart At</th>
                        <th>Arrive At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
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
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
@endsection
