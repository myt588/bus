@extends('layouts.backend')

@section('title') Rent Homepage @endsection @section('heading') Rent @endsection

@section('breadcrumb')

    <li><a href="/home">Home</a></li>
    <li><a href="/admin/rents">Rent</a></li>
    <li><a href="/admin/rents/create">Create</a></li>


@endsection

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="box box-warning"> 
            <div class="box-body">

                {!! Form::open(['url' => 'admin/rents', 'class' => 'form-horizontal']) !!}

                            <div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
                {!! Form::label('user_id', 'User Id: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('rental_id') ? 'has-error' : ''}}">
                {!! Form::label('rental_id', 'Rental Id: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('rental_id', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('rental_id', '<p class="help-block">:message</p>') !!}
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
    </section>

@endsection