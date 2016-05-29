@extends('layouts.frontend')

@section('css')

<link rel="stylesheet" href="/css/app.css">

@endsection

@section('title') Details @endsection @section('heading') Details @endsection

@section('breadcrumb')

<div class="page-title-container">
    <div class="container">
        <div class="page-title pull-left">
            <h2 class="entry-title">Trip Details</h2>
        </div>
        <ul class="breadcrumbs pull-right">
            <li><a href="#">HOME</a></li>
            <li class="active">Trip Details</li>
        </ul>
    </div>
</div>

@endsection

@section('content')
<section id="content">
    <div class="container flight-detail-page">
        <div class="row">
            {!! Form::open(['url' => route('tickets.checkout', $data), 'method' => 'GET']) !!}
            <div id="main" class="col-md-9">
                <div id="flight-features" class="tab-container">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="car-details">
                            @foreach($info as $i => $item)
                            @include('frontend.tickets.partials.trip-detail-box', [
                                'trip'      => $item['trip'], 
                                'trip_DS'   => $item['ds'], 
                                'trip_AS'   => $item['as'], 
                                'date'      => $data['depart'], 
                                'adults'    => $data['adults'],
                                'kids'      => $data['kids'],
                                'adults_id' => 'adults_'.$i,
                                'kids_id'   => 'kids_'.$i,
                                'checkout'  => false    
                            ])
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="sidebar col-md-3">
                <article class="detailed-logo">
                    <div class="details">
                        <h2 class="box-title">{{ $info[0]['trip']->name }}<small>{{ $info[0]['trip']->companyName() }}</small></h2>
                        <span class="price clearfix">
                            <small class="pull-left">Total Fare</small>
                            <span id="total" class="pull-right"></span>
                        </span>
                        <p class="description">Nunc cursus libero purus ac congue ar lorem cursus ut sed vitae pulvinar massa idend porta nequetiam elerisque mi id, consectetur adipi deese cing elit maus fringilla bibe endum.</p>
                        @if(Auth::check())
                        <button id="bookButton" submit="submit" class="green full-width uppercase btn-medium">BOOK NOW</button>
                        @else
                        <a id="bookButton" href="#travelo-signup" class="soap-popupbox button green full-width uppercase btn-medium">book now</a>
                        @endif
                    </div>
                </article>
                @include('frontend.partials.help-box')
            </div>
            {!! Form::close() !!}
            <div id="travelo-signup" class="travelo-login-box travelo-box">
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
                                        <a href="{{ url('/register') }}" class="button green full-width btn-medium">Create Account and Check out</a>
                                     </div>
                                     <strong>Check Out as a Guest</strong>
                                     <div style="padding:10px 0 11px 0;">
                                        <a href="{{route('tickets.checkout', $data, null)}}" class="button green full-width btn-medium">Check Out as a Guest</a>
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
        updateTotal();
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

        function getFloat($id) {
            return parseFloat(tjq($id).text().split(" ")[0].substr(1));
        }

        function updateTotal() {
            if (tjq('#fare_adults_1').length){
                total = getFloat('#fare_adults_0') + getFloat('#fare_adults_1');
            } else {
                total = getFloat('#fare_adults_0');
            }
            tjq('#total').text('$' + total);
        }

        tjq('#adults_0').change(function() {
            price = getFloat('#price_adults_0');
            fare = (parseInt(tjq('#adults_0').val()) + parseInt(tjq('#kids_0').val())) * price;
            tjq('#fare_adults_0').text('$' + fare);
            updateTotal();
        });

        tjq('#kids_0').change(function() {
            price = getFloat('#price_adults_0');
            fare = (parseInt(tjq('#adults_0').val()) + parseInt(tjq('#kids_0').val())) * price;
            tjq('#fare_adults_0').text('$' + fare);
            updateTotal();
        });

        tjq('#adults_1').change(function() {
            price = getFloat('#price_adults_1');
            fare = (parseInt(tjq('#adults_1').val()) + parseInt(tjq('#kids_1').val())) * price;
            tjq('#fare_adults_1').text('$' + fare);
            updateTotal();
        });

        tjq('#kids_1').change(function() {
            price = getFloat('#price_adults_1');
            fare = (parseInt(tjq('#adults_1').val()) + parseInt(tjq('#kids_1').val())) * price;
            tjq('#fare_adults_1').text('$' + fare);
            updateTotal();
        });

        function updateSelect($key, $this) {
            if (window.location.search.indexOf('&' + $key + '=') > -1) {
                window.location = updateQueryStringParameter(window.location.href, $key, $this.options[$this.selectedIndex].value);
            } else {
                window.location = window.location.href + '&' + $key + '=' + $this.options[$this.selectedIndex].value;
            }
        }

        function updateQueryStringParameter(uri, key, value) {
           var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
           var separator = uri.indexOf('?') !== -1 ? "&" : "?";
           if (uri.match(re)) {
             return uri.replace(re, '$1' + key + "=" + value + '$2');
           }
           else {
             return uri + separator + key + "=" + value;
           }
        }

    });
</script>
@endsection