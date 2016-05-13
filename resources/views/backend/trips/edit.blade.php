@extends('layouts.backend')

@section('css')
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="/plugins/timepicker/bootstrap-timepicker.min.css">
@endsection

@section('title') Trip Homepage @endsection @section('heading') Trip @endsection

@section('breadcrumb')

    <li><a href="/home">Home</a></li>
    <li><a href="/admin/trips">Trip</a></li>
    <li><a href="/admin/trips/{{$trip->id}}/edit">Edit</a></li>

@endsection

@section('content')
<div class="box box-primary"> 
    {!! Form::model($trip, [
            'method' => 'PATCH',
            'url' => ['admin/trips', $trip->id],
            'class' => 'form-horizontal'
        ]) !!}
    <div class="box-header with-border">
        <h3 class="box-title">Basic Info</h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
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
                <div class="form-group {{ $errors->has('from') ? 'has-error' : ''}}">
                    {!! Form::label('from', 'From: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::select('from', $cities, null, ['class' => 'form-control']) !!}
                        {!! $errors->first('from', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('to') ? 'has-error' : ''}}">
                    {!! Form::label('to', 'To: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::select('to', $cities, null, ['class' => 'form-control']) !!}
                        {!! $errors->first('to', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('depart_at') ? 'has-error' : ''}}">
                    {!! Form::label('depart_at', 'Depart At: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6 bootstrap-timepicker">
                        {!! Form::text('depart_at', null, ['class' => 'form-control timepicker']) !!}
                        {!! $errors->first('depart_at', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('arrive_at') ? 'has-error' : ''}}">
                    {!! Form::label('arrive_at', 'Arrive At: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6 bootstrap-timepicker">
                        {!! Form::text('arrive_at', null, ['class' => 'form-control timepicker']) !!}
                        {!! $errors->first('arrive_at', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
                    {!! Form::label('price', 'Price: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::number('price', null, ['class' => 'form-control price', 'step' => '0.01', 'min' => '0']) !!}
                        {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('discount') ? 'has-error' : ''}}">
                    {!! Form::label('discount', 'Discount: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::number('discount', null, ['class' => 'form-control discount', 'step' => '0.01', 'min' => '0', 'max' => '1']) !!}
                        {!! $errors->first('discount', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('final_price') ? 'has-error' : ''}}">
                    {!! Form::label('final_price', 'Final Price: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::number('final_price', null, ['class' => 'form-control final_price', 'readonly']) !!}
                        {!! $errors->first('final_price', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('weekdays') ? 'has-error' : ''}}">
                    {!! Form::label('weekdays', 'Weekdays: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="row col-sm-6">
                        <div class="col-sm-6">
                            {!! Form::checkbox('weekdays[]', 'WEEKDAY_SUNDAY') !!} Sunday </br>
                            {!! Form::checkbox('weekdays[]', 'WEEKDAY_MONDAY') !!} Monday </br>
                            {!! Form::checkbox('weekdays[]', 'WEEKDAY_TUESDAY') !!} Tuesday </br>
                            {!! Form::checkbox('weekdays[]', 'WEEKDAY_WEDNESDAY') !!} Wednesday 
                        </div>
                        <div class="col-sm-6">
                            {!! Form::checkbox('weekdays[]', 'WEEKDAY_THURSDAY') !!} Thursday </br>
                            {!! Form::checkbox('weekdays[]', 'WEEKDAY_FRIDAY') !!} Friday </br>
                            {!! Form::checkbox('weekdays[]', 'WEEKDAY_SATURDAY') !!} Saturday </br>
                            {!! Form::checkbox('weekdays[]', 'EVERYDAY') !!} Every Day
                        </div>
                        {!! $errors->first('weekdays', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                
                <div class="dynamic" id="departure">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Departure Stops:</label>
                        <div class="col-sm-1">
                            <button type="button" class="btn btn-default addButton"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                    @foreach($depart_stops as $index => $item)
                    <div class="form-group {{ $errors->has('depart_stops') ? 'has-error' : ''}}" id="d_template">
                        <label class="col-sm-3 control-label">Station:</label>
                        <div class="col-sm-3">
                            {!! Form::select('depart_stops[]', $stations, $item['stop'], ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-sm-3 bootstrap-timepicker">
                            {!! Form::text('depart_times[]', $item['time'], ['class' => 'form-control timepicker']) !!}
                        </div>
                        <div class="col-sm-1">
                            <button type="button" class="btn btn-default removeButton {{ $index == 0 ? "hidden" : ""}}"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="dynamic" id="arrive">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Destination Stops:</label>
                        <div class="col-sm-1">
                            <button type="button" class="btn btn-default addButton"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                    @foreach($arrive_stops as $index => $item)
                    <div class="form-group {{ $errors->has('arrive_stops') ? 'has-error' : ''}}" id="a_template">
                        <label class="col-sm-3 control-label">Station:</label>
                        <div class="col-sm-3">
                            {!! Form::select('arrive_stops[]', $stations, $item['stop'], ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-sm-3 bootstrap-timepicker">
                            {!! Form::text('arrive_times[]', $item['time'], ['class' => 'form-control timepicker']) !!}
                        </div>
                        <div class="col-sm-1">
                            <button type="button" class="btn btn-default removeButton {{ $index == 0 ? "hidden" : ""}}"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <button type="submit" class="btn btn-primary pull-right">Submit</button>
    </div>
    @include('errors.error-list')
    {!! Form::close() !!}
</div>

@endsection

@section('js')
<!-- bootstrap time picker -->
<script src="/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- Page script -->
<script>
  $(function () {
    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
    // The maximum number of options
    var MAX_OPTIONS = 5;

    $('.price, .discount').change(function(){
        $('.final_price').val($('.price').val() * $('.discount').val());
    });

    $('#final_price').val($('.price').val() * $('.discount').val());

    $('#departure, #arrive')
        .on('click', '.addButton', function() {
            if ($(this).parents('.form-group').parents('.dynamic').attr('id') == 'departure') {
                $template = $('#d_template');
            } else {
                $template = $('#a_template');
            }
            $clone    = $template
                        .clone()
                        .insertAfter($template);
            $clone.find('.removeButton').removeClass('hidden');
            $(".timepicker").timepicker({
              showInputs: false
            });
            console.log($(this).parents('.form-group').parents('.dynamic').find('.removeButton').length);
            if ($(this).parents('.form-group').parents('.dynamic').find('.removeButton').length >= MAX_OPTIONS) {
                $(this).parents('.form-group').parents('.dynamic').find('.addButton').attr('disabled', 'disabled');
            }
        })

        // Remove button click handler
        .on('click', '.removeButton', function() {
            console.log($(this).parents('.form-group').parents('.dynamic').find('.removeButton').length);
            if ($(this).parents('.form-group').parents('.dynamic').find('.removeButton').length <= MAX_OPTIONS) {
                $(this).parents('.form-group').parents('.dynamic').find('.addButton').removeAttr('disabled');
            }
            var $row    = $(this).parents('.form-group');
            $row.remove();
        });
  });
</script>
@endsection