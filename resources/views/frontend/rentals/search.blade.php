@extends('layouts.frontend')

@section('css')

<link rel="stylesheet" href="/css/app.css">

@endsection

@section('title') Rental Search @endsection @section('heading') Rental Search @endsection

@section('breadcrumb')

<div class="page-title-container">
    <div class="container">
        <div class="page-title pull-left">
            <h2 class="entry-title">Rental Search Results</h2>
        </div>
        <ul class="breadcrumbs pull-right">
            <li><a href="{{url('/')}}">HOME</a></li>
            <li class="active">Rental Search Results</li>
        </ul>
    </div>
</div>

@endsection

@section('content')
<section id="content">
    <div class="container">
        <div id="main">
            <div class="row">
                <!-- filters start -->
                <div class="col-sm-4 col-md-3">
                    <div class="toggle-container filters-container">
                        <div class="panel style1 arrow-right">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#price-filter" class="collapsed">Price</a>
                            </h4>
                            <div id="price-filter" class="panel-collapse collapse">
                                <div class="panel-content">
                                    <div id="price-range"></div>
                                    <br />
                                    <span class="min-price-label pull-left"></span>
                                    <span class="max-price-label pull-right"></span>
                                    <div class="clearer"></div>
                                </div><!-- end content -->
                            </div>
                        </div>
                        
                        <div class="panel style1 arrow-right">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#cartype-filter" class="collapsed">Bus Type</a>
                            </h4>
                            <div id="cartype-filter" class="panel-collapse collapse filters-container">
                                <div class="panel-content">
                                    <ul class="check-square filters-option">
                                        <li><a href="#">Full Size<small>(10)</small></a></li>
                                        <li><a href="#">Compact<small>(82)</small></a></li>
                                        <li class="active"><a href="#">Economy<small>(127)</small></a></li>
                                        <li><a href="#">Luxury / Premium<small>(22)</small></a></li>
                                        <li><a href="#">Mini Car<small>(38)</small></a></li>
                                        <li><a href="#">Van / Minivan<small>(39)</small></a></li>
                                        <li><a href="#">Exotic / Special<small>(72)</small></a></li>
                                    </ul>
                                    <a class="button btn-mini">MORE</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="panel style1 arrow-right">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#car-rental-agent-filter" class="collapsed">Bus Rental Operator</a>
                            </h4>
                            <div id="car-rental-agent-filter" class="panel-collapse collapse">
                                <div class="panel-content">
                                    <ul class="check-square filters-option">
                                        <li><a href="#">Fox Rent A Car<small>(08)</small></a></li>
                                        <li><a href="#">Payless<small>(32)</small></a></li>
                                        <li class="active"><a href="#">Ez rent a car<small>(227)</small></a></li>
                                        <li><a href="#">Thrifty<small>(22)</small></a></li>
                                        <li><a href="#">Enterprise<small>(18)</small></a></li>
                                        <li><a href="#">Alamo<small>(29)</small></a></li>
                                        <li><a href="#">Dollar<small>(12)</small></a></li>
                                    </ul>
                                    <a class="button btn-mini">MORE</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- filters end  -->
                <div class="col-sm-8 col-md-9">
                    <!-- sort start -->
                    <div class="sort-by-section clearfix">
                        <h4 class="sort-by-title block-sm">Sort results by:</h4>
                        <ul class="sort-bar clearfix block-sm">
                            <li class="sort-by-name"><a class="sort-by-container" href="#"><span>name</span></a></li>
                            <li class="sort-by-price"><a class="sort-by-container" href="#"><span>price</span></a></li>
                            <li class="clearer visible-sms"></li>
                            <li class="sort-by-rating active"><a class="sort-by-container" href="#"><span>rating</span></a></li>
                            <li class="sort-by-popularity"><a class="sort-by-container" href="#"><span>popularity</span></a></li>
                        </ul>
                    </div>
                    <!-- sort end -->
                    <div class="car-list">
                        <div class="row image-box car listing-style1">
                            @foreach($rentals as $rental)
                            <div class="col-sms-6 col-sm-6 col-md-4">
                                <article class="box">
                                    <figure>
                                        <a title="" href="#"><img alt="" src="http://placehold.it/270x160"></a>
                                    </figure>
                                    <div class="details">
                                        <span class="price"><small>per day</small>${{$rental->one_day}}</span>
                                        <h4 class="box-title">{{$rental->bus->type}}<small>{{$rental->bus->makeModel()}}</small></h4>
                                        <div class="amenities">
                                            <ul>
                                                <li>
                                                    <i class="soap-icon-passenger circle"></i>{{$rental->bus->seats}}
                                                </li>
                                                <li>
                                                    <i class="soap-icon-wifi circle"></i>{{$rental->bus->wifi ? 'YES' : 'NO'}}
                                                </li>
                                                <li>
                                                    <i class="soap-icon-aircon circle"></i>AC
                                                </li>
                                                <li>
                                                    <i class="soap-icon-bag circle"></i>{{$rental->bus->usb ? 'YES' : 'NO'}}
                                                </li>
                                                <li>
                                                    <i class="soap-icon-handicapaccessiable circle"></i>
                                                    {{$rental->bus->toilet ? 'YES' : 'NO'}}
                                                </li>
                                            </ul>
                                        </div>
                                        <p class="mile"><span class="skin-color">Operator:</span> {{$rental->company->name}} </p>
                                        <div class="action">
                                            <a class="button btn-small full-width" href="{{ route('rentals.show', array_add($data, 'id', $rental->id)) }}">SELECT NOW</a>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- <a href="#" class="button uppercase full-width btn-large">load more listings</a> -->
                    {!! $rentals->appends($data)->links() !!}
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
    });
</script>

@endsection