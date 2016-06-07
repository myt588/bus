@extends('layouts.frontend')

@section('title') Thank you @endsection @section('heading') Thank you @endsection

@section('breadcrumb')

<div class="page-title-container">
    <div class="container">
        <div class="page-title pull-left">
            <h2 class="entry-title">Thank You</h2>
        </div>
        <ul class="breadcrumbs pull-right">
            <li><a href="#">HOME</a></li>
            <li><a href="#">TICKETS</a></li>
            <li class="active">Thank you</li>
        </ul>
    </div>
</div>

@endsection

@section('content')

<section id="content" class="gray-area">
    <div class="container">
        <div class="row">
            <div id="main" class="col-sm-8 col-md-9">
                <div class="booking-information travelo-box">
                    <h2>Booking Confirmation</h2>
                    <hr />
                    <div class="booking-confirmation clearfix">
                        <i class="soap-icon-recommend icon circle"></i>
                        <div class="message">
                            <h4 class="main-message">Thank You. Your Booking Order is Confirmed Now.</h4>
                            <p>A confirmation email has been sent to your provided email address.</p>
                        </div>
                        <a href="{{route('tickets.invoice', $transactions[0]->invoice_id)}}" class="print-button button btn-small">SEE INVOICE</a>
                    </div>
                    <hr />
                    <h2>Traveler Information</h2>
                    <dl class="term-description">
                        <dt>Booking number:</dt><dd>{{ $transactions[0]->booking_no }}</dd>
                        <dt>First name:</dt><dd>{{ $user->first_name }}</dd>
                        <dt>Last name:</dt><dd>{{ $user->last_name }}</dd>
                        <dt>E-mail address:</dt><dd>{{ $user->email }}</dd>
                    </dl>
                    <hr />
                    <h2>Tickets</h2>
                    @foreach($transactions as $i => $transaction)
                    <div id="car-details">
                        @foreach($transaction->tickets as $item)
                            @include('frontend.tickets.partials.ticket', [
                                'trip'      => $item->trip, 
                                'trip_DS'   => $item->trip->stations->find($item->depart_station), 
                                'trip_AS'   => $item->trip->stations->find($item->arrive_station), 
                                'date'      => $item->depart_date, 
                                'ticket'    => $item,
                            ])
                        @endforeach
                    </div>
                    @endforeach
                    <hr />
                    <h2>Payment</h2>
                    <p>{{App\Metas::byKey('site_payment')->count() == 0 ? '' : Metas::byKey('site_payment')->first()->value}}</p>
                    <br />
                    <p class="red-color">Payment is made by Credit Card Via Strip.</p>
                    <hr />
                    <h2>View Booking Details</h2>
                    <p>You may view the booking details through the link below or find it in your personal page. A confirmation email is also sent to your email address</p>
                    <br />
                    <a href="#" class="red-color underline view-link">{{url()->current()}}</a>
                </div>
            </div>
            @include('frontend.partials.help-box')
        </div>
    </div>
</section>
@endsection

@section('js')
<!-- Google Map Api -->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyBUdG-LWODBF8OiWvhRy8t0b2KGF69jjpE"></script>
<!-- <script type="text/javascript" src="/js/gmap3.min.js"></script> -->
<script type="text/javascript" src="/js/gmap3.min.js"></script>

<script type="text/javascript" src="/js/calendar.js"></script>
@endsection