@extends('layouts.frontend')

@section('css')

<link rel="stylesheet" href="/css/app.css">

@endsection

@section('title') Details @endsection @section('heading') Details @endsection

@section('breadcrumb')

<div class="page-title-container">
    <div class="container">
        <div class="page-title pull-left">
            <h2 class="entry-title">Trip Detailed</h2>
        </div>
        <ul class="breadcrumbs pull-right">
            <li><a href="#">HOME</a></li>
            <li class="active">Trip Detailed</li>
        </ul>
    </div>
</div>

@endsection

@section('content')
<section id="content">
    <div class="container flight-detail-page">
        <div class="row">
            <div id="main" class="col-md-9">
                <div id="flight-features" class="tab-container">
                    <ul class="tabs">
                        <li class="active"><a href="#flight-details" data-toggle="tab">Trip Details</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="flight-details">
                            <div class="intro table-wrapper full-width hidden-table-sm box">
                                <div class="col-md-4 table-cell travelo-box">
                                    <dl class="term-description">
                                        <dt>Operator:</dt><dd>{{ $trip_one->companyName() }}</dd>
                                        <dt>Bus Number:</dt><dd>{{ $trip_one->buses->first()->bus_number }}</dd>
                                        <dt>Terms & Conditions:</dt><dd>view</dd>
                                        <dt>Adult:</dt><dd>{!! Form::select('adults', ['0', '1', '2', '3', '4'], $data['adults'], ['id' => 'going_adults']) !!}</dd>
                                        <dt>Children:</dt><dd>{!! Form::select('kids', ['0', '1', '2', '3', '4'], $data['kids'], ['id' => 'going_kids']) !!}</dd>
                                        <dt>Fare:</dt><dd>${{ $trip_one->farePrice() }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-8 table-cell">
                                    <div class="detailed-features booking-details">
                                        <div class="travelo-box">
                                            <h4 class="box-title">{{ $trip_one->name }}
                                            <small>{{ $trip_one->companyName() }}</small></h4>
                                        </div>
                                        <div class="table-wrapper flights">
                                            <div class="table-row">
                                                <div class="table-cell timing-detail">
                                                    <div class="timing">
                                                        @include('frontend.tickets.partials.departure-station', [$data, $trip_one_DS, $trip_one_AS, $trip_one])
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(array_key_exists('trip_two_id', $data))
                            <div class="intro table-wrapper full-width hidden-table-sm box">
                                <div class="col-md-4 table-cell travelo-box">
                                    <dl class="term-description">
                                        <dt>Operator:</dt><dd>{{ $trip_two->companyName() }}</dd>
                                        <dt>Bus Number:</dt><dd>{{ $trip_two->buses->first()->bus_number }}</dd>
                                        <dt>Terms & Conditions:</dt><dd>view</dd>
                                        <dt>Adult:</dt><dd>{!! Form::select('adults', ['0', '1', '2', '3', '4'], $data['adults']) !!}</dd>
                                        <dt>Children:</dt><dd>{!! Form::select('kids', ['0', '1', '2', '3', '4'], $data['kids']) !!}</dd>
                                        <dt>Fare:</dt><dd>${{ $trip_two->farePrice() }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-8 table-cell">
                                    <div class="detailed-features booking-details">
                                        <div class="travelo-box">
                                            <h4 class="box-title">{{ $trip_two->name }}<small>{{ $trip_two->companyName() }}</small></h4>
                                        </div>
                                        <div class="table-wrapper flights">
                                            <div class="table-row">
                                                <div class="table-cell timing-detail">
                                                    <div class="timing">
                                                        @include('frontend.tickets.partials.arrival-station', [$data, $trip_two_DS, $trip_two_AS, $trip_two])
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="sidebar col-md-3">
                <article class="detailed-logo">
                    <div class="details">
                        <h2 class="box-title">{{ $trip_one->name }}<small>{{ $trip_one->companyName() }}</small></h2>
                        <span class="price clearfix">
                            <small class="pull-left">avg/person</small>
                            <span class="pull-right">${{ array_key_exists('trip_two_id', $data) ? $trip_one->farePrice() + $trip_two->farePrice() : $trip_one->farePrice() }}</span>
                        </span>
                        
                        <p class="description">Nunc cursus libero purus ac congue ar lorem cursus ut sed vitae pulvinar massa idend porta nequetiam elerisque mi id, consectetur adipi deese cing elit maus fringilla bibe endum.</p>
                        @if(Auth::check())
                        <a id="bookButton" href="{{route('tickets.checkout', $data, null)}}" class="button green full-width uppercase btn-medium">book now</a>
                        @else
                        <a id="bookButton" href="#travelo-login" class="soap-popupbox button green full-width uppercase btn-medium">book now</a>
                        @endif
                    </div>
                </article>
                <div class="travelo-box contact-box">
                    <h4>Need Travelo Help?</h4>
                    <p>We would be more than happy to help you. Our team advisor are 24/7 at your service to help you.</p>
                    <address class="contact-details">
                        <span class="contact-phone"><i class="soap-icon-phone"></i> 1-800-123-HELLO</span>
                        <br>
                        <a class="contact-email" href="#">help@travelo.com</a>
                    </address>
                </div>
            </div>
            <div id="travelo-login" class="travelo-login-box travelo-box">
                <div class="row">
                    <div class="col-md-5">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3 class="panel-title">Already a member?</h2></div>
                            <div class="panel-body">
                                @include('auth.partials.login-form')
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3 class="panel-title">Don't have one yet?</h3></div>
                            <div class="panel-body">
                                <div class="checkout-option-box">
                                    <strong>Create Account and Check Out</strong><br>
                                    <span>To manage your tickets &amp; earn loyalty points. <a target="_new" href="">learn more?</a></span>
                                     <div style="padding:10px 0 10px 0;">
                                        <button class="full-width btn-medium">Create Account and Check out</button>
                                     </div>
                                     <strong>Check Out as a Guest</strong>
                                     <div style="padding:10px 0 11px 0;">
                                        <button class="full-width btn-medium">Check Out as a Guest</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>

@endsection

@section('js')
<script type="text/javascript" src="/js/calendar.js"></script>
<script type="text/javascript">
    tjq(document).ready(function() {
        // calendar panel
        var cal = new Calendar();
        var unavailable_days = [17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31];
        var price_arr = {3: '$170', 4: '$170', 5: '$170', 6: '$170', 7: '$170', 8: '$170', 9: '$170', 10: '$170', 11: '$170', 12: '$170', 13: '$170', 14: '$170', 15: '$170', 16: '$170', 17: '$170'};

        var current_date = new Date();
        var current_year_month = (1900 + current_date.getYear()) + "-" + (current_date.getMonth() + 1);
        tjq("#select-month").find("[value='" + current_year_month + "']").prop("selected", "selected");
        cal.generateHTML(current_date.getMonth(), (1900 + current_date.getYear()), unavailable_days, price_arr);
        tjq(".calendar").html(cal.getHTML());
        
        tjq("#select-month").change(function() {
            var selected_year_month = tjq("#select-month option:selected").val();
            var year = parseInt(selected_year_month.split("-")[0], 10);
            var month = parseInt(selected_year_month.split("-")[1], 10);
            cal.generateHTML(month - 1, year, unavailable_days, price_arr);
            tjq(".calendar").html(cal.getHTML());
        });
        
        
        tjq(".goto-writereview-pane").click(function(e) {
            e.preventDefault();
            tjq('#hotel-features .tabs a[href="#hotel-write-review"]').tab('show');
        });
        
        // editable rating
        tjq(".editable-rating.five-stars-container").each(function() {
            var oringnal_value = tjq(this).data("original-stars");
            if (typeof oringnal_value == "undefined") {
                oringnal_value = 0;
            } else {
                oringnal_value = 10 * parseInt(oringnal_value);
            }
            tjq(this).slider({
                range: "min",
                value: oringnal_value,
                min: 0,
                max: 50,
                slide: function( event, ui ) {
                    
                }
            });
        });

        tjq('#going_adults').change(function() {
            window.location = window.location.href + '&adults=$this.value';
        });

        // tjq('#bookButton').attr('href', window.location.href);
    });
</script>
@endsection