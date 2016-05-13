@extends('layouts.backend')

@section('title') Ticket Homepage @endsection @section('heading') Ticket @endsection

@section('breadcrumb')

    <li><a href="/home">Home</a></li>
    <li><a href="/admin/tickets">Ticket</a></li>
    <li><a href="/admin/tickets/create">Create</a></li>


@endsection

@section('content')

<div class="box box-warning"> 
    <div class="box-body">

        {!! Form::open(['url' => 'admin/tickets', 'class' => 'form-horizontal']) !!}

    <div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
        {!! Form::label('user_id', 'User Id: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::number('user_id', null, ['class' => 'form-control', 'required' => 'required']) !!}
            {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('fare_id') ? 'has-error' : ''}}">
        {!! Form::label('fare_id', 'Fare Id: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::number('fare_id', null, ['class' => 'form-control', 'required' => 'required']) !!}
            {!! $errors->first('fare_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('transaction_id') ? 'has-error' : ''}}">
        {!! Form::label('transaction_id', 'Transaction Id: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::number('transaction_id', null, ['class' => 'form-control']) !!}
            {!! $errors->first('transaction_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
        {!! Form::label('description', 'Description: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
            {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
        </div>
    </div>


        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-3">
                {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
            </div>
        </div>

        {!! Form::close() !!}

    </div>
</div>

@endsection