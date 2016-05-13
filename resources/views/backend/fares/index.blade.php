@extends('layouts.backend')

@section('title') Fare Homepage @endsection 

@section('heading') 

    Fare 
    <small>
        <a href=" {{ url('admin/fares/create') }} "class="btn btn-sm  btn-primary iframe">
            Add New Fare
        </a>
    </small>

@endsection

@section('breadcrumb')

    <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/admin/fares">Fare</a></li>
    <li><a href="/admin/fares">Index</a></li>

@endsection

@section('content')

<div class="box">
    <!-- /.box-header -->
    <div class="box-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>S.No</th><th>Final Price</th><th>Price</th><th>Discount</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($fares as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('admin/fares', $item->id) }}">{{ $item->final_price }}</a></td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->discount }}</td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="{{ url('admin/fares/' . $item->id . '/edit') }}">
                           Update
                        </a> /
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/fares', $item->id],
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
                    <th>S.No</th><th>Final Price</th><th>Price</th><th>Discount</th><th>Actions</th>
                </tr>
            </thead>
        </table>
        <div class="pagination"> {!! $fares->render() !!} </div>
    </div>
</div>


@endsection
