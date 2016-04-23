@extends('layouts.frontend')

@section('css')
<link rel="stylesheet" href="/plugins/select2/select2.min.css">
<link rel="stylesheet" href="/css/app.css">
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
                    <ul class="search-tabs clearfix">
                        <li class="active"><a href="#tickets-tab" data-toggle="tab">Tickets</a></li>
                        <li><a href="#rentals-tab" data-toggle="tab">Rentals</a></li>
                    </ul>
                    <div class="search-tab-content">
                        <div class="tab-pane fade active in" id="tickets-tab">
                            @include('frontend.tickets.partials.search-form')
                        </div>
                        <div class="tab-pane fade" id="rentals-tab">
                            @include('frontend.rentals.partials.search-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="featured image-box">
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
    </div>
</section>
@endsection

@section('js')
<script src="/plugins/select2/select2.full.min.js"></script>
<script>
  jQuery(document).ready(function($){
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
    $('#adults_depart').change(function(){
        $('#adults_return').attr('value', $('#adults_depart').attr('value'));
    });
    $('#kids_depart').change(function(){
        $('#kids_return').attr('value', $('#kids_depart').attr('value'));
    });
    function oneWaySetting() {
        $('#return-div').removeAttr('class');
        $('#return').attr('disabled', 'true');
        $value = $('#return').attr('value');
        $('#return').attr('value', '');
        $('#return').attr('placeholder', '');
        $('#return').css('background-color', '#eee');
        $('#return-div').css('height', '32px');
        $('#adults_return').attr('disabled', 'true');
        $('#kids_return').attr('disabled', 'true');
    }
    function roundTripSetting() {
        $('#return-div').attr('class', 'datepicker-wrap');
        $('#return').removeAttr('disabled');
        $('#return').attr('value', $value);
        $('#return').attr('placeholder', 'mm/dd/yy');
        $('#return').css('background-color', '#fff');
        $('#adults_return').removeAttr('disabled');
        $('#kids_return').removeAttr('disabled');
    }
});
</script>
@endsection