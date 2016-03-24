@extends('layouts.backend')

@section('css')
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="/plugins/timepicker/bootstrap-timepicker.min.css">
@endsection

@section('title') Trip Homepage @endsection @section('heading') Trip @endsection

@section('breadcrumb')

    <li><a href="/home">Home</a></li>
    <li><a href="/admin/trips">Trip</a></li>
    <li><a href="/admin/trips/%{{$trip->id}}/edit">Edit</a></li>

@endsection

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="box box-warning"> 
            <div class="box-body">

                {!! Form::model($trip, [
                    'id' => 'surveyForm',
                    'method' => 'PATCH',
                    'url' => ['admin/trips', $trip->id],
                    'class' => 'form-horizontal'
                ]) !!}
                
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
                        {!! Form::select('from', $stations, null, ['class' => 'form-control']) !!}
                        {!! $errors->first('from', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('to') ? 'has-error' : ''}}">
                    {!! Form::label('to', 'To: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::select('to', $stations, null, ['class' => 'form-control']) !!}
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
                <div class="form-group">
                    <label class="col-sm-3 control-label">Additional Stop(s):</label>
                    <div class="col-sm-1">
                        <button type="button" class="btn btn-default addButton"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                @for($i = 0; $i < count($stop); $i ++)
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-4">
                        {!! Form::select('stop[]', $stations, $stop[$i], ['class' => 'form-control']) !!}
                    </div>
                    <div class="col-sm-4 bootstrap-timepicker">
                        {!! Form::text('time[]', $time[$i], ['class' => 'form-control timepicker']) !!}
                    </div>
                    <div class="col-sm-1">
                        <button type="button" class="btn btn-default removeButton"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                @endfor
                <!-- The option field template containing an option field and a Remove button -->
                <div class="form-group hide" id="optionTemplate">
                    <div class="col-sm-offset-3 col-sm-4">
                        {!! Form::select('stop[]', $stations, null, ['class' => 'form-control', 'disabled']) !!}
                    </div>
                    <div class="col-sm-4 bootstrap-timepicker">
                        {!! Form::text('time[]', null, ['class' => 'form-control timepicker', 'disabled']) !!}
                    </div>
                    <div class="col-sm-1">
                        <button type="button" class="btn btn-default removeButton"><i class="fa fa-minus"></i></button>
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
    </section>

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

    $('#surveyForm')
        // Add button click handler
        .on('click', '.addButton', function() {
            var $template = $('#optionTemplate'),
                $clone    = $template
                                .clone()
                                .removeClass('hide')
                                .removeAttr('id')
                                .insertBefore($template),
                $stop   = $clone.find('[name="stop[]"]').removeAttr('disabled');
                $time   = $clone.find('[name="time[]"]').removeAttr('disabled');
            // Add new field
        })

        // Remove button click handler
        .on('click', '.removeButton', function() {
            var $row    = $(this).parents('.form-group'),
                $option = $row.find('[name="option[]"]');

            // Remove element containing the option
            $row.remove();

            // Remove field
        })

        // Called after adding new field
        .on('added.field.fv', function(e, data) {
            // data.field   --> The field name
            // data.element --> The new field element
            // data.options --> The new field options

            if (data.field === 'option[]') {
                if ($('#surveyForm').find(':visible[name="option[]"]').length >= MAX_OPTIONS) {
                    $('#surveyForm').find('.addButton').attr('disabled', 'disabled');
                }
            }
        })

        // Called after removing the field
        .on('removed.field.fv', function(e, data) {
           if (data.field === 'option[]') {
                if ($('#surveyForm').find(':visible[name="option[]"]').length < MAX_OPTIONS) {
                    $('#surveyForm').find('.addButton').removeAttr('disabled');
                }
            }
        });
  });
</script>
@endsection