@extends('layouts.backend')

@section('title') Bus Homepage @endsection @section('heading') Bus @endsection

@section('breadcrumb')

    <li><a href="/home"><i class="fa fa-dashboard"></i>Home</a></li>
    <li><a href="/admin/buses">Bus</a></li>
    <li><a href="/admin/buses/%{{$bus->id}}">Show</a></li>

@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-text-width"></i>

                    <h3 class="box-title">{{ $bus->bus_number }}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt>License Plate</dt>
                        <dd>{{ $bus->license_plate }}</dd>
                        <dt>Make</dt>
                        <dd>{{ $bus->make }}</dd>
                        <dt>Model</dt>
                        <dd>{{ $bus->model }}</dd>
                        <dt>Year</dt>
                        <dd>{{ $bus->year }}</dd>
                        <dt># of Seats</dt>
                        <dd>{{ $bus->seats }}</dd>
                        <dt>Features</dt>
                        <dd>{{ $bus->features() }}</dd>
                    </dl>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
    
</section>
   

@endsection