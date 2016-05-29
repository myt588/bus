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
                    @include('frontend.rentals.partials.filters')
                </div>
                <!-- filters end  -->
                <div class="col-sm-8 col-md-9">
                    <!-- sort start -->
                    <!-- <div class="sort-by-section clearfix">
                        <h4 class="sort-by-title block-sm">Sort results by:</h4>
                        <ul class="sort-bar clearfix block-sm">
                            <li class="sort-by-name"><a class="sort-by-container" href="#"><span>name</span></a></li>
                            <li class="sort-by-price"><a class="sort-by-container" href="#"><span>price</span></a></li>
                            <li class="clearer visible-sms"></li>
                            <li class="sort-by-rating active"><a class="sort-by-container" href="#"><span>rating</span></a></li>
                            <li class="sort-by-popularity"><a class="sort-by-container" href="#"><span>popularity</span></a></li>
                        </ul>
                    </div> -->
                    <!-- sort end -->
                    @if(count($rentals) == 0)
                    <h1>Sorry, Nothing Matches your Search! </h1>
                    @endif
                    <div class="car-list">
                        <div class="row image-box car listing-style1">
                            @foreach($rentals as $rental)
                            <div class="col-sms-6 col-sm-6 col-md-4">
                                <article class="box">
                                    <figure>
                                        <a title="" href="#"><img alt="" src="/{{$rental->bus->getThumbnail()}}"></a>
                                    </figure>
                                    <div class="details">
                                        <span class="price"><small>per day</small>${{$rental->per_day}}</span>
                                        <h4 class="box-title">{{$rental->bus->type}}<small>{{$rental->bus->getMakeModel()}}</small></h4>
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

        tjq('.company_options').click(function(){
            tjq('#all').removeClass('active');
        });

        tjq('#all').click(function(){
            tjq('.company_options').removeClass('active');
        });

        tjq("#filter").click(function(){
            min = tjq(".min-price-label").text().substring(1);
            max = tjq(".max-price-label").text().substring(1);
            url = updateQueryStringParameter(window.location.href, 'filter', true);
            url = updateQueryStringParameter(url, 'min', min);
            url = updateQueryStringParameter(url, 'max', max);
            url = removeParam('companyName[]', url);
            url = removeParam('type[]', url);
            for (var j = tjq("#type_count").text().substring(0,1); j >= 0; j--) 
            {
                if (tjq("#type_" + j).hasClass('active'))
                {
                    type = tjq("#type_" + j).text().split('(')[0];
                    url = updateQueryStringParameter(url, 'type[]', type);
                }
            }
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