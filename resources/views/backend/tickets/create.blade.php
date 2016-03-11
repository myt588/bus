@extends('layouts.backend')

@section('title') Ticket Homepage @endsection @section('heading') Ticket @endsection

@section('breadcrumb')

    <li><a href="/home">Home</a></li>
    <li><a href="/admin/tickets">Ticket</a></li>
    <li><a href="/admin/tickets/create">Create</a></li>


@endsection

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="box box-warning"> 
            <div class="box-body">

                {!! Form::open(['id' => 'surveyForm', 'url' => 'admin/tickets', 'class' => 'form-horizontal']) !!}

                @can('admin_full_access')
                <div class="form-group {{ $errors->has('company_id') ? 'has-error' : ''}}">
                    {!! Form::label('company_id', 'Company: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::select('company_id', $companies, null, ['class' => 'form-control']) !!}
                        {!! $errors->first('company_id', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                @endcan
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
                <div class="form-group {{ $errors->has('trip') ? 'has-error' : ''}}">
                    <label class="col-sm-3 control-label">Trip:</label>
                    <div class="col-sm-6">
                        {!! Form::select('trip_id[]', $trips, null, ['class' => 'form-control']) !!}
                        {!! $errors->first('trip_id[]', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="col-sm-1">
                        <button type="button" class="btn btn-default addButton"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <!-- The option field template containing an option field and a Remove button -->
                <div class="form-group hide" id="optionTemplate">
                    <div class="col-sm-offset-3 col-sm-6">
                        {!! Form::select('trip_id[]', $trips, null, ['class' => 'form-control', 'disabled']) !!}
                        {!! $errors->first('trip_id[]', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="col-sm-1">
                        <button type="button" class="btn btn-default removeButton"><i class="fa fa-minus"></i></button>
                    </div>
                </div>

                <div class="form-group {{ $errors->has('discount') ? 'has-error' : ''}}">
                    {!! Form::label('final_price', 'Final Price: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::number('final_price', null, ['class' => 'form-control final_price', 'readonly']) !!}
                        {!! $errors->first('final_price', '<p class="help-block">:message</p>') !!}
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

@section('js')
<script>
  $(function () {
    // The maximum number of options
    var MAX_OPTIONS = 5;
    $('.price, .discount').change(function(){
        $('.final_price').val($('.price').val() * $('.discount').val());
    });
    $('#surveyForm')
        // Add button click handler
        .on('click', '.addButton', function() {
            var $template = $('#optionTemplate'),
                $clone    = $template
                                .clone()
                                .removeClass('hide')
                                .removeAttr('id')
                                .insertBefore($template),
                $stop   = $clone.find('[name="trip_id[]"]').removeAttr('disabled');
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