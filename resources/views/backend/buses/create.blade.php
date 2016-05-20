@extends('layouts.backend')

@section('title') Bus Homepage @endsection @section('heading') Bus @endsection

@section('breadcrumb')

    <li><a href="/home">Home</a></li>
    <li><a href="/admin/buses">Bus</a></li>
    <li><a href="/admin/buses/create">Create</a></li>


@endsection

@section('content')

@include('backend.partials.info-box', ['info_header' => 'Tips!', 'info' => 'Bus Number cannot be changed after creation!'])
<div class="box box-primary"> 
    <div class="box-header">
        <h3 class="box-title">Create Bus</h3>
        <!-- tools box -->
        <div class="pull-right box-tools">
            <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
        </div>
        <!-- /. tools -->
    </div>
    <div class="box-body">

        {!! Form::open(['url' => 'admin/buses', 'class' => 'form-horizontal']) !!}
        
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
        
        <div class="form-group {{ $errors->has('bus_number') ? 'has-error' : ''}}">
            {!! Form::label('bus_number', 'Bus Number: ', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('bus_number', null, ['class' => 'form-control bus-number']) !!}
                {!! $errors->first('bus_number', '<p class="help-block">:message</p>') !!}
            </div>
            <button id="random" type="button" class="btn btn-default">random</button>
        </div>
        <div class="form-group {{ $errors->has('license_plate') ? 'has-error' : ''}}">
            {!! Form::label('license_plate', 'License Plate: ', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('license_plate', null, ['class' => 'form-control']) !!}
                {!! $errors->first('license_plate', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('make') ? 'has-error' : ''}}">
            {!! Form::label('make', 'Make: ', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('make', null, ['class' => 'form-control']) !!}
                {!! $errors->first('make', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('model') ? 'has-error' : ''}}">
            {!! Form::label('model', 'Model: ', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('model', null, ['class' => 'form-control']) !!}
                {!! $errors->first('model', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
            {!! Form::label('type', 'Type: ', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::select('type', ['Mini-bus', 'Economy Bus', 'Full Size Bus', 'Luxury Bus'], null, ['class' => 'form-control']) !!}
                {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('year') ? 'has-error' : ''}}">
            {!! Form::label('year', 'Year: ', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::number('year', null, ['class' => 'form-control']) !!}
                {!! $errors->first('year', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('seats') ? 'has-error' : ''}}">
            {!! Form::label('seats', 'Seats: ', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::number('seats', null, ['class' => 'form-control']) !!}
                {!! $errors->first('seats', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('vehicle_number') ? 'has-error' : ''}}">
            {!! Form::label('vehicle_number', 'Vehicle Number: ', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('vehicle_number', null, ['class' => 'form-control']) !!}
                {!! $errors->first('vehicle_number', '<p class="help-block">:message</p>') !!}
            </div>
            Optional
        </div>
        <div class="form-group {{ $errors->has('features') ? 'has-error' : ''}}">
            {!! Form::label('features', 'Features: ', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::checkbox('wifi', true) !!} Wifi
                {!! Form::checkbox('usb', true) !!} USB
                {!! Form::checkbox('toilet', true) !!} Toilet
                {!! $errors->first('features', '<p class="help-block">:message</p>') !!}
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

@section('js')
<script>
  $(function () {

    $('#random').on('click', function() {
        $('.bus-number').val('{{Auth::user()->company->code}}' + Math.floor((Math.random() * 1000) + 10));
    });
  });
</script>
@endsection 
