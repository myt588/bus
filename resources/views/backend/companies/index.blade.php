@extends('layouts.backend')

@section('title') Company Homepage @endsection 

@section('heading') 

    Company 
    <small>
        <a href=" {{ url('admin/companies/create') }} "class="btn btn-sm  btn-primary iframe">
            Add New Company
        </a>
    </small>

@endsection

@section('breadcrumb')

    <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/admin/companies">Company</a></li>
    <li><a href="/admin/companies">Index</a></li>

@endsection

@section('content')
<div class="box">
    <!-- /.box-header -->
    <div class="box-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Name</th><th>Year Founded</th><th>Rate</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($companies as $item)
                <tr>
                    <td><a href="{{ url('admin/companies', $item->id) }}">{{ $item->name }}</a></td>
                    <td>{{ $item->year_founded }}</td>
                    <td>{{ $item->rating }}</td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="{{ url('admin/companies/' . $item->id . '/edit') }}">
                           Update
                        </a> /
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/companies', $item->id],
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
                    <th>Name</th><th>Year Founded</th><th>Rate</th><th>Actions</th>
                </tr>
            </thead>
        </table>
        <div class="pagination"> {!! $companies->render() !!} </div>
    </div>
</div>

@endsection
