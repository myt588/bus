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
                                                        <span class="price"><small>AVG/PERSON</small> ${{ $trip->price() }} </span>
                                                    </div>
                                                </div>
                                                <div class="second-row">
                                                    <div class="time">
                                                        <div class="take-off col-sm-4">
                                                            <div class="icon"><i class="soap-icon-plane-right yellow-color"></i></div>
                                                            <div>
                                                                <span class="skin-color">Departure Time</span><br />
                                                                {{ date('h:i a', strtotime($trip->depart_at)) }}
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
                                                        <a data-toggle="collapse" href="#{{$trip->id}}" class="button btn-small full-width collapsed">SELECT NOW</a>
                                                    </div>
                                                </div>
                                            </div>

                                            @if($data['options'] == 'round-trip')
                                                @if(array_key_exists('trip_one_id', $data)) 
                                                {!! Form::open(['url' => route('tickets.picked'), 'method' => 'GET']) !!}
                                                {!! Form::number('trip_one_id', $data['trip_one_id'], ['hidden']) !!}
                                                {!! Form::number('trip_two_id', $trip->id, ['hidden']) !!}
                                                {!! Form::number('trip_one_DS', $data['trip_one_DS'], ['hidden']) !!}
                                                {!! Form::number('trip_one_AS', $data['trip_one_AS'], ['hidden']) !!}
                                                @else
                                                {!! Form::open(['url' => route('tickets.search'), 'method' => 'GET']) !!}
                                                {!! Form::number('trip_one_id', $trip->id, ['hidden']) !!}
                                                @endif
                                                {!! Form::text('return', $data['return'], ['hidden']) !!}
                                                {!! Form::text('adults_return', $data['adults_return'], ['hidden']) !!}
                                                {!! Form::text('kids_return', $data['kids_return'], ['hidden']) !!}
                                            @else 
                                            {!! Form::open(['url' => '/tickets/picked', 'method' => 'GET']) !!}
                                            {!! Form::number('trip_one_id', $trip->id, ['hidden']) !!}
                                            @endif
                                            @include('frontend.tickets.partials.search-form-hidden', $data)
                                            <div id="{{$trip->id}}" class="collapse hidden-row">
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
                                                                name="{{array_key_exists('trip_one_id', $data) ? 'trip_two_DS' : 'trip_one_DS'}}" 
                                                                id="{{$station->id}}" 
                                                                value="{{$station->id}}" 
                                                                checked="">
                                                                {{date('h:i a', strtotime($station->pivot->time))}} &nbsp; {{$station->name}}
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
                                                                name="{{array_key_exists('trip_one_id', $data) ? 'trip_two_AS' : 'trip_one_AS'}}"  
                                                                id="{{$station->id}}" 
                                                                value="{{$station->id}}" 
                                                                checked="">
                                                                {{date('h:i a', strtotime($station->pivot->time))}} &nbsp; {{$station->name}}
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
<script type='text/javascript' src="http://maps.google.com/maps/api/js?sensor=false&amp;language=en"></script>
<script type="text/javascript" src="/js/gmap3.min.js"></script>
<!-- <script type="text/javascript" src="/js/app.js"></script> -->
<script type="text/javascript">
    tjq(document).ready(function() {
        tjq("#price-range").slider({
            range: true,
            min: 0,
            max: 1000,
            values: [ 100, 800 ],
            slide: function( event, ui ) {
                tjq(".min-price-label").html( "$" + ui.values[ 0 ]);
                tjq(".max-price-label").html( "$" + ui.values[ 1 ]);
            }
        });
        tjq(".min-price-label").html( "$" + tjq("#price-range").slider( "values", 0 ));
        tjq(".max-price-label").html( "$" + tjq("#price-range").slider( "values", 1 ));

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
            values: [ 360, 1200 ],
            slide: function( event, ui ) {
                
                tjq(".start-time-label").html( convertTimeToHHMM(ui.values[0]) );
                tjq(".end-time-label").html( convertTimeToHHMM(ui.values[1]) );
            }
        });
        tjq(".start-time-label").html( convertTimeToHHMM(tjq("#flight-times").slider( "values", 0 )) );
        tjq(".end-time-label").html( convertTimeToHHMM(tjq("#flight-times").slider( "values", 1 )) );

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