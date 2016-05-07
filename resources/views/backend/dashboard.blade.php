@extends('layouts.backend')

@section('css')
<link rel="stylesheet" href="/css/app.css">
@endsection

@section('title') Admin Dashboard @endsection 

@section('heading') 

Dashboard 
<small>Hello, {{auth()->user()->company->name}}!</small>

@endsection

@section('breadcrumb')

<li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active"><a href="/admin/tickets">Dashboard</a></li>

@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-road"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Tirps</span>
                    <span class="info-box-number">{{$company->trips->count()}}</span>
                </div>
            <!-- /.info-box-content -->
            </div>
        <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-ticket"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Tickets Sold</span>
                    <span class="info-box-number">{{$company->ticketsCount()}}</span>
                </div>
            <!-- /.info-box-content -->
            </div>
        <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-bus"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Rentals</span>
                    <span class="info-box-number">{{$company->rentals->count()}}</span>
                </div>
            <!-- /.info-box-content -->
            </div>
        <!-- /.info-box -->
        </div>
        <!-- /.col --> 
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-money"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Sales</span>
                    <span class="info-box-number">${{$company->sales()}}</span>
                </div>
            <!-- /.info-box-content -->
            </div>
        <!-- /.info-box -->
        </div>
        <!-- /.col --> 
    </div>
    <div class="row">
        <div class="col-md-6">
            <h4 style="margin-bottom: 25px;margin-top: 20px;">Upcoming Events</h4>

            @include('backend.partials.upcoming-trips', [
                'trips'     => $trips,
                'dateSign'  => 'today +',
                ])                                                        
        </div>
        <div class="col-md-6">
            <h4 style="margin-bottom: 25px;margin-top: 20px;">Recent Orders</h4>
            <ul class="list-group">
                @foreach($orders as $item)
                @if(is_null($item->tickets->first()))
                @break;
                @endif
                <li class="list-group-item">
                    <h6 class="ellipsis">
                        <a href="">
                            Bus Ticket
                        </a>
                    </h6>
                    <p class="list-group-text">
                        <a href="">
                            <b>#{{$item->confirmation_number}}</b></a> -
                        <a href=""></a> {{$item->tickets->first()->user->fullName()}}
                        ordered {{$item->tickets->count()}} ticket.
                    </p>
                    <h6>
                        {{humanTiming($item->created_at)}} ago • <span style="color: green;">${{$item->quantity}}</span>
                    </h6>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection

@section('js')

@endsection

