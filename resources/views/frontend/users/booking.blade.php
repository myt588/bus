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
                            <form>
                                <label class="radio radio-inline checked">
                                    <input type="radio" name="filter" checked="checked">
                                    All Types
                                </label>
                                <label class="radio radio-inline">
                                    <input type="radio" name="filter">
                                    Tickets
                                </label>
                                <label class="radio radio-inline">
                                    <input type="radio" name="filter">
                                    Rentals
                                </label>
                                <div class="pull-right col-md-6 action">
                                    <h5 class="pull-left no-margin col-md-4">Sort results by:</h5>
                                    <button class="btn-small white gray-color">UPCOMING</button>
                                    <button class="btn-small white gray-color">CANCELLED</button>
                                </div>
                            </form>
                        </div>
                        <div class="booking-history">
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
                                        <dd>{{$item->transaction->confirmation_number}}</dd>
                                        <dt>booked on</dt>
                                        <dd>{{$item->created_at}}</dd>
                                    </dl>
                                    <button class="btn-mini status">{{$item->isPast() ? 'PAST' : 'UPCOMMING'}}</button>
                                </div>
                                @else

                                @endif
                            @endforeach
                        </div>
                        {!! $collection->render() !!}
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
        });
        tjq('a[href="#profile"]').on('shown.bs.tab', function (e) {
            tjq(".view-profile").show();
            tjq(".edit-profile").hide();
        });
    </script>
</body>
@endsection
