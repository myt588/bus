@extends('layouts.backend')

@section('title') Transaction Homepage @endsection 

@section('heading') 

    Transaction 
    <small>
        <a href=" {{ url('admin/transactions/create') }} "class="btn btn-sm  btn-primary iframe">
            Add New Transaction
        </a>
    </small>

@endsection

@section('breadcrumb')

    <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/admin/transactions">Transaction</a></li>
    <li><a href="/admin/transactions">Index</a></li>

@endsection

@section('content')

<div class="box">
    <!-- /.box-header -->
    <div class="box-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>User Id</th><th>Source Id</th><th>Credit</th><th>Debit</th><th>Description</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($transactions as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('admin/transactions', $item->id) }}">{{ $item->user_id }}</a></td><td>{{ $item->source_id }}</td><td>{{ $item->credit }}</td><td>{{ $item->debit }}</td><td>{{ $item->description }}</td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="{{ url('admin/transactions/' . $item->id . '/edit') }}">
                           Update
                        </a> /
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/transactions', $item->id],
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
                    <th>User Id</th><th>Source Id</th><th>Credit</th><th>Debit</th><th>Description</th><th>Actions</th>
                </tr>
            </thead>
        </table>
        <div class="pagination"> {!! $transactions->render() !!} </div>
    </div>
</div>

@endsection
