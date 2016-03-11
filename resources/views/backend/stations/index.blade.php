@extends('layouts.backend')

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
                        <th>Name</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                {{-- */$x=0;/* --}}
                @foreach($stations as $item)
                    {{-- */$x++;/* --}}
                    <tr>
                        <td><a href="{{ url('admin/stations', $item->id) }}">{{ $x }}</a></td>
                        @can('admin_full_access')<td>{{ App\Company::find($item->company_id)->name  }}</td>@endcan
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->address }}</td>
                        <td>
                            <a class="btn btn-primary btn-xs" href="{{ url('admin/stations/' . $item->id . '/edit') }}">
                               Update
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
            </table>
            <div class="pagination"> {!! $stations->render() !!} </div>
        </div>
    </div>
</section>

@endsection
