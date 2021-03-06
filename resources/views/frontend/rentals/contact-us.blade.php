@extends('layouts.frontend')

@section('css')

<link rel="stylesheet" href="/css/app.css">

@endsection

@section('title') Rental Booking @endsection @section('heading') Rental Booking @endsection

@section('breadcrumb')

<div class="page-title-container">
    <div class="container">
        <div class="page-title pull-left">
            <h2 class="entry-title">Rental Booking</h2>
        </div>
        <ul class="breadcrumbs pull-right">
            <li><a href="{{url('/')}}">HOME</a></li>
            <li class="active">Rental Booking</li>
        </ul>
    </div>
</div>

@endsection

@section('content')
<section id="content">
    <div class="container">
        <div class="row">
            <div id="main" class="col-sms-6 col-sm-8 col-md-9">
                <div class="booking-section travelo-box">
                    {!! Form::open(['route' => 'rentals.confirm', 'class' => 'booking-form', 'id' => 'booking-form']) !!}
                        {!! Form::text('id', $data['id'], ['hidden']) !!}
                        <div class="person-information">
                            <h2>Your Personal Information</h2>
                            <div class="form-group row">
                                <div class="col-sm-6 col-md-5">
                                    <label>first name</label>
                                    <input name="first_name" type="text" class="input-text full-width" value="{{ Auth::check() ? Auth::user()->first_name : "" }}" placeholder="" />
                                </div>
                                <div class="col-sm-6 col-md-5">
                                    <label>last name</label>
                                    <input name="last_name" type="text" class="input-text full-width" value="{{ Auth::check() ? Auth::user()->last_name : "" }}" placeholder="" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 col-md-5">
                                    <label>email address</label>
                                    <input name="email" type="text" class="input-text full-width" value="{{ Auth::check() ? Auth::user()->email : "" }}" placeholder="" />
                                </div>
                                @if(!Auth::check())
                                <div class="col-sm-6 col-md-5">
                                    <label>Verify E-mail Address</label>
                                    <input name="email_re" type="text" class="input-text full-width" value="" placeholder="" />
                                </div>
                                @endif
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 col-md-5">
                                    <label>Country code</label>
                                    <div class="selector">
                                        <select class="full-width">
                                            <option>United States (+1)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-5">
                                    <label>Phone number</label>
                                    <input name="phone" type="text" class="input-text full-width" value="{{ Auth::check() ? Auth::user()->phone : "" }}" placeholder="" />
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input name="agreement" type="checkbox"> By continuing, you agree to the <a href="{{route('site.policy')}}"><span class="skin-color">Terms and Conditions</span></a>.
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 col-md-5">
                                <button type="submit" class="full-width btn-large">CONFIRM BOOKING</button>
                            </div>
                        </div>
                        @include('errors.error-list')
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="sidebar col-sms-6 col-sm-4 col-md-3">
                <div class="booking-details travelo-box">
                    <h4>Booking Details</h4>
                    <article class="car-detail">
                        <div class="travel-title">
                            <h5 class="box-title">{{$rental->bus->getMakeModel()}}<small>{{$rental->bus->type}}</small></h5>
                            <a href="{{URL::route('rentals.show', $data, null)}}" class="button">EDIT</a>
                        </div>
                        <div class="details">
                            <div class="icon-box style11 full-width">
                                <div class="icon-wrapper">
                                    <i class="soap-icon-departure"></i>
                                </div>
                                <dl class="details">
                                    <dt class="skin-color">Start Date</dt>
                                    <dd>{{$data['start'] . ' ' . $data['start_at']}}</dd>
                                </dl>
                            </div>
                            <div class="icon-box style11 full-width">
                                <div class="icon-wrapper">
                                    <i class="soap-icon-departure"></i>
                                </div>
                                <dl class="details">
                                    <dt class="skin-color">End Date</dt>
                                    <dd>{{$data['end'] . ' ' . $data['end_at']}}</dd>
                                </dl>
                            </div>
                            <div class="icon-box style11 full-width">
                                <div class="icon-wrapper">
                                    <i class="soap-icon-departure"></i>
                                </div>
                                <dl class="details">
                                    <dt class="skin-color">Location</dt>
                                    <dd>{{$location}} Area</dd>
                                </dl>
                            </div>
                        </div>
                    </article>
                    
                    <h4>Other Details</h4>
                    <dl class="other-details">
                        <dt class="feature">Per day price:</dt><dd class="value">${{$rental->per_day}}</dd>
                        <dt class="total-price">Total Price</dt><dd class="total-price-value">${{$total}}</dd>
                    </dl>
                </div>
                
                @include('frontend.partials.help-box')
            </div>
        </div>
    </div>
</section>

@endsection

@section('js')
<!-- <script type="text/javascript" src="/js/app.js"></script> -->
<script type="text/javascript">
    tjq(document).ready(function() {
        tjq('#booking-form').submit(function(event) {
            var $form = tjq(this);
            // Disable the submit button to prevent repeated clicks
            $form.find('button').prop('disabled', true);
            // Prevent the form from submitting with the default action
        });
    });
</script>

@endsection