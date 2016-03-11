@extends('layouts.backend')

@section('title') Company Homepage @endsection @section('heading') Company @endsection

@section('breadcrumb')

    <li><a href="/home">Home</a></li>
    <li><a href="/admin/companies">Company</a></li>
    <li><a href="/admin/companies/create">Create</a></li>


@endsection

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="box box-warning"> 
            <div class="box-body">

                {!! Form::open(['url' => 'admin/companies', 'class' => 'form-horizontal']) !!}

                            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('name', 'Name: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('year_founded') ? 'has-error' : ''}}">
                {!! Form::label('year_founded', 'Year Founded: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('year_founded', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('year_founded', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('rate') ? 'has-error' : ''}}">
                {!! Form::label('rate', 'Rate: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('rate', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('rate', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('verified') ? 'has-error' : ''}}">
                {!! Form::label('verified', 'Verified: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                                <div class="checkbox">
                <label>{!! Form::radio('verified', '1') !!} Yes</label>
            </div>
            <div class="checkbox">
                <label>{!! Form::radio('verified', '0', true) !!} No</label>
            </div>
                    {!! $errors->first('verified', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('code') ? 'has-error' : ''}}">
                {!! Form::label('code', 'Code: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('code', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
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