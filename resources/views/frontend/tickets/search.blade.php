@extends('layouts.frontend')

@section('css')

<link rel="stylesheet" href="/css/app.css">

@endsection

@section('title') Ticket Search @endsection @section('heading') Ticket Search @endsection

@section('breadcrumb')

<div class="page-title-container">
    <div class="container">
        <div class="page-title pull-left">
            <h2 class="entry-title">Bus Ticket Search Results</h2>
        </div>
        <ul class="breadcrumbs pull-right">
            <li><a href="#">HOME</a></li>
            <li class="active">Bus Ticket Search Results</li>
        </ul>
    </div>
</div>

@endsection

@section('content')
<section id="content">
    <div class="container">
        <div id="main">
            <div class="row">
                <div class="col-sm-4 col-md-3">
                    @include('frontend.tickets.partials.filters')
                </div>
                <div class="col-sm-8 col-md-9">
                    <div class="tab-container box">
                        @include('frontend.tickets.partials.date-nav')
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="tours-suggestions">
                                <div class="flight-list listing-style3 flight">
                                    @if(count($trips) == 0)
                                    <h1>Sorry, Nothing Matches your Search! </h1>
                                    @endif
                                    <!-- content cell start -->
                                    @foreach($trips as $trip)
                                    <article class="box">
                                        <div class="details col-xs-12 col-sm-12">
                                            <div class="details-wrapper">
                                                <div class="first-row">
                                                    <div>
                                                        <h4 class="box-title">{{ $trip->name }}<small>{{ $trip->companyName() }}</small></h4>
                                                        <a class="button btn-mini stop"></a>
                                                        <div class="amenities">
                                                            <i class="soap-icon-wifi circle"></i>
                                                            <i class="soap-icon-entertainment circle"></i>
                                                            <i class="soap-icon-fork circle"></i>
                                                            <i class="soap-icon-suitcase circle"></i>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <span class="price"><small>AVG/PERSON</small> ${{ $trip->fee }} </span>
                                                    </div>
                                                </div>
                                                <div class="second-row">
                                                    <div class="time">
                                                        <div class="take-off col-sm-4">
                                                            <div class="icon"><i class="soap-icon-plane-right yellow-color"></i></div>
                                                            <div>
                                                                <span class="skin-color">Departure Time</span><br />
                                                                {{ $trip->depart_at }}
                                                            </div>
                                                        </div>
                                                        <div class="landing col-sm-4">
                                                            <div class="icon"><i class="soap-icon-plane-right yellow-color"></i></div>
                                                            <div>
                                                                <span class="skin-color">Arrival Time</span><br />
                                                                {{ date('h:i a', strtotime($trip->arrive_at)) }}
                                                            </div>
                                                        </div>
                                                        <div class="total-time col-sm-4">
                                                            <div class="icon"><i class="soap-icon-clock yellow-color"></i></div>
                                                            <div>
                                                                <span class="skin-color">total time</span><br />
                                                                {{ $trip->totalTime() }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="action">
                                                        <a data-toggle="collapse" href="#{{'trip_' . $trip->id}}" class="button btn-small full-width collapsed">SELECT NOW</a>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($data['options'] == 'round-trip' && !array_has($data, 'trip_id'))
                                                <!-- round-trip and picked only the first-trip -->
                                                {!! Form::open(['url' => route('tickets.search'), 'method' => 'GET']) !!}
                                                {!! Form::number('trip_id[]', $trip->id, ['hidden']) !!}
                                                {!! Form::text('return', $data['return'], ['hidden']) !!}
                                            @elseif($data['options'] == 'round-trip' && array_has($data, 'trip_id'))
                                                <!-- round-trip and both trip picked -->
                                                {!! Form::open(['url' => route('tickets.picked'), 'method' => 'GET']) !!}
                                                {!! Form::number('trip_id[]', $data['trip_id'][0], ['hidden']) !!}
                                                {!! Form::number('trip_id[]', $trip->id, ['hidden']) !!}
                                                {!! Form::number('trip_DS[]', $data['trip_DS'][0], ['hidden']) !!}
                                                {!! Form::number('trip_AS[]', $data['trip_AS'][0], ['hidden']) !!}
                                                {!! Form::text('return', $data['return'], ['hidden']) !!}
                                            @else <!-- one-way trip -->
                                                {!! Form::open(['url' => route('tickets.picked'), 'method' => 'GET']) !!}
                                                {!! Form::number('trip_id[]', $trip->id, ['hidden']) !!}
                                            @endif

                                            @include('frontend.tickets.partials.search-form-hidden', $data)
                                            <div id="{{'trip_' . $trip->id}}" class="collapse hidden-row">
                                                <div class="row time">
                                                    <div class="col-xs-12 col-lg-6 col-md-6 col-sm-6 stops">
                                                        <div class="icon"><i class="soap-icon-clock yellow-color"></i></div>
                                                        <div>
                                                            <span class="skin-color">Departure Stations</span>
                                                        </div>
                                                        <div class="form-group stops">
                                                            @foreach($trip->stations as $station)
                                                            @if($station->pivot->departure == 1)
                                                            <div class="radio">
                                                                <label>
                                                                <input 
                                                                type="radio" 
                                                                name="trip_DS[]" 
                                                                value="{{$station->id}}" 
                                                                checked="">
                                                                <a class="yellow popup-map" href="#" data-box="{{$station->getLocationPoint()}}">
                                                                {{date('h:i a', strtotime($station->pivot->time))}} &nbsp; {{$station->name}} </a>
                                                                </label>
                                                            </div>
                                                            @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-lg-6 col-md-6 col-sm-6 stops">
                                                        <div class="icon"><i class="soap-icon-clock yellow-color"></i></div>
                                                        <div>
                                                            <span class="skin-color">Arrival Stations</span>
                                                        </div>
                                                        <div class="form-group stops">
                                                            @foreach($trip->stations as $station)
                                                            @if($station->pivot->departure == 0)
                                                            <div class="radio">
                                                                <label>
                                                                <input 
                                                                type="radio" 
                                                                name="trip_AS[]"  
                                                                value="{{$station->id}}" 
                                                                checked="">
                                                                <a class="yellow popup-map" href="#" data-box="{{$station->getLocationPoint()}}">
                                                                {{date('h:i a', strtotime($station->pivot->time))}} &nbsp; {{$station->name}}</a>
                                                                </label>
                                                            </div>
                                                            @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="action">
                                                    <button id="selected" submit="submit" class="pull-right">BOOK NOW</button>
                                                </div>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </article>
                                    @endforeach
                                    <!-- content cell end -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <a class="button uppercase full-width btn-large">load more listings</a> -->
                    {!! $trips->appends($data)->links() !!}
                    
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('js')
 <!-- Google Map Api -->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyBUdG-LWODBF8OiWvhRy8t0b2KGF69jjpE"></script>
<!-- <script type="text/javascript" src="/js/gmap3.min.js"></script> -->
<script type="text/javascript" src="/js/gmap3.min.js"></script>
<!-- <script type="text/javascript" src="/js/app.js"></script> -->
<script type="text/javascript">
    tjq(document).ready(function() {

        tjq("#price-range").slider({
            range: true,
            min: 0,
            max: 1000,
            values: priceDefault(),
            slide: function( event, ui ) {
                tjq(".min-price-label").html( "$" + ui.values[ 0 ]);
                tjq(".max-price-label").html( "$" + ui.values[ 1 ]);
            },
        });
        tjq(".min-price-label").html( "$" + tjq("#price-range").slider( "values", 0 ));
        tjq(".max-price-label").html( "$" + tjq("#price-range").slider( "values", 1 ));

        function priceDefault() {
            if (getUrlParameter('min') !== null) {
                return [getUrlParameter('min'), getUrlParameter('max')];
            } else {
                return [0, 1000];
            }
        }

        function convertTimeToHHMM(t) {
            var minutes = t % 60;
            var hour = (t - minutes) / 60;
            var timeStr = (hour + "").lpad("0", 2) + ":" + (minutes + "").lpad("0", 2);
            var date = new Date("2014/01/01 " + timeStr + ":00");
            var hhmm = date.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});
            return hhmm;
        }

        tjq("#flight-times").slider({
            range: true,
            min: 0,
            max: 1440,
            step: 5,
            values: dateDefault(),
            slide: function( event, ui ) {
                
                tjq(".start-time-label").html( convertTimeToHHMM(ui.values[0]) );
                tjq(".end-time-label").html( convertTimeToHHMM(ui.values[1]) );
            }
        });
        tjq(".start-time-label").html( convertTimeToHHMM(tjq("#flight-times").slider( "values", 0 )) );
        tjq(".end-time-label").html( convertTimeToHHMM(tjq("#flight-times").slider( "values", 1 )) );

        function dateDefault() {
            if (getUrlParameter('filter') !== null) {
                startTime = getUrlParameter('startTime');
                endTime = getUrlParameter('endTime');
                return [parsehhmmsst(startTime), parsehhmmsst(endTime)];
            } else {
                return [ 360, 1200 ];
            }
        }

        function parsehhmmsst(arg) {
            var result = 0, arr = arg.split(':');
            if (arr[0] < 12) {
                result = arr[0] * 60; // hours
            }
            result += parseInt(arr[1]); // minutes
            if (arg.indexOf('P') > -1) {  // 8:00 PM > 8:00 AM
                result += 720;
            }
            return result;
        }

        tjq('.company_options').click(function(){
            tjq('#all').removeClass('active');
        });

        tjq('#all').click(function(){
            tjq('.company_options').removeClass('active');
        });

        tjq("#filter").click(function(){
            min = tjq(".min-price-label").text().substring(1);
            max = tjq(".max-price-label").text().substring(1);
            startTime = tjq(".start-time-label").text();
            endTime = tjq(".end-time-label").text();
            url = updateQueryStringParameter(window.location.href, 'filter', true);
            url = updateQueryStringParameter(url, 'min', min);
            url = updateQueryStringParameter(url, 'max', max);
            url = updateQueryStringParameter(url, 'startTime', startTime);
            url = updateQueryStringParameter(url, 'endTime', endTime);
            url = removeParam('companyName[]', url);
            if (tjq('#all').hasClass('active'))
            {
                url = updateQueryStringParameter(url, 'companyName[]', 'all');
            } else {
                for (var i = tjq("#count").text().substring(0,1); i >= 0; i--) 
                {
                    if (tjq("#company_" + i).hasClass('active'))
                    {
                        company = tjq("#company_" + i).text().split('$')[0];
                        url = updateQueryStringParameter(url, 'companyName[]', company);
                    }
                }
            }
            window.location = url;
        });

        
        tjq('.filter').removeClass(function(){
            if (getUrlParameter('filter') !== null)
            {
                tjq('.panel-collapse.collapse').addClass('in');
                return 'collapsed';
            }
        });

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

        function getUrlParameter(name){
            var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
            if (results === null){
               return null;
            }
            else{
               return decodeURIComponent(results[1]) || 0;
            }
        }

        function removeParam(key, sourceURL) {
            var rtn = sourceURL.split("?")[0],
                param,
                params_arr = [],
                queryString = (sourceURL.indexOf("?") !== -1) ? sourceURL.split("?")[1] : "";
            if (queryString !== "") {
                params_arr = queryString.split("&");
                for (var i = params_arr.length - 1; i >= 0; i -= 1) {
                    param = params_arr[i].split("=")[0];
                    if (param === key) {
                        params_arr.splice(i, 1);
                    }
                }
                rtn = rtn + "?" + params_arr.join("&");
            }
            return rtn;
        }
    });
</script>

@endsection