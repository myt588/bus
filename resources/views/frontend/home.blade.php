@extends('layouts.frontend')

@section('css')
<link rel="stylesheet" href="/plugins/select2/select2.min.css">
<link rel="stylesheet" href="/css/app.css">
  <!-- Bootstrap time Picker -->
<link rel="stylesheet" href="/plugins/timepicker/bootstrap-timepicker.min.css">
<style>
section#content {  min-height: 1000px; padding: 0; position: relative; overflow: hidden; }
#main { padding-top: 100px; }
.page-title, .page-description { color: #fff; }
.page-title { font-size: 4.1667em; font-weight: bold; }
.page-description { font-size: 2.5em; margin-bottom: 50px; }
.featured { position: absolute; right: 50px; bottom: 50px; z-index: 9; margin-bottom: 0;  text-align: right; }
.featured figure a { border: 2px solid #fff; }
.featured .details { margin-right: 10px; }
.featured .details > * { color: #fff; line-height: 1.25em; margin: 0; font-weight: bold; text-shadow: 2px -2px rgba(0, 0, 0, 0.2); }
</style>
@endsection 

@section('title') TriponBus @endsection

@section('content')
<section id="content" class="slideshow-bg">
    <div id="slideshow">
        <div class="flexslider">
            <ul class="slides">
                <li>
                    <div class="slidebg" style="background-image: url('/images/homepage7.jpg');"></div>
                </li>
                <li>
                    <div class="slidebg" style="background-image: url('/images/homepage6.jpg');"></div>
                </li>
                <li>
                    <div class="slidebg" style="background-image: url('/images/casablanca-by-night.png');"></div>
                </li>
            </ul>
        </div>
    </div>
    <div class="container">
        <div id="main">
            <h1 class="page-title">Bus with us in Comfort!</h1>
            <h2 class="page-description col-md-6 no-float no-padding">We're bringing you a modern, comfortable and connected bus experience.</h2>
            <div class="search-box-wrapper style2">
                <div class="search-box">
                    <ul class="search-tabs clearfix" id="myTab">
                        <li class="{{session()->has('booking') ? '' : 'active'}}"><a href="#tickets-tab" data-toggle="tab">Tickets</a></li>
                        <li><a href="#rentals-tab" data-toggle="tab">Rentals</a></li>
                        <li class="{{session()->has('booking') ? 'active' : ''}}"><a href="#lookup-tab" data-toggle="tab">Find Booking</a></li>
                    </ul>
                    <div class="search-tab-content">
                        <div class="tab-pane fade {{session()->has('booking') ? '' : 'active in'}}" id="tickets-tab">
                            @include('frontend.tickets.partials.search-form')
                        </div>
                        <div class="tab-pane fade" id="rentals-tab">
                            @include('frontend.rentals.partials.search-form')
                        </div>
                        <div class="tab-pane fade {{session()->has('booking') ? 'active in' : ''}}" id="lookup-tab">
                            {!! Form::open(['route' => 'search.booking']) !!}
                            <div class="row">
                                <div class="col-xs-offset-2 col-xs-6">
                                    <label>Booking Number</label>
                                    <input type="text" name="booking_no" class="input-text full-width" placeholder="enter your booking number">
                                </div>
                                <div class="col-xs-2">
                                    <label>&nbsp;</label>
                                    <button class="full-width icon-check">Find Booking</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                            @if (Session::has('danger'))
                                <br></br>
                                <div class="alert alert-notice">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                    {{ Session::pull('danger') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="featured image-box">
        <div class="details pull-left">
            <h3>Tropical Beach,<br/>Hotel and Resorts</h3>
            <h5>THAILAND</h5>
        </div>
        <figure class="pull-left">
            <a class="badge-container" href="#">
                <span class="badge-content right-side">From $200</span>
                <img width="64" height="64" alt="" src="http://placehold.it/64x64" class="">
            </a>
        </figure>
    </div> -->
</section>
@endsection

@section('js')
<script src="/plugins/select2/select2.full.min.js"></script>
<!-- bootstrap time picker -->
<script src="/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script>
  jQuery(document).ready(function($){
     //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
    $(".location").select2({
        width: '100%',
        multiple: true,
        maximumSelectionLength: 1,
        placeholder: "city, distirct or specific airpot" 
    });
    $value = '';
    if (document.getElementById('one-way').checked) {
        oneWaySetting();
    }
    $('#one-way').change(function() {
        oneWaySetting();
    });
    $('#round-trip').change(function(){
        roundTripSetting();
    });
    function oneWaySetting() {
        $('#return-div').removeAttr('class');
        $('#return').attr('disabled', 'true');
        $value = $('#return').attr('value');
        $('#return').attr('value', '');
        $('#return').attr('placeholder', '');
        $('#return').css('background-color', '#eee');
        $('#return-div').css('height', '32px');
    }
    function roundTripSetting() {
        $('#return-div').attr('class', 'datepicker-wrap');
        $('#return').removeAttr('disabled');
        $('#return').attr('value', $value);
        $('#return').attr('placeholder', 'mm/dd/yy');
        $('#return').css('background-color', '#fff');
    }

    $('#myTab a').click(function(e) {
      e.preventDefault();
      $(this).tab('show');
    });

    // store the currently selected tab in the hash value
    $('a[data-toggle="tab"]').on("shown.bs.tab", function(e) {
        var id = $(e.target).attr("href").substr(1);
        window.location.hash = "_" + id;
    });

    // on load of the page: switch to the currently selected tab
    var hash = window.location.hash;

    $('#myTab a[href="' + '#' + hash.substring(2) + '"]').tab('show');
    });
</script>
@endsection