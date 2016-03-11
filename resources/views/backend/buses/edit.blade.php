@extends('layouts.backend')

@section('title') Bus Homepage @endsection @section('heading') Bus @endsection

@section('breadcrumb')

    <li><a href="/home">Home</a></li>
    <li><a href="/admin/buses">Bus</a></li>
    <li><a href="/admin/buses/%{{$bus->id}}/edit">Edit</a></li>


@endsection

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="box box-warning"> 
            <div class="box-body">

                {!! Form::model($bus, [
                    'method' => 'PATCH',
                    'url' => ['admin/buses', $bus->id],
                    'class' => 'form-horizontal'
                ]) !!}
                
                @can('admin_full_access')
                <div class="form-group {{ $errors->has('company_id') ? 'has-error' : ''}}">
                    {!! Form::label('company_id', 'Company: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::select('company_id', $companies, null, ['class' => 'form-control']) !!}
                        {!! $errors->first('company_id', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                @endcan
                <div class="form-group {{ $errors->has('bus_number') ? 'has-error' : ''}}">
                    {!! Form::label('bus_number', 'Bus Number: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('bus_number', null, ['class' => 'form-control']) !!}
                        {!! $errors->first('bus_number', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('license_plate') ? 'has-error' : ''}}">
                    {!! Form::label('license_plate', 'License Plate: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('license_plate', null, ['class' => 'form-control']) !!}
                        {!! $errors->first('license_plate', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('vehicle_number') ? 'has-error' : ''}}">
                    {!! Form::label('vehicle_number', 'Vehicle Number: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('vehicle_number', null, ['class' => 'form-control']) !!}
                        {!! $errors->first('vehicle_number', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('model') ? 'has-error' : ''}}">
                    {!! Form::label('model', 'Model: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('model', null, ['class' => 'form-control']) !!}
                        {!! $errors->first('model', '<p class="help-block">:message</p>') !!}
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