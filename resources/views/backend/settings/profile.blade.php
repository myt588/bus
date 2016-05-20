@extends('layouts.backend')

@section('css')

@endsection

@section('title') Company Info @endsection 

@section('heading') 

    Company Info 

@endsection

@section('breadcrumb')

    <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="">Company Info</a></li>

@endsection

@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
                <div class="widget-user-image">
                    <img class="img-circle" src="{{$user->photo}}" alt="User Avatar">
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username">{{$user->company->name}}</h3>
                <h5 class="widget-user-desc">{{$user->company->base}}</h5>
            </div>
            <div class="box-footer no-padding">
                <ul class="nav nav-stacked">
                    <li><a href="#">Founded in <span class="pull-right badge bg-blue">{{$user->company->year_founded}}</span></a></li>
                    <li><a href="#">Bus Code <span class="pull-right badge bg-aqua">{{$user->company->code}}</span></a></li>
                </ul>
            </div>
        </div>
        <h2>Change Profile Photo</h2>
        {!! Form::open(['route' => 'admin::settings.update', 'files' => true]) !!}
        <div class="form-group">
            <div class="col-sms-12 col-sm-6 no-float">
                <div class="fileinput full-width">
                    <input name="photo" type="file" class="input-text" data-placeholder="select image/s">
                </div>
            </div>
            <div class="from-group">
                <button type="submit" class="btn btn-primary">upload</button>
            </div>
        </div>
        {!! Form::close() !!}
        @include('errors.error-list')
    </div>
    <!-- /.col -->
    <div class="col-md-8"></div>
    <!-- /.col -->
</div>
<!-- /.row -->  

@endsection

@section('js')

@endsection
