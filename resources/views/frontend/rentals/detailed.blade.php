@extends('layouts.frontend')

@section('css')

<link rel="stylesheet" href="/css/app.css">

@endsection

@section('title') Rental Detail @endsection @section('heading') Rental Detail @endsection

@section('breadcrumb')

<div class="page-title-container">
    <div class="container">
        <div class="page-title pull-left">
            <h2 class="entry-title">Rental Detail</h2>
        </div>
        <ul class="breadcrumbs pull-right">
            <li><a href="{{url('/')}}">HOME</a></li>
            <li class="active">Rental Detail</li>
        </ul>
    </div>
</div>

@endsection

@section('content')
<section id="content">
    <div class="container car-detail-page">
        <div class="row">
            <div id="main" class="col-md-9">
                <div class="featured-image box">
                    <img src="http://placehold.it/870x496.png" alt="" />
                </div>
                <div class="tab-container">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="car-details">
                            <div class="intro box table-wrapper full-width hidden-table-sms">
                                <div class="col-sm-4 table-cell travelo-box">
                                    <dl class="term-description">
                                        <dt>Operator:</dt><dd>{{$rental->company->name}}</dd>
                                        <dt>Bus Type:</dt><dd>{{$rental->bus->type}}</dd>
                                        <dt>Bus name:</dt><dd>{{$rental->bus->makeModel()}}</dd>
                                        <dt>seats:</dt><dd>{{$rental->bus->seats}}</dd>
                                        <dt>Bus features:</dt><dd>{{$rental->bus->features()}}
                                        <dt>Price per Day</dt><dd>${{$rental->one_day}}</dd>
                                        <dt>Price per Week</dt><dd>${{$rental->one_week}}</dd>
                                        <dt>Estimated Total</dt><dd>${{$total}}</dd>
                                    </dl>
                                </div>
                                <div class="col-sm-8 table-cell">
                                    <div class="detailed-features clearfix">
                                        <div class="col-md-6">
                                            <h4 class="box-title">
                                                Pick-up location
                                            </h4>
                                            <div class="icon-box style11">
                                                <div class="icon-wrapper">
                                                    <i class="soap-icon-clock"></i>
                                                </div>
                                                <dl class="details">
                                                    <dt class="skin-color">Start Date</dt>
                                                    <dd>{{$data['start']}}</dd>
                                                </dl>
                                            </div>
                                            <div class="icon-box style11">
                                                <div class="icon-wrapper">
                                                    <i class="soap-icon-departure"></i>
                                                </div>
                                                <dl class="details">
                                                    <dt class="skin-color">Location</dt>
                                                    <dd>{{$location}} area</dd>
                                                </dl>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h4 class="box-title">
                                                Drop-off location 
                                            </h4>
                                            <div class="icon-box style11">
                                                <div class="icon-wrapper">
                                                    <i class="soap-icon-clock"></i>
                                                </div>
                                                <dl class="details">
                                                    <dt class="skin-color">End Date</dt>
                                                    <dd>{{$data['end']}} </dd>
                                                </dl>
                                            </div>
                                            <div class="icon-box style11">
                                                <div class="icon-wrapper">
                                                    <i class="soap-icon-departure"></i>
                                                </div>
                                                <dl class="details">
                                                    <dt class="skin-color">Location</dt>
                                                    <dd>{{$location}} area</dd>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="alert alert-notice">
                                    Surcharge may apply when vehicle starts or ends hire at different places or outside the area of operator's base location. Surcharge amount depends on locations.
                            </div>
                            <div class="policy">
                                <ul class="circle skin-color bullet-yellow box">
                                <li>Overuse charges – $100 per hour or part thereof.</li>
                                <li>Bus Hire is provided for 1 group of passengers only ie. Bus Hire is not to be used to transport different groups of people during the hire.</li>
                            </ul>
                            </div>
                            <div class="policy">
                                <h2>Inclusions</h2>
                                <ul class="circle skin-color bullet-yellow box">
                                    <li>Driver</li>
                                    <li>Fuel</li>
                                    <li>Insurance</li>
                                    <li>Unlimited kilometres</li>
                                    <li>up to 8 hours usage</li>
                                    <li>up to 12 hours usage add ¥15,000 (12 hour usage option must be decided at time of booking otherwise overuse charges apply)</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sidebar col-md-3">
                <article class="detailed-logo">
                    <figure>
                        <img width="114" height="85" src="http://placehold.it/114x85" alt="">
                    </figure>
                    <div class="details">
                        <h2 class="box-title">BMW Mini<small>economy car</small></h2>
                        <span class="price clearfix">
                            <small class="pull-left">per day</small>
                            <span class="pull-right">${{$rental->one_day}}</span>
                        </span>
                        <div class="price clearfix">
                            <small class="pull-left">Total</small>
                            <span class="pull-right">${{$total}}</span>
                        </div>
                        <p class="description">Nunc cursus libero purus ac congue ar lorem cursus ut sed vitae pulvinar massa idend porta nequetiam elerisque mi id, consectetur adipi deese cing elit maus fringilla bibe endum.</p>
                        <a class="button yellow full-width uppercase btn-small" href="{{route('rentals.booking', $data)}}">book now</a>
                    </div>
                </article>
                @include('frontend.partials.help-box') 
            </div>
        </div>
    </div>
</section>

@endsection

@section('js')
 <!-- Google Map Api -->
<script type='text/javascript' src="http://maps.google.com/maps/api/js?sensor=false&amp;language=en"></script>
<script type="text/javascript" src="/js/gmap3.min.js"></script>
<!-- <script type="text/javascript" src="/js/app.js"></script> -->
@endsection