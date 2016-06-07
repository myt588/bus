@extends('layouts.frontend')

@section('css')
<link rel="stylesheet" href="/css/app.css">
@endsection

@section('title') TriponBus @endsection

@section('content')
<section id="content" class="gray-area">
    <div class="container">
        <div id="main">
            <div class="tab-container full-width-style arrow-left dashboard">
                @include('frontend.users.partials.nav')
                <div class="tab-content">
                    <div id="booking" class="tab-pane fade active in">
                        <h2>Trips You have Booked!</h2>
                        <div class="filter-section gray-area clearfix">
                            <h5 class="radio-inline">Sort results by:</h5>
                            <label id="ticket" class="radio radio-inline ">
                                <input type="radio" name="filter">
                                Tickets
                            </label>
                            <label id="rental" class="radio radio-inline ">
                                <input type="radio" name="filter">
                                Rentals
                            </label>
                        </div>
                        <div class="booking-history">
                            @if(count($collection) == 0)
                            <h2>You don't have any booking yet. Click <a style="color: blue;" href="{{route('home')}}">here</a> to book your first trip! </h2>
                            @endif
                            @foreach($collection as $item)
                                @if(get_class($item) == "App\Ticket")
                                <div class="booking-info clearfix {{$item->isPast() ? 'cancelled' : ''}}">
                                    <div class="date">
                                        <label class="month">{{getMonth($item->depart_date)}}</label>
                                        <label class="date">{{getDay($item->depart_date)}}</label>
                                        <label class="day">{{getWeekday($item->depart_date)}}</label>
                                    </div>
                                    <h4 class="box-title"><i class="icon soap-icon-car blue-color circle"></i><a href="{{route('tickets.thankyou', $item->transaction->id)}}">{{$item->trip->name}}</a></h4>
                                    <dl class="info">
                                        <dt>Booking Number</dt>
                                        <dd>{{$item->transaction->booking_no}}</dd>
                                        <dt>booked on</dt>
                                        <dd>{{$item->created_at}}</dd>
                                    </dl>
                                    <button class="btn-mini status">{{$item->isPast() ? 'PAST' : 'UPCOMMING'}}</button>
                                </div>
                                @else
                                <div class="booking-info clearfix {{$item->isPast() ? 'cancelled' : ''}}">
                                    <div class="date">
                                        <label class="month">{{getMonth($item->start)}}</label>
                                        <label class="date">{{getDay($item->start)}}</label>
                                        <label class="day">{{getWeekday($item->start)}}</label>
                                    </div>
                                    <h4 class="box-title"><i class="icon soap-icon-car blue-color circle"></i><a href="{{route('rentals.thankyou', $item->transaction->id)}}">{{$item->getName()}}</a></h4>
                                    <dl class="info">
                                        <dt>Booking Number</dt>
                                        <dd>{{$item->transaction->booking_no}}</dd>
                                        <dt>booked on</dt>
                                        <dd>{{$item->created_at}}</dd>
                                    </dl>
                                    <button class="btn-mini status">{{$item->isPast() ? 'PAST' : 'UPCOMMING'}}</button>
                                </div>
                                @endif
                            @endforeach
                        </div>
                        {!! $collection->appends($data)->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('js')
<script type="text/javascript">
    tjq(document).ready(function() {
        tjq("#profile .edit-profile-btn").click(function(e) {
            e.preventDefault();
            tjq(".view-profile").fadeOut();
            tjq(".edit-profile").fadeIn();
        });

        setTimeout(function() {
            tjq(".notification-area").append('<div class="info-box block"><span class="close"></span><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus ab quis a dolorem, placeat eos doloribus esse repellendus quasi libero illum dolore. Esse minima voluptas magni impedit, iusto, obcaecati dignissimos.</p></div>');
        }, 10000);

        tjq('#rental').addClass(function(){
            if (getUrlParameter('type') === 'rental')
            {
                return 'checked';
            }
        });

        tjq('#rental').change(function(){
            window.location = updateQueryStringParameter(window.location.href, 'type', 'rental');
        });

        tjq('#ticket').addClass(function(){
            if (getUrlParameter('type') === 'ticket')
            {
                return 'checked';
            }
        });

        tjq('#ticket').change(function(){
            window.location = updateQueryStringParameter(window.location.href, 'type', 'ticket');
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
    });
    tjq('a[href="#profile"]').on('shown.bs.tab', function (e) {
        tjq(".view-profile").show();
        tjq(".edit-profile").hide();
    });

</script>
@endsection
