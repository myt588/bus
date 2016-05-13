@extends('layouts.backend')

@section('title') Transaction Homepage @endsection @section('heading') Transaction @endsection

@section('breadcrumb')

    <li><a href="/home">Home</a></li>
    <li><a href="/admin/transactions">Transaction</a></li>
    <li><a href="/admin/transactions/%{{$transaction->id}}/edit">Edit</a></li>


@endsection

@section('content')

<div class="box box-warning"> 
    <div class="box-body">

        {!! Form::model($transaction, [
            'method' => 'PATCH',
            'url' => ['admin/transactions', $transaction->id],
            'class' => 'form-horizontal'
        ]) !!}

                    <div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
        {!! Form::label('user_id', 'User Id: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::number('user_id', null, ['class' => 'form-control', 'required' => 'required']) !!}
            {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('source_id') ? 'has-error' : ''}}">
        {!! Form::label('source_id', 'Source Id: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::number('source_id', null, ['class' => 'form-control', 'required' => 'required']) !!}
            {!! $errors->first('source_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('credit') ? 'has-error' : ''}}">
        {!! Form::label('credit', 'Credit: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::number('credit', null, ['class' => 'form-control']) !!}
            {!! $errors->first('credit', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('debit') ? 'has-error' : ''}}">
        {!! Form::label('debit', 'Debit: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::number('debit', null, ['class' => 'form-control']) !!}
            {!! $errors->first('debit', '<p class="help-block">:message</p>') !!}
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
                {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
            </div>
        </div>

        {!! Form::close() !!}

    </div>
</div>

@endsection