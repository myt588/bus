@extends('layouts.backend')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap.css">
@endsection

@section('title') Rent Homepage @endsection 

@section('heading') 

    Rent 

@endsection

@section('breadcrumb')

    <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/admin/rents">Rent</a></li>
    <li><a href="/admin/rents">Index</a></li>

@endsection

@section('content')


<div class="box">
    <!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th># of Passengers</th>
                    <th>Desired Rental</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Ordered Date</th>
                </tr>
            </thead>
            <tbody>
            @foreach($rents as $item)
                <tr>
                    <td><a href="">{{ $item->user->fullName() }}</a></td>
                    <td>{{ $item->start}}</td>
                    <td>{{ $item->end}}</td>
                    <td>{{ $item->size}}</td>
                    <td>{{ $item->rental->bus->type }}</td>
                    <td>{{ $item->user->email }}</td>
                    <td>{{ $item->user->phone }} </td>
                    <td>{{ $item->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th># of Passengers</th>
                    <th>Desired Rental</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Ordered Date</th>
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
