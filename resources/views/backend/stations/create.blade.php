@extends('layouts.backend')

@section('title') Station Homepage @endsection @section('heading') Station @endsection

@section('breadcrumb')

    <li><a href="/home">Home</a></li>
    <li><a href="/admin/stations">Station</a></li>
    <li><a href="/admin/stations/create">Create</a></li>


@endsection

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="box box-warning"> 
            <div class="box-body">

                {!! Form::open(['url' => 'admin/stations', 'class' => 'form-horizontal']) !!}

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
                <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                    {!! Form::label('name', 'Name: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
                    {!! Form::label('address', 'Address: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('address', null, ['class' => 'form-control']) !!}
                        {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
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