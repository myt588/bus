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
                        <li class="active"><a href="#tickets-tab" data-toggle="tab"><i class="fa fa-ticket"></i><span>TICKETS</span></a></li>
                        <li><a href="#rentals-tab" data-toggle="tab"><i class="soap-icon-car"></i><span>RENTALS</span></a></li>
                        <li><a href="#tours-tab" data-toggle="tab"><i class="soap-icon-cruise"></i><span>TOURS</span></a></li>
                    </ul>
                    <div class="visible-mobile">
                        <ul id="mobile-search-tabs" class="search-tabs clearfix">
                            <li class="active"><a href="#tickets-tab">TICKETS</a></li>
                            <li><a href="#rentals-tab">RENTALS</a></li>
                            <li><a href="#tours-tab">TOURS</a></li>
                        </ul>
                    </div>
                    
                    <div class="search-tab-content">
                        <div class="tab-pane fade active in" id="tickets-tab">
                            @include('frontend.tickets.partials.search-form')
                        </div>
                        <div class="tab-pane fade" id="rentals-tab">
                            <form action="car-list-view.html" method="post">
                                <h4 class="title">Where do you want to go?</h4>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" class="input-text full-width" placeholder="Pick Up (city, distirct or specific airpot)" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="input-text full-width" placeholder="Drop Off (city, distirct or specific airpot)" />
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="datepicker-wrap">
                                                        <input type="text" name="date_from" class="input-text full-width" placeholder="Pick-Up Date / Time" />
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="selector">
                                                        <select class="full-width">
                                                            <option value="1">anytime</option>
                                                            <option value="2">morning</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="datepicker-wrap">
                                                        <input type="text" name="date_to" class="input-text full-width" placeholder="Drop-Off Date / Time" />
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="selector">
                                                        <select class="full-width">
                                                            <option value="1">anytime</option>
                                                            <option value="2">morning</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <div class="col-xs-3">
                                                <div class="selector">
                                                    <select class="full-width">
                                                        <option value="">Adults</option>
                                                        <option value="1">01</option>
                                                        <option value="2">02</option>
                                                        <option value="3">03</option>
                                                        <option value="4">04</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-3">
                                                <div class="selector">
                                                    <select class="full-width">
                                                        <option value="">Kids</option>
                                                        <option value="1">01</option>
                                                        <option value="2">02</option>
                                                        <option value="3">03</option>
                                                        <option value="4">04</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" class="input-text full-width" placeholder="Promo Code" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-xs-6">
                                                <div class="selector">
                                                    <select class="full-width">
                                                        <option value="">select a car type</option>
                                                        <option value="economy">Economy</option>
                                                        <option value="compact">Compact</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <button class="full-width">SERACH NOW</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="tours-tab">
                            <form action="cruise-list-view.html" method="post">
                                <h4 class="title">Where do you want to go?</h4>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" class="input-text full-width" placeholder="enter a destination or hotel name" />
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <div class="col-xs-6">
                                                <div class="datepicker-wrap">
                                                    <input type="text" class="input-text full-width" placeholder="Departure Date" />
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="selector">
                                                    <select class="full-width">
                                                        <option value="">select cruise length</option>
                                                        <option value="1">1-2 Nights</option>
                                                        <option value="2">3-4 Nights</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <div class="col-xs-6">
                                                <div class="selector">
                                                    <select class="full-width">
                                                        <option value="">select cruise line</option>
                                                        <option>Azamara Club Cruises</option>
                                                        <option>Carnival Cruise Lines</option>
                                                        <option>Celebrity Cruises</option>
                                                        <option>Costa Cruise Lines</option>
                                                        <option>Cruise &amp; Maritime Voyages</option>
                                                        <option>Crystal Cruises</option>
                                                        <option>Cunard Line Ltd.</option>
                                                        <option>Disney Cruise Line</option>
                                                        <option>Holland America Line</option>
                                                        <option>Hurtigruten Cruise Line</option>
                                                        <option>MSC Cruises</option>
                                                        <option>Norwegian Cruise Line</option>
                                                        <option>Oceania Cruises</option>
                                                        <option>Orion Expedition Cruises</option>
                                                        <option>P&amp;O Cruises</option>
                                                        <option>Paul Gauguin Cruises</option>
                                                        <option>Peter Deilmann Cruises</option>
                                                        <option>Princess Cruises</option>
                                                        <option>Regent Seven Seas Cruises</option>
                                                        <option>Royal Caribbean International</option>
                                                        <option>Seabourn Cruise Line</option>
                                                        <option>Silversea Cruises</option>
                                                        <option>Star Clippers</option>
                                                        <option>Swan Hellenic Cruises</option>
                                                        <option>Thomson Cruises</option>
                                                        <option>Viking River Cruises</option>
                                                        <option>Windstar Cruises</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <button class="full-width">SEARCH NOW</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
    $(".leaving_from, .going_to").select2({
        width: '100%',
        multiple: true,
        maximumSelectionLength: 1,
        placeholder: "city, distirct or specific airpot" 
    });
    $value = '';
    if (document.getElementById('one-way').checked) {
        $('#return-div').removeAttr('class');
        $('#return').attr('disabled', 'true');
        $value = $('#return').attr('value');
        $('#return').attr('value', '');
        $('#return').attr('placeholder', '');
        $('#return').css('background-color', '#eee');
        $('#return-div').css('height', '32px');
    }
    $('#one-way').change(function() {
        $('#return-div').removeAttr('class');
        $('#return').attr('disabled', 'true');
        $value = $('#return').attr('value');
        $('#return').attr('value', '');
        $('#return').attr('placeholder', '');
        $('#return').css('background-color', '#eee');
        $('#return-div').css('height', '32px');
    });
    $('#round-trip').change(function(){
        $('#return-div').attr('class', 'datepicker-wrap');
        $('#return').removeAttr('disabled');
        $('#return').attr('value', $value);
        $('#return').attr('placeholder', 'mm/dd/yy');
        $('#return').css('background-color', '#fff');
    });
});
</script>
@endsection