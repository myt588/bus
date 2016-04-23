@extends('layouts.backend')

@section('title') Rental Homepage @endsection @section('heading') Rental @endsection

@section('breadcrumb')

    <li><a href="/home">Home</a></li>
    <li><a href="/admin/rentals">Rental</a></li>
    <li><a href="/admin/rentals/create">Create</a></li>


@endsection

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="box box-warning"> 
            <div class="box-body">

                {!! Form::open(['url' => 'admin/rentals', 'class' => 'form-horizontal']) !!}

                <div class="form-group {{ $errors->has('company_id') ? 'has-error' : '' }} @can('admin') @else hidden @endcan">
                    {!! Form::label('company_id', 'Company: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        @can('admin')
                        {!! Form::select('company_id', $companies, null, ['class' => 'form-control']) !!}
                        @else
                        {!! Form::select('company_id', $companies, Auth::user()->company_id, ['class' => 'form-control']) !!}
                        @endcan
                        {!! $errors->first('company_id', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('bus_id') ? 'has-error' : ''}}">
                    {!! Form::label('bus_id', 'Bus: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::select('bus_id', $buses, null, ['class' => 'form-control']) !!}
                        {!! $errors->first('bus_id', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                    {!! Form::label('description', 'Description: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('one_day') ? 'has-error' : ''}}">
                    {!! Form::label('one_day', 'One Day: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::number('one_day', null, ['class' => 'form-control', 'step' => '0.01', 'min' => '0']) !!}
                        {!! $errors->first('one_day', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('three_days') ? 'has-error' : ''}}">
                    {!! Form::label('three_days', 'Three Days: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::number('three_days', null, ['class' => 'form-control', 'step' => '0.01', 'min' => '0']) !!}
                        {!! $errors->first('three_days', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('one_week') ? 'has-error' : ''}}">
                    {!! Form::label('one_week', 'One Week: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::number('one_week', null, ['class' => 'form-control', 'step' => '0.01', 'min' => '0']) !!}
                        {!! $errors->first('one_week', '<p class="help-block">:message</p>') !!}
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