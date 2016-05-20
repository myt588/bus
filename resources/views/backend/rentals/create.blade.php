@extends('layouts.backend')

@section('css')

<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

@endsection

@section('title') Rental Homepage @endsection @section('heading') Rental @endsection

@section('breadcrumb')

    <li><a href="/home">Home</a></li>
    <li><a href="/admin/rentals">Rental</a></li>
    <li><a href="/admin/rentals/create">Create</a></li>


@endsection

@section('content')

@include('backend.partials.info-box', ['info_header' => 'Tips!', 'info' => 'You must set the rental price for each bus!'])
<div class="box box-warning"> 
    {!! Form::open(['url' => 'admin/rentals']) !!}
    <div class="box-header">
        <h3 class="box-title">Create Rental</h3>
        <!-- tools box -->
        <div class="pull-right box-tools">
            <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
        </div>
        <!-- /. tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body pad">
        <textarea name="description" class="textarea" placeholder="Enter the Description/Policy of the Rental Here" style="width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
        <br></br>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('company_id') ? 'has-error' : '' }} @can('admin') @else hidden @endcan">
                    <div class="col-sm-6">
                        @can('admin')
                        {!! Form::select('company_id', $companies, null, ['class' => 'form-control', 'placeholder' => 'company id']) !!}
                        @else
                        {!! Form::select('company_id', $companies, Auth::user()->company_id, ['class' => 'form-control', 'placeholder' => 'company id']) !!}
                        @endcan
                        {!! $errors->first('company_id', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('bus_id') ? 'has-error' : ''}}">
                    {!! Form::select('bus_id', $buses, null, ['class' => 'form-control', 'placeholder' => 'Please Pick a Bus Number']) !!}
                    {!! $errors->first('bus_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('per_hour') ? 'has-error' : ''}}">
                    <div class="input-group">
                        <span class="input-group-addon">$</span>
                        {!! Form::number('per_hour', null, ['class' => 'form-control', 'step' => '0.01', 'min' => '0', 'placeholder' => 'Price Per Hour']) !!}
                        <span class="input-group-addon">.00</span>
                    </div>
                    {!! $errors->first('per_hour', '<p class="help-block">:message</p>') !!}
                </div>
                <div class="form-group {{ $errors->has('per_day') ? 'has-error' : ''}}">
                    <div class="input-group">
                        <span class="input-group-addon">$</span>
                        {!! Form::number('per_day', null, ['class' => 'form-control', 'step' => '0.01', 'min' => '0', 'placeholder' => 'Price Per Day']) !!}
                        <span class="input-group-addon">.00</span>
                    </div>
                    {!! $errors->first('per_day', '<p class="help-block">:message</p>') !!}
                </div>
                <div class="form-group {{ $errors->has('per_week') ? 'has-error' : ''}}">
                    <div class="input-group">
                        <span class="input-group-addon">$</span>
                        {!! Form::number('per_week', null, ['class' => 'form-control', 'step' => '0.01', 'min' => '0', 'placeholder' => 'Price Per Week']) !!}
                        <span class="input-group-addon">.00</span>
                    </div>  
                    {!! $errors->first('per_week', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
        @include('errors.error-list')
    </div>

    <div class="box-footer">
        {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
</div>

@endsection

@section('js')
<!-- Bootstrap WYSIHTML5 -->
<script src="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
  $(function () {
    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();
    $('.textarea').html('{{old('description')}}');
  });
</script>
@endsection
